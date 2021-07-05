<?php

namespace App\Mail;

use App\Leave;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\HtmlString;
use Illuminate\Queue\SerializesModels;

class LeaveRejectNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $leave;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Leave $leave)
    {
        //
        $this->leave = $leave;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Leave Reject Notification from EMS")->markdown('emails.leave.leave-reject');
    }
}

