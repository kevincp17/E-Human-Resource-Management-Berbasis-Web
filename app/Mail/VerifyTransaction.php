<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyTransaction extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $company;
    public $transaction;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$company,$transaction)
    {
        //
        $this->user = $user;
        $this->company = $company;
        $this->transaction = $transaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Verifikasi Transaksi Pembayaran')->view('verifyTransactionMail');
    }
}
