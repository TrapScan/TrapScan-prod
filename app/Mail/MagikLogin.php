<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MagikLogin extends Mailable
{
    use Queueable, SerializesModels;

    protected $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "TrapScan Email link to log in ✨";
        return $this->from('login@trapscan.app')->subject($subject)->markdown('emails.magik_login' ,[ 'url' => $this->url]);
    }
}
