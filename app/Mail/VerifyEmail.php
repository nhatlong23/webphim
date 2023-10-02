<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $passCode;
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($passCode, $email)
    {
        $this->passCode = $passCode;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.VerifyEmail')->subject('Yêu cầu xác nhận email');
    }
}
