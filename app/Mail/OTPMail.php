<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OTPMail extends Mailable
{
    use Queueable, SerializesModels;

    public $OTP;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($OTP)
    {
        $this->OTP = $OTP;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('OTP')->with(['OTP' => $this->OTP]);
    }
}
