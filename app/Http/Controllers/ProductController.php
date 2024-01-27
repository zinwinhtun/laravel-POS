<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //list function
    public function list(){
        $pizzas = Product::select('products.*','products.name as product_name','categories.name as category_name')
        ->when(request('key'),function($query){
            $query->where('products.name','like','%'.request('key').'%');
        })
        ->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('products.created_at','desc')
        ->paginate(3);
        $pizzas->appends(request()->query());
        return view('admin.products.productList',compact('pizzas'));
    }
    // create pizza list
    public function createPage(){
        $categories = Category::select('id','name')->get();
        return view('admin.products.create',compact('categories'));
    }
    //create pizza function
    public function create(Request $request){
        $this->productValidationCheck($request,"create");
        $date = $this->requestProductInfo($request);

        //image add and storage
            $fileName = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$fileName);
            $date['image'] = $fileName;

        Product::create($date);
        return redirect()->route('product#list')->with(['createSuccess'=> 'Create Success...']);
    }

    //delete product
    public function delete($id){
        Product::where('id',$id)->delete();
        return redirect()->route('product#list');
    }

    //view pizza detail
    public function view($id){
        $pizza= Product::select('products.*','categories.name as category_name')
        ->join('categories','products.category_id','categories.id')
        ->where('products.id',$id)->first();
        return view('admin.products.view',compact('pizza'));
    }

    //edit product
    public function edit(Request $request,$id){
        $pizza= Product::where('id',$id)->first();
        $category = Category::get();
        return view('admin.products.edit',compact('pizza','category'));
    }

    // update pizza
    public function update(Request $request){
        $this->productValidationCheck($request,"update");
        $data =  $this->requestProductInfo($request);

        if($request->hasFile('pizzaImage')){
            $oldImageName  = Product::where('id',$request->pizzaId)->first();
            $oldImageName = $oldImageName->image;

            if($oldImageName != null){
                Storage::delete('public/'.$oldImageName);
            }

            $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public/',$fileName);
            $data['image'] = $fileName;
        }

        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('product#list');
    }

    //Request Product Info
    private function requestProductInfo($request){
        return [
            'category_id' => $request->pizzaCategory,
            'name' => $request->pizzaName,
            'description' => $request->pizzaDescription,
            'price' =>$request->pizzaPrice,
            'waiting_time' => $request->pizzaWaitingTime
        ];
    }

    // Product Validation Check
    private function productValidationCheck($request,$action){
        $validationRule =[
            'pizzaName' => 'required|unique:products,name,'. $request->pizzaId ,
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required|min:10',
            'pizzaWaitingTime' => 'required',
            'pizzaPrice' => 'required|max:6',
        ];

        $validationRule ['pizzaImage'] =$action == "create" ? 'required|mimes:png,jpg,jpeg|file': 'mimes:png,jpg,jpeg|file';

       Validator::make($request->all(),$validationRule)->validate();
    }
}
