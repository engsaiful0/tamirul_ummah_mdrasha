<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    public function __construct($data, $senderEmail, $senderName)
    {
        $this->data = $data;
        $this->senderEmail = $senderEmail;
        $this->senderName = $senderName;
    }

    // /**
    //  * Build the message.
    //  *
    //  * @return $this
    //  */
    public function build()
    {
        return $this->from($this->senderEmail, $this->senderName)
                    ->view('emails.otpEmailTemplate')
                    ->subject('OTP');
    }
}

