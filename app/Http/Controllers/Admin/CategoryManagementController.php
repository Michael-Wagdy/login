<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Validator;
class CategoryManagementController extends Controller
{
    
    public function index(){
        
        $categories = Category::all();
        
        return view('admin.category.index',compact('categories'));

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
            'name' => ['required', 'string', 'max:255','unique:categories'],
           
        ]);

    }



    public function create(){
        $categories = Category::all();
        return  view('admin.category.create',compact('categories'));
        }

    public function store(Request $request){


        $this->validator($request->all())->validate();      
        
         Category::create([
            'name' => $request['name'],
            'parent_id'=> $request['parent']
              ]);
        return back()->with('sucess','you have created an agency accounts');

    }


    
    public function edit($id){
        
        $category = Category::find($id);
        $categories = Category::all();
        return view('admin.category.edit',compact('category','categories'));

    }
    
    public function update(Request $request){

        $this->validator($request->all())->validate();    
           
        $category = Category::find($request->id);
        
        $category->update([
            'name' => $request['name'],
            'parent_id'=>$request['parent']
        ]);
        return back()->with('sucess','you have updated an agency accounts');

    }
    public function destory($id){
        $categorry= Category::findOrFail($id)->delete();
        return response()->json(['message'=> 'you have deleted a category']);
    }

}
