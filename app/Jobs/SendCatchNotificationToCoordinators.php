<?php

namespace App\Jobs;

use App\Mail\TrapCatch;
use App\Models\Inspection;
use App\Models\Project;
use App\Models\Trap;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class SendCatchNotificationToCoordinators implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $inspection;
    protected $project;
    protected $user;
    protected $trap;
    protected $recipients;

    /**
     * Create a new job instance.
     *
     * @param Collection $usersToNotify
     * @param Inspection $inspection
     * @param Project $project
     * @param User $inspectionUser
     * @param Trap $trap
     */
    public function __construct(Inspection $inspection)
    {
        $trap = $inspection->trap;
        $project = $trap->project;
        $user = $inspection->user;
        $usersToNotify = $project->coordinators();

        $this->inspection = $inspection->withoutRelations();
        $this->trap = $trap->withoutRelations();
        $this->project = $project->withoutRelations();
        $this->user = $user->withoutRelations();
        $recipients = [];
        foreach ($usersToNotify as $user) {
            if($user->pivot->shouldNotify($this->inspection->species_caught)) {
                $recipients[] = $user->email;
            }
        }
        $this->recipients = $recipients;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        if(count($this->recipients)) {
            \Mail::to($this->recipients)
                ->send(new TrapCatch($this->inspection, $this->project, $this->user, $this->trap));
        }
    }
}
