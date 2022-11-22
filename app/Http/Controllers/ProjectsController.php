<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateTraps;
use App\Models\Project;
use App\Models\QR;
use App\Models\Trap;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProjectsController extends Controller
{

    public function projects(Request $request){
        return Inertia::render('UserProjects',[
            'projects' => $request->user()->projectsAll()->get(),
            'projects_all' => Project::orderBy('name')->whereNotIn('id',$request->user()->projectsAll()->pluck('project_id'))->get()
        ]);
    }
    public function view(Request $request){
        $user_pr = \Auth::user()->projectsAll()->get();
        return Inertia::render('ViewProject',[
            'project' => Project::whereId($request->id)->first(),
            'back'=> Url()->previous(),
            'user_in_pr'=>($user_pr->where('id',$request->id)->count() == 0 ? false : true),
            'user_in_pr_data'=>$user_pr->where('id',$request->id)->first(),
            'coordinator'=>($user_pr->where('id',$request->id)->first() != null ? \Auth::user()->isCoordinatorOf($user_pr->where('id',$request->id)->first()) : false)
        ]);
    }

    public function leave(Request $request){
        $validated_data = $request->validate([
            'projectId' => 'required'
        ]);

        $project = Project::find($validated_data['projectId']);
        $user = User::find(auth()->id());
        $user->projects()->detach($project);

        return redirect(route('user.projects'));
    }

    public function enter(Request $request){
        $validated_data = $request->validate([
            'projectId' => 'required'
        ]);

        $project = Project::find($validated_data['projectId']);
        $user = User::find(auth()->id());
        $user->projects()->attach($project);

        return redirect(route('user.projects'));
    }

    public function updateProjectTraps(Request $request)
    {
        $user = $request->user();
        $pr_id = $request->get('projectId');
        $prject = Project::find($pr_id);
        UpdateTraps::dispatch($prject->nz_id, $pr_id, $user);

        return back();
    }

    public function updateUserSettings(Request $request){
        $validated_data = $request->validate([
            'projectId' => 'required',
            'value' => 'required',
            'key' => 'required'
        ]);

        $project = Project::find($validated_data['projectId']);
        $user = User::find(auth()->id());

        $user->projects()->updateExistingPivot($project->id, [
            $validated_data['key'] => $validated_data['value']
        ]);

        return back();
    }

    public function generateQr(Request $request){
        QrCode::size(420)->format('png')->generate(env('APP_URL') . '/scan/' . $request->qr_code, public_path('/qrcodes/'. $request->qr_code . '.png'));
        $qr_code = Image::make(public_path('/qrcodes/'. $request->qr_code . '.png'));
        $template = Image::make(public_path('qr_template.png'))
            ->insert($qr_code, 'top-left', 110, 210)
            ->text(ucfirst($request->qr_code), 100, 159, function($font) {
                $font->file(public_path() . '/Montserrat-Bold.ttf');
                $font->size(50);
            })
            ->text(\Carbon\Carbon::now()->format('dmy'), 520, 993, function($font) {
                $font->file(public_path() . '/FiraSans-Regular.ttf');
                $font->color([0, 0, 0, 0.5]);
                $font->size(22);
            });
        return $template->response('png');
    }

    public function qr(Request $request): JsonResponse{
        if ($request->qr_id == null)
            return response()->json();
        return response()->json(QR::where('qr_code', 'LIKE','%'.$request->qr_id.'%')->limit(20)->get());
    }

    public function qr_free(Request $request): JsonResponse{
        if ($request->qr_id == null)
            return response()->json();
        return response()->json(
            QR::whereNull('trap_id')
            ->where('qr_code', 'LIKE','%'.$request->qr_id.'%')
                ->limit(20)
            ->get()
        );
    }

    public function traps(Request $request): JsonResponse{
        if ($request->qr_id == null)
            return response()->json();
        $user = User::find($request->user);
        $projects = $user->isInProject();
        $for_find = collect();
        foreach ($projects as $pr){
            $temp = Trap::select('id', 'project_id', 'nz_trap_id', 'name', 'coordinates', 'qr_id')
                ->where('project_id',$pr->id)
                ->where('name', 'LIKE','%'.$request->qr_id.'%')
                ->noCode()->with('project')->limit(10)->get();
            if ($temp->count() > 0){
                $ids = collect();

                foreach ($temp as $p) {
                    $ids->push([
                        'id' => $p->nz_trap_id,
                        'name' => $p->name,
                    ]);
                }
                $for_find->push([
                    'name' => $pr->name,
                    'children' => $ids
                ]);
                $ids = null;

            }

        }
        return response()->json($for_find);
    }
}
