<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\BookingRequest;

class BookingRequestController extends Controller
{
    public function store()
    {
        request()->validate([
            'date' => 'required',
            'time' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'message'=>'required'
        ]);

        $user = User::find(request('id'));

        $title = request('title');
        $address = request('address');
        $date = request('date');
        $time = request('time');
        $name = request('name');
        $phone = request('phone');
        $email = request('email');
        $message = request('message');
        $user->notify(new BookingRequest($title,$address,$date,$time,$name,$phone,$email,$message));
        return redirect()->back()->with('message','Your request is successfully submitted!');
    }
}
