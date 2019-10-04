<?php

namespace App\Http\Controllers;

use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use App\User;
use RealRashid\SweetAlert\Facades\Alert;


class ActivationController extends Controller
{
    //
    public function activate($email, $activationCode){
            $user=User::whereEmail($email)->first();

            if (Activation::complete($user, $activationCode))
            {
                    Alert::success('Account Activated','Login to Shop With Us.');
                    return redirect('/login');
            }else{
                    return redirect('/');
            }
    }
}
