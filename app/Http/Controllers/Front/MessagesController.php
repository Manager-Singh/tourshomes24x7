<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\MessageReceived;

class MessagesController extends Controller
{
    public function store()
    {
        request()->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email'
        ]);
        $user = User::find(request('id'));
        $name = request('name');
        $phone = request('phone');
        $email = request('email');
        $message = request('message');
        $user->notify(new MessageReceived($name,$phone,$email,$message));
        return redirect()->back()->with('message','Your message is successfully sent!');
    }
}
