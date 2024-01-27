<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\orderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //get all product list
    public function products (){
        $products = Product::get();
        return response()->json($products, 200);
    }

    //get all category list
    public function category(){
        $category = Category::get();
        return response()->json($category, 200);
    }

    //get all user list
    public function user(){
        $user = User::get();
        return response()->json($user, 200);
    }

    //get all order list
    public function order(){
        $order = Order::get();
        return response()->json($order, 200);
    }

    //get all order_list list
    public function order_list(){
        $order_list = orderList::get();
        return response()->json($order_list, 200);
    }

    //get all contact list
    public function contact(){
        $contact = Contact::get();
        return response()->json($contact, 200);
    }

    //category create
    public function createCategory(Request $request){
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' =>Carbon::now()
        ];

        $response = Category::create($data);
        return response()->json($response, 200);
    }

    //Contact create
    public function createContact (Request $request){
        $contactData = [
            'name' =>$request->name ,
            'email' => $request->email,
            'message' => $request->message
        ];

        $response = Contact::create($contactData);

        return response()->json($response, 200);
    }

    //delete category
    public function deleteCategory(Request $request){
        $data = Category::where('id',$request->category_id)->first();

        if(isset($data)){
            Category::where('id',$request->category_id)->delete();
            return response()->json(['status'=> true ,'message' => "delete success"], 200 );
        }

        return response()->json(['status'=> false ,'message' => "there is no category"], 200 );
    }

    //category details
    public function categoryDetails($id){
        $data = Category::where('id',$id)->first();

        if(isset($data)){
            return response()->json(['status'=> true ,'category' => $data], 200 );
        }

        return response()->json(['status'=> false ,'message' => "there is no category"], 404 );
    }

    //update category
    public function updateCategory(Request $request){
        $categoryId= $request->category_id;
        $DbSource = Category::where('id',$categoryId)->first();

        if (isset($DbSource)) {
            $data = $this->getCategoryData($request);
            Category::where('id',$categoryId)->update($data);
            $response = Category::where('id',$categoryId)->first();
            return response()->json(['status'=> true ,'message' => 'category update success','category' => $response], 200 );
        }
        return response()->json(['status'=> false ,'message' => 'there is no category for update'], 404 );
    }

    //get category data
    private function getCategoryData($request){
        return [
            'name' => $request->category_name ,
            'updated_at' => Carbon::now()
        ];
    }
}
