<?php

namespace App\Http\Controllers\auth\admin;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;

use Gate;
use App\Admin as AppAdmin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    //
    public function login(){
        //check if there is already user logged in from this browser
        abort_if(Gate::denies(Auth::user()), redirect('home'));
        // abort_if(Gate::denies(Auth::guard('webadmin')), redirect('home'));

        return view('auth.admin.login');

    }
    public function login_post(){
        abort_if(Gate::denies(Auth::user()), redirect('home'));

        if (Auth::guard('webadmin')->attempt(['email' => request('email'), 'password' => request('password')])) {
            // Authentication passed...
            return redirect('admin/dashboard');
        }else{
            return back();
        }

    }
    public function updatePasswordView(){
        abort_if(Gate::denies(Auth::user()), redirect('home'));

        return view('auth.admin.profile');
    }

    public function updatePassword(Request $request ){
        abort_if(Gate::denies(Auth::user()), redirect('home'));

        $oldPassword = $request['old_password'];
        $password = $request['password'];
        $passwordConfiramtion = $request['password_confirmation'];

        //check if the new password = confirmation
        
        if($password === $passwordConfiramtion){
            
        $validatedData = $request->validate([
            'old_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);
        // check if the old password is right
        $admin = Auth::guard('webadmin')->user() ;  //get db User data   
        if(Hash::check($oldPassword, $admin->password)) {   
            $admin->password = bcrypt($request->get('password'));
            $admin->save();
            return redirect()->back()->with("success","Password changed successfully !");
    } else {
        return redirect()->back()->with("error","you entered wrong password !");
    }
            // return "password match";

        }
        else{
            return redirect()->back()->with("error","password is not matching !");
        }
     

}
    public function countAdmins(){
        abort_if(Gate::denies(Auth::user()), redirect('home'));
        
        // $noOfAdmins = count(AppAdmin::get('name'));
        // return "there are".$noOfAdmins . "  registered";


        return view('auth.admin.dashboard');
    }


}

