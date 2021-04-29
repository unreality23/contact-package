<?php

namespace Vaidotas\Contact\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Vaidotas\Contact\Models\Contact;
use Vaidotas\Contact\Mail\ContactMailable;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact::contact');
    }

    public function send(Request $request)
    {
        Mail::to(config('contact.send_email_to'))->send(new ContactMailable($request->message, $request->name, $request->email));
        Contact::create($request->all());
        return redirect(route('contact'));
    }
}
