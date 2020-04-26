<?php

namespace App\Http\Controllers\agency;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AgencyController extends Controller
{
    //
     /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['sometimes', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string','min:11', 'max:12'],
            'address' => ['required', 'string', 'max:255'],
            'country'=>  ['required', 'string', 'min:3'],
            'photo'=> 'image|max:1999'

        ]);

    }

    public function index(){

        //
    }


    public function show(){

            $agency = Auth::guard('webagency')->user();
      return  view('agency.profile.index',compact('agency'));

    }

    public function edit(){
        $agency = Auth::guard('webagency')->user();
        return   view('agency.profile.edit',compact('agency'));
    }



    public function update(Request $request){
        $this->validator($request->all())->validate();

        if($request->hasFile('photo')){
            $photo= $request->file('photo');
            $filename=time().'.'.$photo->getClientOriginalExtension();
           $photo->storeAs('public/uploads/photo',$filename);
         
        }

        $agency = Auth::guard('webagency')->user()->update([
            'name' => $request['name'],
            'address' => $request['address'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'country' => $request['country'],
            'photo'=>$filename,

        ]);
        return back()->with('sucess','you have updated an agency accounts');

    }
    }


