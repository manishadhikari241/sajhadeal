<?php

namespace App\Http\Controllers;

use App\Admin;
use App\User;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    //
    public function check(){
        $user = Sentinel::getUser();
        $admin = $user->admin;

        Session::put('user', $admin);
//        $applicant=Student::all();
//        $applicantNumber=count($applicant);
//        $student=Student::where('user_id', '<>', '')->get();
//        $studentNumber=count($student);
//        $number=($studentNumber/$applicantNumber)*100;
//        $leadconversion = number_format((float)$number, 2, '.', '');

        return view('admin.dashboardAdmin');
    }

    public function all_users(){
        $role = Sentinel::findRoleBySlug('user');
        $users = $role->users()->with('roles')->get();
//        dd($users);
        //for edit roles table of user
        $roles = Sentinel::getRoleRepository()->all();
        return view('admin.display.all_users',compact('users','roles'));
    }
    
    public function edit_role(Request $request, $id)
    {
        $user = User::find($id);
        $user->roles()->sync($request->roles);
        return redirect()->back()->with('success','Role Changed');
    }

    public function addProfile()
    {
        $user = Sentinel::getUser();
        if (isset($user->admin->image)) {
            $user = Sentinel::getUser();
            $admin = $user->admin;

            return view('admin.profile.profile', compact('admin'));

        } else {
            return view('admin.profile.addProfile');
        }

    }

    public function postProfile(Request $request)
    {

        $user = Sentinel::getUser();
        $user_id = $user->id;
        $first_name = $user->first_name;
        $last_name = $user->last_name;
        $email = $user->email;

        $applicant = new Admin();
        $applicant->first_name = $first_name;
        $applicant->last_name = $last_name;
        $applicant->user_id = $user_id;
        $applicant->dob = $request->dob;
        $applicant->email = $email;
        $applicant->mobile = $request->mobile;
        $applicant->district = $request->district;
        $applicant->town = $request->town;
        $applicant->ward_no = $request->ward_no;
        $applicant->gender = $request->gender;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
//        $filename= $thumbnail->getClientOriginalExtension();

            $image->move(public_path() . '/admin/img/admin', $fileName);
            $applicant->image = 'admin/img/admin/' . $fileName;
        }
        $applicant->save();
        return redirect()->back();

    }

    public function viewProfile()
    {

    }

    public function profileEdit(Request $request, $id)
    {

        $applicant = Admin::findorfail($id);
        $applicant->first_name = $request->first_name;
        $applicant->last_name = $request->last_name;
        $applicant->dob = $request->dob;
        $applicant->mobile = $request->mobile;
        $applicant->district = $request->district;
        $applicant->town = $request->town;
        $applicant->ward_no = $request->ward_no;
        $applicant->gender = $request->gender;
        $oldimg = $applicant->image;
        if (!$request->image == null) {
            if (file_exists($oldimg)) {
                unlink($oldimg);
            }
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $fileName = time() . '.' . $image->getClientOriginalExtension();
//        $filename= $thumbnail->getClientOriginalExtension();

                $image->move(public_path() . '/admin/img/admin', $fileName);
                $applicant->image = 'admin/img/admin/' . $fileName;
            }
        }
        $applicant->save();
        $user = Sentinel::getUser();
        $admin = $user->instructor;
//        dd($instructor);

        Session::put('user', $admin);
        return redirect()->back();
    }

    public function changePswd(Request $request)
    {
        $user = Sentinel::getUser();
        if ($request['current_password'] != "") {
            if (!(Hash::check($request['current_password'], $user->password))) {
                return redirect()->back()->with('error', "You're a THIEF");
            }
            if ($request['current_password'] == $request['new_password']) {

                return redirect()->back()->with('error', "Same password");
            }

            $user->password = bcrypt($request->new_password);
            $user->save();
        }
        return redirect()->back();
    }

    public function changeClientProfile(Request $request)
    {
        $user = Sentinel::getUser();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->save();
        return redirect()->back();
    }

    public function returnBack()
    {
        return redirect()->back();
    }
}
