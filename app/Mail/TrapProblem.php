<?php

namespace App\Mail;

use App\Models\Inspection;
use App\Models\Project;
use App\Models\Trap;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TrapProblem extends Mailable
{
    use Queueable, SerializesModels;

    public $inspection;
    public $trap;
    public $project;
    public $user;

    /**
     * Create a new message instance.
     *
     * @param Inspection $inspection
     * @param Project $project
     * @param User $user
     * @param Trap $trap
     */
    public function __construct(Inspection $inspection, Project $project, User $user, Trap $trap)
    {
        $this->inspection = $inspection;
        $this->project = $project;
        $this->user = $user;
        $this->trap = $trap;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Trap Issue: " . $this->trap->name . " has an issue";
        return $this->from('problems@trapscan.app')->subject($subject)->markdown('emails.problem');
    }
}
