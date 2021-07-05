<?php

namespace App\Mail;

use App\Leave;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\HtmlString;
use Illuminate\Queue\SerializesModels;

class LeaveApprovalNotification extends Mailable
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
        return $this->subject("Leave Approval Notification from EMS")->markdown('emails.leave.leave-approval');
    }
}

