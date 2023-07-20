<?php

namespace App\Http\Controllers;

use App\Mail\SendMessage;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'seeker']); // Remove 'verified' middleware here
    }

    public function showContact()
    {
        return view('profile.contact');
    }

    public function sendMessage(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ];

        $request->validate($rules);

        $name = $request->name;
        $email = $request->email;
        $subject = $request->subject;
        $content  = $request->message;
        // Save the message data to the database using the Message model.
        $message = new Message();
        $message->name = $name;
        $message->email = $email;
        $message->subject = $subject;
        $message->content = $content;
        $message->save();


        Mail::to('devabdelr2hman@gmail.com')->send(new SendMessage($name, $email, $subject, $content ));

        return redirect()->back()->with('successMessage', 'Message sent successfully!');
    }
}
