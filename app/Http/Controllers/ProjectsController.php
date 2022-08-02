<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateTraps;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;


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
}
