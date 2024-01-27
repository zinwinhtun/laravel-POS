<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\orderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //direct order list page
    public function list(){
        $order = Order::select('orders.*','users.name as user_name')
        ->when(request('key'),function($query){
            $query->where('orders.order_code','like','%'.request('key').'%');
        })
        ->leftJoin('users','users.id','orders.user_id')
        ->orderBy('created_at','desc')
        ->get();
        return view('admin.order.list',compact('order'));
    }

    // Ajax Status function 012
    public function changeStatus(Request $request){
        $order = Order::select('orders.*','users.name as user_name')
                ->when(request('key'),function($query){
                    $query->where('orders.order_code','like','%'.request('key').'%');
                })
                ->leftJoin('users','users.id','orders.user_id')
                ->orderBy('created_at','desc');

        if($request->orderStatus == "all"){
            $order = $order->get();
        }else{
            $order = $order->where('orders.status',$request->orderStatus)->get();
        }

        return view('admin.order.list',compact('order'));
    }

    //ajax order change status
    public function ajaxStatusChange(Request $request){
        Order::where('id',$request->orderId)->update([
            'status' => $request->status
        ]);

        $order = Order::select('orders.*','users.name as user_name')
                ->when(request('key'),function($query){
                    $query->where('orders.order_code','like','%'.request('key').'%');
                })
                ->leftJoin('users','users.id','orders.user_id')
                ->orderBy('created_at','desc');
        return response()->json($order,200);
    }

    //order list info
    public function listInfo($orderCode){
        $order = Order::where('order_code',$orderCode)->first();
        $orderList = orderList::select('order_lists.*','users.name','products.name as product_name','products.image as product_image')
        ->leftjoin('users','users.id','order_lists.user_id')
        ->leftJoin('products','products.id','order_lists.product_id')
        ->where('order_code',$orderCode)
        ->get();
        // dd($orderList->toArray());
        return view('admin.order.productList',compact('orderList','order'));
    }

}
