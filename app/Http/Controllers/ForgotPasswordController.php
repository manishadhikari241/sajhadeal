<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function forgotPassword(){
        return view('authentication.forgotPassword');
    }
    public function postForgotPassword(Request $request){
        $user=User::whereEmail($request->email)->first();

        if (count($user)==0){
            return redirect()->back()->with([
                'success'=>'Reset code successfully sent to your email'
            ]);
        }
        $reminder=Reminder::exists($user) ?:Reminder::create($user);
        $this->sendEmail($user, $reminder->code);
        return redirect()->back()->with([
            'success'=>'Reset code successfully sent to your email'
        ]);
    }
    public function resetPassword($email, $resetCode){
        $user=User::whereEmail($email)->first();
        if (count($user)==0){
                return 'email not matched';
        }
        if ($reminder=Reminder::exists($user)){
            if ($resetCode==$reminder->code){
                return view('authentication.resetPassword');
            }else
                return redirect('/');
        }else
            return redirect('/');
    }
    public function postResetPassword(Request $request, $email, $resetCode){
        return $request;
    }
    private function sendEmail($user, $code){
        Mail::send('emails.forgotPassword',[
            'user'=>$user,
            'code'=>$code
        ],function ($message) use($user){
            $message->to($user->email);
            $message->subject("Hello $user->first_name reset your Password");
        });
    }
}
