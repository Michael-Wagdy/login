<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\services\CategoryServices;
class CategoryManagementController extends Controller
{
    protected $categoryService;
    public function __construct(){
        $this->categoryService = new CategoryServices;
    }
    public function index(){
        
        $categories = Category::all();
        
        return view('admin.category.index',compact('categories'));

    }


    public function create(){
        $categories = Category::all();
        return  view('admin.category.create',compact('categories'));
        }

    public function store(Request $request){

        $this->categoryService->create($request);
        return back()->with('sucess','you have created an agency accounts');

    }


    
    public function edit($id){
        
        $category = Category::find($id);
        $categories = Category::all();
        return view('admin.category.edit',compact('category','categories'));

    }
    
    public function update(Request $request){

        $this->categoryService->update($request);
        return back()->with('sucess','you have updated an agency accounts');

    }
    public function destory($id){
        $categorry= Category::findOrFail($id)->delete();
        return response()->json(['message'=> 'you have deleted a category']);
    }

}
