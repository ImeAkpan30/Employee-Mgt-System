<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Contact;
use Mail;

class ContactController extends Controller
{
    public function getContact() {
        return view('contact-mgt.contactUs');
    }

    public function saveContact(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        Contact::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'subject' => $request['subject'],
            'phone_number' => $request['phone_number'],
            'message' => $request['message']
        ]);

        // $contact = new Contact;

        // $contact->name = $request->name;
        // $contact->email = $request->email;
        // $contact->subject = $request->subject;
        // $contact->phone_number = $request->phone_number;
        // $contact->message = $request->message;

        // $contact->save();
        Mail::send('contact_email', array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'subject' => $request->get('subject'),
            'phone_number' => $request->get('phone_number'),
            'user_message' => $request->get('message'),
        ), function($message) use ($request)
            {
                $message->from($request->get('email'))->to('imeakpan5050@gmail.com')->subject($request->get('subject'));


            });

        return redirect()->back()->with('success', 'Thank you for contacting us!');

    }
}
