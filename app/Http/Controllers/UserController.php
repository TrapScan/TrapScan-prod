<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Kpi;
use App\Models\Inspection;
use App\Models\User;
use App\Models\Trap;
use App\Models\Project;


class UserController extends Controller
{
    public function userStat(Request $request){
        $total_users = User::count() ?? 1;
        $total_catches = Inspection::where('species_caught', '!=', 'None')->count();
        $total_inspections = Inspection::count();
        $total_traps = Trap::count();
        $total_projects = Project::count() ?? 1;

        $data = [
            'total_inspections' => $total_inspections,
            'total_catches' => $total_catches,
            'total_traps' => $total_traps,
            'total_projects' => $total_projects,
            'total_users' => $total_users,
            'average_catches_per_user' => round($total_catches / $total_users, 2),
            'average_inspections_per_user' => round($total_inspections / $total_users, 2),
            'average_trap_per_project' => round($total_traps / $total_projects, 2),
            'average_project_per_user' => round($total_projects / $total_users, 2),
        ];

        Kpi::create($data);

        return Inertia::render('UserData',[
            'user_d' => new UserResource($request->user()->load('roles')),
            'all_data' => $data
        ]);
    }
}
