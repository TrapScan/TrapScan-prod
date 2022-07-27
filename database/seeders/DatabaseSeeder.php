<?php

namespace Database\Seeders;

use App\Models\Inspection;
use App\Models\Project;
use App\Models\QR;
use App\Models\Trap;
use App\Models\TrapLine;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use function Symfony\Component\Translation\t;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $userCount = 50;
        $projectCount = 20;
        $trapCount = 20;
        $inspectionsCount = 5;
        $trapLinesCount = 2; // Keep less than projectCount

        $settings = ['settings' => ['theme' => 'default', 'dark_mode' => true]];
        $users = User::factory($userCount)->create($settings);
        $projects = Project::factory($projectCount)->has(
            Trap::factory($trapCount)
        )->create()->toArray();

        foreach ($users as $user) {
            // Make a user part of 3 random projects
            $randomProjects = array_rand($projects, 3);
            foreach ($randomProjects as $project) {
                $user->projects()->attach($project);
            }

            // In each project give it's users a random amount of inspections
            // on each trap in the project
            foreach ($user->projects as $userProject) {
                foreach ($userProject->traps as $userTrap) {
                    $rand = rand(0, $inspectionsCount);
                    Inspection::factory($rand)->create([
                        'recorded_by' => $user->id,
                        'trap_id' => $userTrap->id
                    ]);
                }
            }
        }

        // Create the inverse of the trap relationship to QRs
        $traps = Trap::all();
        foreach($traps as $trap) {
            $qr = QR::where('qr_code', $trap->qr_id)->first();
            $qr->trap_id = $trap->id;
            $qr->save();
        }

        // Add the first user in each project as the coordinator
        $project_collection = Project::all();
        foreach ($project_collection as $project) {
            if($project->users()->exists()) {
                $user = $project->users()->first();
                $user->projects()->updateExistingPivot($project->id, [
                    'coordinator' => true
                ]);
            }
        }

        // Create a couple traplines with half of the traps from a project
        for($i=0; $i < $trapLinesCount; $i++) {
            $project = Project::all()->random(1)->first();
            if(! $project->traplines()->exists()){
                // Create a trapline from half the traps in the project
                $traps = $project->traps->random($project->traps->count() /2);
                $trapLine = TrapLine::factory(1)->create([
                    'project_id' => $project->id,
                ])->first();
                $trapLine->traps()->saveMany($traps);
            }
        }

        /*
         * Some Constants for Dev
         */
        // Create a sample trap for testing
        if(! Trap::where('qr_id', 'Test-1234')->exists() && Project::find(1)->exists()){
            if(! QR::where('qr_code', 'Test-1234')->exists()) {
                QR::create(['qr_code' => 'Test-1234']);
            }
            $test_trap = Trap::factory()->create([
                'qr_id' => 'Test-1234',
                'project_id' => Project::find(1)->get()->first()->id
            ]);
            $qr = QR::where('qr_code', 'Test-1234')->first();
            $qr->trap_id = $test_trap->id;
            $qr->save();
        }

        // Create an admin user for Dylan
        if(! User::where('email', 'apoliten@gmail.com')->exists()){
            $user = User::factory()->create([
                'email' => 'apoliten@gmail.com',
                'password' => bcrypt('apolol'),
                'settings' => $settings['settings']
            ]);

            // Create the admin role
            if(! Role::where('name', 'admin')->exists()) {
                Role::create(['name' => User::ADMIN_ROLE]);
            }

            $user->assignRole(User::ADMIN_ROLE);
            $user->save();
        }
        // Create a normal user for Dylan
        if(! User::where('email', 'apoliten.user@gmail.com')->exists()) {
            $user = User::factory()->create([
                'email' => 'apoliten.user@gmail.com',
                'settings' => $settings['settings'],
                'password' => bcrypt('apolol')
            ]);
        }
//        // Make the normal user for Dylan a pcord on project id 1
//        if(! Project::find(1)->users()
//            ->where('email', 'dylan.user@dylanhobbs.ie')->exists()) {
//            $user = User::where('email', 'dylan.user@dylanhobbs.ie')->first();
//            $project = Project::find(1);
//            $user->projects()->save($project);
//            $user->refresh();
//
//            $user->projects()->updateExistingPivot($project->id, [
//                'coordinator' => true
//            ]);
//        }
    }
}
