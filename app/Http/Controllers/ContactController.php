<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    
    public function show() {

        return view('contact');

    }

    public function store() {

        request()->validate(['email'=>'required|email']);
        Mail::raw('plain text message', function ($message) {

            $message->from('admin@gmail.com', 'John Doe');
            $message->to(request('email'), '');
            $message->subject('Contact Email ');
 
        });

        return redirect('/contact')->with('message','Email sent!!!');
            


    }

}
