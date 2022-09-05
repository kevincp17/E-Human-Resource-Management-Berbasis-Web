<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyMailCompany extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $verifyUser;
    public $company;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$verifyUser,$company)
    {
        //
        $this->user = $user;
        $this->verifyUser = $verifyUser;
        $this->company = $company;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Verifikasi Email Perusahaan')->view('verifyEmailCompany');
    }
}
