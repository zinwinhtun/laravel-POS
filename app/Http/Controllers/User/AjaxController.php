<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\orderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //pizza list
    public function pizzaList(Request $request){

        if ($request->status == "desc") {
            $data = Product::orderBy('created_at','desc')->get();
        }else{
            $data = Product::orderBy('created_at','asc')->get();
        }
        return response()->json($data,200);
    }

    //add to cart
    public function addToCart(Request $request){
        $data = $this->getOrderData($request);
        Cart::create($data);
        $response = [
            'message' =>'Add to cart complete',
            'status' => 'success'
        ];

        return response()->json($response,200);
    }

    //order function
    public function order(Request $request){
        $total = 0;
        foreach ($request->all() as $item) {
           $data =  orderList::create($item);
           $total += $data->total;
        };

        Cart::where('user_id', Auth::user()->id)->delete();

        Order::create([
                'user_id' =>Auth::user()->id,
                'order_code' => $data->order_code,
                'total_price' => $total+2000,
        ]);

        return response()->json([
            'status' => 'true',
            'message' => 'order complete'
        ],200);
    }

    //delete cart
    public function deleteCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    //delete order
    public function deleteOrder(Request $request){
        Cart::where('user_id',Auth::user()->id)->where('id',$request->orderId)
        ->where('product_id',$request->productId)->delete();
    }

    //increase product view count functio
    public function increaseViewCount(Request $request){
        $product = Product::where('id',$request->pizzaId)->first();
        $viewCount = [
            'view_count' => $product->view_count + 1
        ];

        Product::where('id',$request->pizzaId)->update($viewCount);
    }

    // getOrderData function
    private function getOrderData($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId ,
            'qty' => $request->count ,
            'created_at' =>Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
