<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direst category page
    public function list(){
        $categories = Category::when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%');
        })
        ->orderBy('id','desc')
        ->paginate(5);
        return view('admin.category.list',compact('categories'));
    }
    //direct category create page
    public function createPage(){
       return view('admin.category.create');
    }

    //direct category list create
    public function create(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->RequestValidationCheck($request);
        Category::create($data);
        return redirect()->route('category#list');
    }

    //delete category
    public function delete($id){
        Category::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Category Remove Successfully.... ']);
    }

    //edit page
    public function edit($id){
        $categories= Category::where('id',$id)->first();
        return view('admin.category.edit',compact('categories'));
    }
    //update function
    public function update(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->RequestValidationCheck($request);
        Category::where('id',$request->categoryId)->update($data);
        return redirect()->route('category#list');
    }

    // category validaion check
    private function categoryValidationCheck($request){
        Validator::make($request->all(),[
            'category_name' => 'required|unique:categories,name,'.$request->categoryId
        ])->validate();
    }

    //request validation check
    private function RequestValidationCheck($request){
        return[
            'name' => $request->category_name
        ];
    }
}
