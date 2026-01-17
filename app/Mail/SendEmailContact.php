<?php
  
namespace App\Mail;
  
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
  
class SendEmailContact extends Mailable
{
    use Queueable, SerializesModels;
  
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $name;
    public $email;
    public $subject;
    public $emailMessage;
    
    public function __construct($name, $email, $subject, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->subject = $subject;
        $this->emailMessage = $message;
    }
  
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('backEnd.emails.contactEmail');
    }
}