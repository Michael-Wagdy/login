<?php

namespace App\Services;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Validator;


class CategoryServices {



    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255','unique:categories'],
            'parent_id' =>['present']
           
        ]);

    }

    public function index(){
        $category = Category::all();

    }
    public function create(Request $request){

        $this->validator($request->all())->validate();      
        
         Category::create([
            'name' => $request['name'],
            'parent_id'=> $request['parent']
              ]);

    }


    public function update(Request $request){

        $this->validator($request->all())->validate();    
        $category = Category::findOrFail($request->id);
        
        $category->update([
            'name' => $request['name'],
            'parent_id'=>$request['parent']
        ]);
    }

}