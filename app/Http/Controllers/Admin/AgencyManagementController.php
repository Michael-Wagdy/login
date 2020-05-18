<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Agency;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class AgencyManagementController extends Controller
{
    
    public function index(){
        
        $agenies = Agency::all();
        
        return view('admin.agenciesManagement.index',compact('agenies'));

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['sometimes', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string','min:11', 'max:12'],
            'address' => ['required', 'string', 'max:255'],
            'country'=>  ['required', 'string', 'min:3'],
            'photo'=> 'image|max:1999'

        ]);

    }



    public function create(){
        return  view('admin.agenciesManagement.create');
        }

    public function store(Request $request){


        $this->validator($request->all())->validate();

        if($request->hasFile('photo')){
            $photo= $request->file('photo');
            $filename=time().'.'.$photo->getClientOriginalExtension();
           $photo->storeAs('public/uploads/photo',$filename);
         
        }
        
        
        
         Agency::create([
            'name' => $request['name'],
            'address' => $request['address'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'country' => $request['country'],
            'password' => Hash::make($request['password']),
            'photo'=>$filename,

        ]);
        return back()->with('sucess','you have created an agency accounts');

    }


    
    public function edit($id){
        
        $agency = Agency::find($id);
        
        return view('admin.agenciesManagement.edit',compact('agency'));

    }
    
    public function update(Request $request){

        $this->validator($request->all())->validate();

        if($request->hasFile('photo')){
            $photo= $request->file('photo');
            $filename=time().'.'.$photo->getClientOriginalExtension();
           $photo->storeAs('public/uploads/photo',$filename);
         
        }
        
        $agency = Agency::find($request->id);
        
        $agency->update([
            'name' => $request['name'],
            'address' => $request['address'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'country' => $request['country'],
            'photo'=>$filename,

        ]);
        return back()->with('sucess','you have updated an agency accounts');

    }
    public function destory($id){
        Agency::find($id)->delete();
        return response()->json(['message'=>'agency account has been deleted ']);
    }
}
