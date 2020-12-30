<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    public $username;
    public $activation_url;
    public $site_url;
    public $otp;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username,$activation_url,$site_url, $otpPin)
    {
        $this->username       = $username;
        $this->activation_url = $activation_url;
        $this->site_url       = $site_url;
        $this->otp            = $otpPin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        return $this->subject('Reset password mail')->view('email.resetPasswordTmpl');
    }
}
