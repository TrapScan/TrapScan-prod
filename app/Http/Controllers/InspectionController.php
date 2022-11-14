<?php

namespace App\Http\Controllers;

use App\Http\Requests\InspectionQrRequest;
use App\Jobs\SendCatchNotificationToCoordinators;
use App\Jobs\SendTrapIssueNotificationToCoordinators;
use App\Jobs\UploadToTrapNZ;
use App\Models\Project;
use App\Models\QR;
use App\Models\Trap;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use App\Models\Inspection;

class InspectionController extends Controller
{

    public function anon_index(Request $request){
        $qr = QR::where('qr_code', $request->qr_id)->first();
        if(!$qr) {
            session()->flash('message','Trap not found');
            return redirect(route('index'));
        }
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
            session()->flash('message','Trap not found');
            return redirect(route('index'));
        }

        return Inertia::render('Anonscan',[
            'trap_data' => $trap,
        ]);
    }

    public function index(Request $request){
        $qr = QR::where('qr_code', $request->qr_id)->first();

        if(auth()->id() == null) {
            session()->flash('message','Trap not found');
            return redirect(route('index',$request->qr_id));
        }

        if(! $qr) {
            session()->flash('message','Trap not found');
            return redirect(route('scan'));
        }
        $unmapped = false;
        $coordinator = false;
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

            $project = Project::find($trap->project_id);
            $coordinator = $request->user()->isCoordinatorOf($project);
        } else {
            $trap = ['qr_id' => $qr->qr_code];
            $unmapped = true;
        }

        $projects = $request->user()->isInProject();
        $ids = collect();
        foreach ($projects as $pr){
            $ids->push($pr->id);
        }
        $pr = Trap::select('id', 'project_id', 'nz_trap_id', 'name', 'coordinates', 'qr_id')
            ->whereIn('project_id',$ids)
            ->noCode()->with('project')->get();
        $qrs = QR::whereNull('trap_id')
            ->orderBy('qr_code')
            ->get();
        $for_find = collect();
        $for_qr = collect();
        foreach ($pr as $p) {
            $for_find->push([
                'id' => $p->nz_trap_id,
                'name' => $p->name.' - '.$p->project->name,
            ]);
        }
        foreach ($qrs as $p) {
            $for_qr->push([
                'id' => $p->qr_code,
                'name' => $p->qr_code,
            ]);
        }

        return Inertia::render('Inspection',[
            'trap_data' => $trap,
            'unmapped' => $unmapped,
            'projects' => $pr,
            'for_find' => $for_find,
            'coordinator' => $coordinator,
            'for_qr'=>$for_qr
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
            return back();
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

        return redirect(route('anon_success'));
    }

    public function save(Request $request)
    {
        $validated_data = $request->all();
//            $request->validate([
//                'QR_ID' => 'string',
//                'code' => 'string',
//                'date_format' => 'string',
//                'species_caught' => 'string',
//                'status' => 'string',
//                'bait_type'=>'nullable|string',
//                'rebaited' => 'string',
//                'trap_condition' => 'string',
//                'notes' => 'nullable|string',
//                'words' => 'string',
//                'upload_to_nz' => 'string'
//            ]);

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
                'strikes' => 1,
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
                UploadToTrapNZ::dispatch($inspection);
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
        $last_inspection = $trap->inspections()->latest()->limit(2)->get();
        if($last_inspection) {
            $last = $last_inspection->last();
            $trap->last_checked = $last->updated_at->diffForHumans() ?? 'now';
            $trap->last_checked_by = $last->user->name ?? 'Anonymous';
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
