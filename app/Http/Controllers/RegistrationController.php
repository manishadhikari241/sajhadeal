<?php

namespace App\Http\Controllers;


use App\Mail\ActivationMail;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use RealRashid\SweetAlert\Facades\Alert;

class RegistrationController extends Controller
{
    //
    public function register()
    {


        return view('front.register');
    }

    public function postRegister(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'email' => 'required|max:255|unique:users',
//            'name' => 'required',
            'phone' => ['required','string','digits:10'],
            'password' => 'required|min:5',
        ])->validate();
        $user = Sentinel::register($request->all());
        $activation = Activation::create($user);
        $role = Sentinel::findRoleBySlug('user');
        $role->users()->attach($user);
        $data=['email'=>$request->email,'code'=>$activation->code];
        Mail::to($user->email)->send(new ActivationMail($data));
//        $this->sendEmail($user, $activation->code);
        Alert::success('Account Created','Check your email to activate your account');
        return redirect('/');
    }

//    private function sendEmail($user, $code)
//    {
//        Mail::send('emails.activation', [
//            'user' => $user,
//            'code' => $code
//        ],function ($message) use($user){
//            $message->to($user->email);
//            $message->subject("Hello $user->first_name Activate your account");
//        });
//    }
}
