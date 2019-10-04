<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Illuminate\Support\Facades\Session;
//use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;
use RealRashid\SweetAlert\Facades\Alert;


class LoginController extends Controller
{
    //
    public function login()
    {
        if(Sentinel::check()){
            return redirect('/');
        }
        else{
            return view('front.login');
        }
    }

    public function redirectToProvider($service)
    {

        return Socialite::driver($service)->redirect();
    }

    /**
     * Obtain the user information from provider(google/facebook).
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($service)
    {

        try{
            if ($service == 'facebook') {
                $client = Socialite::driver($service)->fields([
                    'id',
                    'name',
                    // 'first_name',
                    // 'last_name',
                    'email'
                ])->user();
                
            }
            
            elseif($service == 'google') {
                
                $client = Socialite::driver($service)->user();
//            $client has all the information of the provider
            }

//       if we already have a user, grab that user....
            $user = User::where('provider_id', $client->getId())
            ->first();
// dd($user);
//...else create the user
            if (!$user) {
                if(!(User::where('email',$client->getEmail())->first())){
                
                
//        add user to database
                $user = User::create([

                    'name' => $client->getName(),
                    'email' => $client->getEmail(),
                    'provider_id' => $client->getId(),

                ]);
//            dd($user);
                $activation = Activation::create($user);
                Activation::complete($user, $activation->code);
                $role = Sentinel::findRoleBySlug('user');
                $role->users()->attach($user);

//            Sentinel::registerAndActivate($user);
//            Sentinel::authenticateAndRemember($user);
}

                else{
                    Alert::error('Login Failed','Email Address Already In Use');
                    return redirect('/login');
                }
            }
           
//        log the user in
//        Auth::login($user, true);
            Sentinel::loginAndRemember($user);
            return redirect('/');
            
        }
        catch (InvalidStateException $e){
            return redirect('/');
        }
        catch (ThrottlingException $e) {
            $delay = $e->getDelay();
            return response()->json(['error' => "You are delayed for $delay seconds"], 500);
        }
    }

    public function postLogin(Request $request)
    {
        try {
            $rememberMe = false;
            if (isset($request->remember_me))
                $rememberMe = true;
            if (Sentinel::authenticate($request->all(), $rememberMe)) {
                $slug = Sentinel::getUser()->roles()->first()->slug;
                if ($slug == 'superAdmin')
                    return response()->json(['message' => 'success', 'route' => '/dashboard'], 200);
                elseif ($slug == 'admin')
                    return response()->json(['message' => 'success', 'route' => '/dashboard'], 200);
                elseif ($slug == 'editor')
                    return response()->json(['message' => 'success', 'route' => '/dashboard'], 200);
                elseif ($slug == 'user')
                    return response()->json(['message' => 'success', 'route' => '/'], 200);
                else
                    return Sentinel::check();
            } else {
                return response()->json(['error' => 'Wrong Credentials'], 500);
            }
        } catch (ThrottlingException $e) {
            $delay = $e->getDelay();
            return response()->json(['error' => "You are delayed for $delay seconds"], 500);
        } catch (NotActivatedException $e) {
            return response()->json(['error' => 'Account Not Activated'], 500);
        }
    }

    public function logout()
    {
        Session::flush();
        Sentinel::logout();
        return redirect('/login');
    }

    public function front_logout()
    {
        Session::flush();
        Sentinel::logout();
        return redirect('/index');
    }
    public function forget_password()
    {
        if(Sentinel::check()){
            return redirect('/');
        }
        else{
            return view('front.forget');
        }
    }

    public function post_forget_password(Request $request)
    {
//        dd($request);
        if (Sentinel::check() == true) {
            return redirect('/');
        }
        if($user = User::whereEmail($request->email)->first()){
            $reminder = Reminder::exists($user) ?: Reminder:: create($user);
            $data = ['email' => $request->email, 'code' => $reminder->code];
            Mail::to($request->email)->send(new ForgotPasswordMail($data));
            Alert::success('Mail Sent', 'Check Your email to change the password');
            return redirect()->back();
        }
        else{
            Alert::error('Invalid User','Please sign-up with us first!');
            return redirect()->back();
        }

    }

    public function reset($email, $code){
        $user=User::whereEmail($email)->first();
        if($reminder=Reminder::exists($user)){
            if($code==$reminder->code){
                return view('front.reset_password',compact('email','code'));
            }
            else{
                Alert::warning('Error','Password Reset Failed!');
                return redirect('/');
            }
        }
        else{
            Alert::warning('Error','Password Reset Failed!');
            return redirect('/');
        }
    }

    public function post_reset(Request $request, $email, $code){
        $user=User::whereEmail($email)->first();
//        if(count($user)==0){
//            abort(404);
//        }
//        $sentinelUser=Sentinel::findById($user->id);
        if($reminder=Reminder::exists($user)){
            if($code==$reminder->code){
                Reminder::complete($user, $code, $request->password);
                Activation::complete($user, $code);
                Alert::success('Password Changed','Please Login with your new Password');
                return redirect('/login');
            }
            else{
                Alert::warning('Error','Password Reset Failed!');
                return redirect('/');
            }
        }
        else{
            Alert::warning('Error','Password Reset Failed!');
            return redirect('/');
        }
    }

}
