<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $filename = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        
        if($request->hasFile('avatar')){
            $avatar= $request->file('avatar');
            $filename=time().'.'.$avatar->getClientOriginalExtension();
            $this->filename=  $filename;

            $avatar->storeAs('public/uploads/avatars',$filename);
            }


        $this->middleware('guest');
       
            
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
            'avatar' => 'image|max:1999',
            'dob' => ['date'],
        ]);
    }

    public function uploadFile(Request $request){
      
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $request
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        return User::create([
            'frist_name' => $data['frist_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'telephone' => $data['telephone'],
            'gender' => $data['gender'],
            'password' => Hash::make($data['password']),
            'dob' => $data['dob'],
            'avatar'=>$this->filename,

        ]);
    }


       /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.user.register');
    }
}
