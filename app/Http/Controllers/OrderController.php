<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //direct order list page
    public function orderList(){
        $orders = Order::select('orders.*','users.name as user_name')
                ->leftJoin('users','users.id','orders.user_id')
                ->orderBy('created_at','desc')
                ->get();
        // dd($orders->toArray());
        return view('admin.order.list',compact('orders'));
    }

    //sort with status
    public function orderChangeStatus(Request $request){
        //->orWhere('orders.status',$status)->get()
        //dd($request->all());

        $orders = Order::select('orders.*','users.name as user_name')
                ->leftJoin('users','users.id','orders.user_id')
                ->orderBy('created_at','desc');

        if($request->orderStatus == null){
            $orders = $orders->get();
        }else{
            $orders = $orders->where('orders.status',$request->orderStatus)->get();
        }

        return view('admin.order.list',compact('orders'));
    }

    public function ajaxChangeStatus(Request $request){
        logger($request);
        Order::where('id',$request->orderId)->update([
            'status' => $request->currentStatus
        ]);

        // $orders = Order::select('orders.*','users.name as user_name')
        //         ->leftJoin('users','users.id','orders.user_id')
        //         ->orderBy('created_at','desc')
        //         ->get();

        // return response()->json()
    }

    //order info
    public function listInfo($orderCode){
        $orderTotal = Order::where('oder_code',$orderCode)->first();
        $orderList = OrderList::select('order_lists.*','users.name as user_name','products.image as product_image','products.name as product_name','products.price as product_price')
                    ->leftJoin('users','users.id','order_lists.user_id')
                    ->leftJoin('products','products.id','order_lists.product_id')
                    ->where('order_code',$orderCode)
                    ->get();

        return view('admin.order.productList',compact('orderList','orderTotal'));
    }
}
