<?php

namespace App\Http\Controllers\Auth\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{



    public function updatePasswordView(){
        return view('auth.user.profile');
    }

    public function updatePassword(Request $request ){
        
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
        $user = Auth::user();   //get db User data   
        if(Hash::check($oldPassword, $user->password)) {   
            $user->password = bcrypt($request->get('password'));
            $user->save();
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


}

