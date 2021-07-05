<?php

namespace App\Http\Controllers;

use App\User;
use App\Employee;
use App\Mail\SendMailable;
use Illuminate\Http\Request;
use App\Mail\MailNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\MailFormValidationRequest;

class MailController extends Controller
{
    public function sendail(MailFormValidationRequest $request)
    {
        if ($request->has('message') && ($request->has('email')))
        {
            $body = ['message' => $request->message];

            Mail::send('notification.emails', ['body'=> $body], function($message) use ($request)
            {
                $message->to($request->email,'Employee')->from('noreply@mailertrap.com', 'Admin A&M Company')->subject($request->subject)->attach($request->attachmet);

            });

            return redirect()->back()->with('success', 'Mail Sent Successfully!');
        }

    }


    public function mailPost(MailFormValidationRequest $request) {
        $data = new Mail;
        $data->email = $request->email;
        $data->subject = $request->subject;
        $data->message = $request->message;
        // $data->attachment = $request->attachment;
        // $data->save();
        Mail::to($request->email)->send(new SendMailable($data));

        return redirect()->back()->with('success', 'Mail Sent Successfully!');
    }

    // public function compose($id) {
    //     $employees = Employee::find($id);
    //     $user = User::find($id);
    //     $employees->user = $user;
    //     return view('notification.compose', compact('employees', 'user'));
    // }

    public function compose() {
        $employees = Employee::all();
        $user = User::all();
        $employees->user = $user;
        return view('notification.compose', compact('employees', 'user'));
    }


    public function sendMail(Request $request){
        // dd($request);
        $data = new Mail;
        $data->email = $request->email;
        $data->subject = $request->subject;
        $data->message = $request->message;
        // $data->attachment = $request->attachment;
        // dd($data);
        Mail::to($request->email)->send(new MailNotification($data));

        //  $data = request()->validate([
        //      'email'=>['required','email'],
        //      'subject'=>['required'],
        //      'message'=>['required'],
        //      'attachment'=>['required','mimes:jpg,png,jpeg,gif,svg,docx','max:2080'],
        //      ]);
        // $this->validate($request,[
        //         'email'=> 'required',
        //         'subject'=>'required',
        //         'message'=>'required',
        //         'attachment'=>'nullable|mimes:jpg,png,jpeg,gif,svg,docx|max:2080',
        //      ]);


            //  $emailData = array(
            //      'email'=>$request['email'],
            //      'subject'=>$request['subject'],
            //      'message'=>$request['message'],
            //      'attachment'=>$request['attachment']
            //     );
            //     view()->share(compact('emailData'));
            //     $url = $request->file('attachment');
            //     dd($emailData);

                // Log::alert($emailData);
                // Mail::send(new SendMailable($emailData), function ($message) use($data,$url){
                //     $email = $data['email'];
                //     $subject = $data['subject'];
                //     $message->to($email);
                //     $message->subject($subject);
                //     $message->attach(
                //        $url->getRealPath(),array(
                //             'as'=>$url->getClientOriginalName(),
                //             'mime'=>$url->getMimeType()	                )
                //         );
                //     $message->from('noreply@mailertrap.com', 'Admin A&M Company');
                // });
                //  $sendMail = Mail::send(new MailNotification($emailData),function ($message) use($data,$url){
                //     $email = $data['email'];
                //     $subject = $data['subject'];
                //     $message->to($email);
                //     // $message->subject($subject);
                //     $message->attach(
                //        $url->getRealPath(),array(
                //             'as'=>$url->getClientOriginalName(),
                //             'mime'=>$url->getMimeType()	                )
                //         );
                //     // $message->from('noreply@mailertrap.com', 'Admin A&M Company');
                // });

            return redirect()->back()->with('success', 'Mail Sent Successfully!');
    }
}
