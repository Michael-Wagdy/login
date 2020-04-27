<?php

namespace App\Http\Controllers\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use app\User;
use Illuminate\Http\UploadedFile;




class UserController extends Controller
{

    public function show()
    {
        # code...
        $user = Auth::user();
        return view('auth.user.profile.index',compact('user'));
    }
    public function edit(){
        $user = Auth::user();
        return view('auth.user.profile.edit',compact('user'));
    }
       /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $request)
    {
        
        return Validator::make($request, [
            'frist_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string','min:11', 'max:12'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'gender'=> 'in:male,female',
            'avatar' => 'image|max:1999',
            'dob' => ['date'],
        
        ]);
    }
    public function update(Request $request)  {
        
        if($request->hasFile('avatar')){
            $avatar= $request->file('avatar');
            $filename=time().'.'.$avatar->getClientOriginalExtension();
           $avatar->storeAs('public/uploads/avatars',$filename);
         
        }
        
        $this->validator($request->all())->validate();

             Auth::user()->update([
            'frist_name' => $request['frist_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'telephone' => $request['telephone'],
            'gender' => $request['gender'],
            'dob' => $request['dob'],
            'avatar'=>$filename,
        ]);
        return back();
    }

    public function updatePasswordView(){
        return view('auth.user.profile.passwordChange');
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

