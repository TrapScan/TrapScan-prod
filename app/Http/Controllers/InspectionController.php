<?php

namespace App\Http\Controllers;

use App\Http\Requests\InspectionQrRequest;
use App\Jobs\SendCatchNotificationToCoordinators;
use App\Jobs\SendTrapIssueNotificationToCoordinators;
use App\Jobs\UploadToTrapNZ;
use App\Models\QR;
use App\Models\Trap;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use App\Models\Inspection;

class InspectionController extends Controller
{

    public function index(Request $request){
        $qr = QR::where('qr_code', $request->qr_id)->first();
        if(! $qr) {
            session()->flash('message','Trap not found');
            return back();
        }

        $unmapped = false;
        if($qr->trap_id) {
            $trap = Trap::find($qr->trap_id);
            $last_inspection = $trap->inspections()->latest()->limit(1)->first();
            if($last_inspection) {
                $trap->last_checked = $last_inspection->updated_at->diffForHumans();
                $trap->last_checked_by = $last_inspection->user->name ?? 'Anonymous';
            }
            if($trap->inspections()->where('species_caught', '!=', 'None')->exists()) {
                $trap->last_caught = $trap->inspections()->where('species_caught', '!=', 'None')->first()->species_caught;
            }
            $trap->total_catches = $trap->inspections()->where('species_caught', '!=', 'None')->count();
        } else {
            // The trap is unmapped, return just the code.
            // Frontend looks for nz_trap_id and will conditionally redirect
            // to the installation form or show error if needed
            $trap = ['qr_id' => $qr->qr_code];
            $unmapped = true;
        }

        return Inertia::render('Inspection',[
            'trap_data'=>$trap,
            'unmapped'=>$unmapped
        ]);

    }

    public function createAnon(Request $request) {
        $validated_data = $request->validate([
            'QR_ID' => 'required',
            'species_caught' => 'required'
        ]);

        $trap = Trap::where('qr_id', $validated_data['QR_ID'])->first();
        if(! $trap) {
            session()->flash('message', 'Error: Trap ' . $validated_data['QR_ID'] . ' does not exist');
            return redirect(route('scan'));
        }

        $oneHourAgo = Carbon::now()->subMinutes(10);
        if(env('APP_ENV') === 'local') $oneHourAgo = Carbon::now()->subSeconds(20);
        if(Inspection::where('trap_id', $trap->id)->where('species_caught', $validated_data['species_caught'])
            ->where('created_at', '>=', $oneHourAgo)->exists()) {
            // Silently fail to the user to prevent spam of the same trap
            Log::info('Skipping store of anan inspection. Possible spam', $validated_data);
        } else {
            $inspection = Inspection::create([
                'date' => Carbon::now(),
                'trap_id' => $trap->id,
                'recorded_by' => null,
                'strikes' => 0,
                'species_caught' => $validated_data['species_caught'],
                'status' => 'Sprung',
                'rebaited' => false,
                'bait_type' => 'None',
                'trap_condition' => 'Unknown',
                'notes' => 'Anonymous inspection. Only contains species data',
                'words' => 'Anonymous inspection',
                'anon' => true
            ]);
        }
        return Inertia::render('Inspection',[
            'message'=>'Inspection  added',
        ]);
    }
    public function save(Request $request)
    {
        $validated_data = $request->validate([
            'QR_ID' => 'required',
            'code' => 'required',
            'date_format' => 'required',
            'recorded_by' => 'nullable|integer',
            'strikes' => 'required',
            'species_caught' => 'required',
            'status' => 'required',
            'bait_type'=>'nullable|string',
            'rebaited' => 'required',
            'trap_condition' => 'required',
            'notes' => 'nullable|string',
            'words' => 'required',
            'trap_last_checked' => 'nullable|date',
            'upload_to_nz' => 'required',
        ]);
        $trap = Trap::where('qr_id', $validated_data['QR_ID'])->first();
        if (!$trap) {
            session()->flash('message', 'Error: Trap ' . $validated_data['QR_ID'] . ' does not exist');
            return redirect(route('scan'));
        }

        // Duplicate check
        $oneHourAgo = Carbon::now()->subSeconds(10);
        if(env('APP_ENV') === 'local') $oneHourAgo = Carbon::now()->subSeconds(20);
        $duplicate = Inspection::where('trap_id', $trap->id)
            ->where('created_at', '>=', $oneHourAgo)->first();
        if (Inspection::where('trap_id', $trap->id)
            ->where('created_at', '>=', $oneHourAgo)->exists()) {
            return response()->json([
                'message' => 'Inspection was added < 1 hour ago, duplicate has been ignored',
                'data' => $duplicate->toArray()
            ],200);
        } else {
            $inspection = Inspection::create([
                'date' => date('Y-m-d h:i:s', strtotime($validated_data['date_format'])) ?? Carbon::now(),
                'trap_id' => $trap->id,
                'recorded_by' => $request->user()->id,
                'strikes' => $validated_data['strikes'],
                'species_caught' => $validated_data['species_caught'],
                'status' => $validated_data['status'],
                'rebaited' => $validated_data['rebaited'] === 'Yes' || $validated_data['rebaited'] === 'yes',
                'bait_type' => ($validated_data['bait_type'] != null ? $validated_data['bait_type'] : 'None'),
                'trap_condition' => $validated_data['trap_condition'],
                'notes' => $validated_data['notes'] ?? '',
                'words' => $validated_data['words'],
                'upload_to_nz' => $validated_data['upload_to_nz'] ?? 0,
            ]);
            // Notifications
            if($inspection->species_caught && $inspection->species_caught !== 'None') {
                SendCatchNotificationToCoordinators::dispatch($inspection);
            }

            if($inspection->upload_to_nz) {
                //UploadToTrapNZ::dispatch($inspection);
            }

            if($inspection->trap_condition === 'Needs maintenance') {
                SendTrapIssueNotificationToCoordinators::dispatch($inspection);
            }
            session()->flash('mess','Inspection  added');
            session()->flash('trap_id',$trap->id);
            session()->flash('las_inspection',$inspection);

            return redirect(route('inspection.inspection_add'));
        }

    }

    public function inspection_add(){
        $mess = session()->get('mess');
        $trap = session()->get('trap_id');
        $inspection = session()->get('las_inspection');
        if ($mess == null){
            return redirect(route('scan'));
        }
        $trap = Trap::find($trap);
        $last_inspection = $trap->inspections()->latest()->limit(1)->first();
        if($last_inspection) {
            $trap->last_checked = $last_inspection->updated_at->diffForHumans();
            $trap->last_checked_by = $last_inspection->user->name ?? 'Anonymous';
        }
        if($trap->inspections()->where('species_caught', '!=', 'None')->exists()) {
            $trap->last_caught = $trap->inspections()->where('species_caught', '!=', 'None')->first()->species_caught;
        }
        $trap->total_catches = $trap->inspections()->where('species_caught', '!=', 'None')->count();
        return Inertia::render('InspectionDone',[
            'mess'=>$mess,
            'inspection' => $inspection,
            'trap' => $trap
        ]);
    }
}
