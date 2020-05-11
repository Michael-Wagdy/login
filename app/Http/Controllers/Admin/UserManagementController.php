<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class UserManagementController extends Controller
{
    //

    public function index(){
        $users = User::all();
        return view('admin.users.index', compact('users'));

    }

    public function create(){
        return view('admin.users.create');
    }
 /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'frist_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string','min:11', 'max:12'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'gender'=> 'in:male,female',
            'status'=> 'boolen',
            'dob' => ['date'],
            'avatar'=> 'image|max:1999'

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function store(array $data)
    {
        $this->validator($request->all())->validate();

        if($request->hasFile('avatar')){
            $avatar= $request->file('avatar');
            $filename=time().'.'.$avatar->getClientOriginalExtension();
           $avatar->storeAs('public/uploads/avatars',$filename);
         
        }

        return User::create([
            'frist_name' => $data['frist_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'telephone' => $data['telephone'],
            'gender' => $data['gender'],
            'password' => Hash::make($data['password']),
            'dob' => $data['dob'],
            'avatar'=>$filename,

        ]);
    }
    public function update(Request $request)  {
      
      
        $this->validator($request->all())->validate();

        if($request->hasFile('avatar')){
            $avatar= $request->file('avatar');
            $filename=time().'.'.$avatar->getClientOriginalExtension();
           $avatar->storeAs('public/uploads/avatars',$filename);
         
        }
      
        
            $user = User::find($request->id);
            $user->update([
            'frist_name' => $request['frist_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'telephone' => $request['telephone'],
            'gender' => $request['gender'],
            'dob' => $request['dob'],
            'avatar'=>$filename,
            'status'=>$request['status'],
        ]);
        return back();
    }


    public function edit($id){
        $user= User::find($id);
        return view('admin.users.edit',compact('user'));
    }
    public function delete($id){
        $user= User::find($id);

        $user->delete();
        return back(); 
    }
}
