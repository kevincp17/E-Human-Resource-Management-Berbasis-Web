<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplyMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $userCom;
    public $job;
    public $jobApply;
    public $company;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$userCom,$job,$jobApply,$company)
    {
        $this->user = $user;
        $this->userCom = $userCom;
        $this->job = $job;
        $this->jobApply = $jobApply;
        $this->company = $company;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Lamaran Lowongan')->view('applyMail');
    }
}
