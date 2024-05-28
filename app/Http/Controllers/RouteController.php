<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    //get product list
    public function getProductList(){
        $products = Product::get();
        $user = User::get();
        $data = [
            'product' => $products,
            'user' => $user
        ];
        return response()->json($data,200);

    }

    //get category list
    public function categoryList(){
        $category = Category::get();
        return response()->json($category,200);
    }

    //get order list
    public function orderList(){
        $orderList = OrderList::get();
        return response()->json($orderList,200);
    }

    //get order
    public function order(){
        $order = Order::get();
        return response()->json($order,200);
    }

    //get contact
    public function contactList(){
        $contact = Contact::get();
        return responst()->json($contact,200);
    }

    //get all data list
    public function allData(){
        $products = Product::get();
        $user = User::get();
        $category = Category::get();
        $orderList = OrderList::get();
        $order = Order::get();
        $contact = Contact::get();

        $data = [
            'product' => $products,
            'user' => $user,
            'category' => $category,
            'orderList' => $orderList,
            'order' => $order,
            'contact' => $contact
        ];
        return response()->json($data,200);
    }

    //create category
    public function createCategory(Request $request){
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $response = Category::create($data);
        return response()->json($response,200);

    }

    //create product
    public function createProduct(Request $request){
        $categoryData = Category::where('id',$request->category_id)->first();
        if(isset($categoryData)){
            $data = [
                'category_id' => $request->category_id,
                'name' => $request->name,
                'description' => $request->description,
                'waiting_time' => $request->waiting_time,
                'price' => $request->price
            ];
            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;

            $response = Product::create($data);
            return response()->json($response,200);
        }

        return response()->json(['status' => false,'message' => 'The category that you entered is not in the list']);
    }

    //create contact
    public function createContact(Request $request){
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        $response = Contact::create($data);
        $contact = Contact::get();
        return response()->json($contact,200);

    }

    //delete category
    public function deleteCategory(Request $request){
        $data = Category::where('id',$request->category_id)->first();
        if(isset($data)){
            Category::where('id',$request->category_id)->delete();
            return response()->json(['status' => true, 'message' => 'delete success'],200);
        }

        return response()->json(['status' => false, 'message' => 'There is no data in the table']);

    }

    //delete product
    public function deleteProduct(Request $request){
        $data = Product::where('id',$request->product_id)->first();
        if(isset($data)){
            Product::where('id',$request->product_id)->delete();
            return response()->json(['status' => true,'message' => 'Delete Success']);
        }

        return response()->json(['status' => false,'message' => 'There is no product data in table']);
    }

    //delete contact
    public function deleteContact(Request $request){
        $data = Contact::where('id',$request->contact_id)->first();
        if(isset($data)){
            Contact::where('id',$request->contact_id)->delete();
            return response()->json(['status' => true, 'message' => 'delete success'],200);
        }

        return response()->json(['status' => false, 'message' => 'There is no data in the table']);

    }

    //category detail
    public function categoryDetails(Request $request){
        $data = Category::where('id',$request->category_id)->first();
        if(isset($data)){
            return response()->json(['status' => true, 'category' => $data],200);
        }

        return response()->json(['status' => false, 'message' => 'There is no data in the table']);

    }

    //category update
    public function categoryUpdate(Request $request){
        $dbSource = Category::where('id',$request->category_id)->first();

        if(isset($dbSource)){
            $data = [
                'name' => $request->category_name,
                'updated_at' => Carbon::now()
            ];
            $response = Category::where('id',$request->category_id)->update($data);
            return response()->json(['status' => true, $response , 'message' => 'Update Success'],200);
        }

        return response()->json(['status' => false, 'message' => 'there is no data in the table']);

    }
}
