<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateTraps;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProjectsController extends Controller
{

    public function projects(Request $request){
        return Inertia::render('UserProjects',[
            'projects' => $request->user()->projectsAll()->get(),
            'projects_all' => Project::orderBy('name')->get()
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
            ->text(strtoupper($request->qr_code), 100, 159, function($font) {
                $font->file(public_path() . '/Montserrat-Bold.ttf');
                $font->size(40);
            })
            ->text(\Carbon\Carbon::now()->format('dmy'), 520, 993, function($font) {
                $font->file(public_path() . '/Montserrat-Bold.ttf');
                $font->color('#87A0B1');
                $font->size(22);
            });
        return $template->response('png');
    }
}
