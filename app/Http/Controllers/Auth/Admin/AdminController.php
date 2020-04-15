<?php

namespace App\Http\Controllers\auth\admin;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;

use Gate;
use App\Admin as AppAdmin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    use AuthenticatesUsers;
    //



    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        // abort_if(Gate::denies(Auth::user()), redirect('home'));

        return view('auth.admin.login');
    }


    
  
    protected function guard()
    {
        return Auth::guard('webadmin');
    }

   /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/admin/dashboard';
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

