<?php

namespace App\Jobs;

use App\Mail\TrapCatch;
use App\Mail\TrapProblem;
use App\Models\Inspection;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendTrapIssueNotificationToCoordinators implements ShouldQueue
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
     * @return void
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
            if($user->pivot->shouldNotifyTrapIssue()) {
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
                ->send(new TrapProblem($this->inspection, $this->project, $this->user, $this->trap));
        }
    }
}
