<?php

namespace App\Mail;

use App\Employee;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $mail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Mail $mail)
    {
        $this->mail = $mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('notification.emails')
        ->attach('attachment');
    }

    // public function build()
    // {
    //     // return $this->to($this->mail->email, 'Employee')
    //                 // ->subject('Contact Notification From FxHup ')
    //                 return $this->markdown('notification.mail');
    // }

}
