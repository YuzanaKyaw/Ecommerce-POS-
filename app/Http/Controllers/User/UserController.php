<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home page
    public function home(){
        $pizzas = Product::orderBy('created_at','desc')->get();
        $categories = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.userHome',compact('pizzas','categories','cart','history'));
    }

    //change password page
    public function changePasswordPage(){
        return view('user.account.passwordChange');
    }

    //change password
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbHashPassword = $user->password;

        if(Hash::check($request->oldPassword,$dbHashPassword)){
            $data = ['password' => Hash::make($request->newPassword)];
            User::where('id',Auth::user()->id)->update($data);
            return redirect()->route('user#home')->with(['pwdChangeSuccess' => 'Your new password has been saved!']);
        }
        return back()->with(['notMatch' => 'The credential old password not match.Try Again!']);
    }

    //account change
    public function accountUpdate($id,Request $request){
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);
        if($request->hasFile('image')){
            $dbImage = Auth::user()->where('id',$id)->first();
            $dbImage = $dbImage->image;

            if($dbImage != null){
                Storage::delete('storage/'.$dbImage);
            }

            $filename = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$filename);
            $data['image'] = $filename;
        }
        User::where('id',$id)->update($data);
        return redirect()->route('user#home')->with(['accUpdateSuccess' => 'Your changes have been saved']);
    }

    //profile edit page
    public function accountChange(){
        return view('user.account.profile');
    }

    //category filter
    public function filter($categoryId){
        $pizzas = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $categories = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.userHome',compact('pizzas','categories','cart','history'));
    }

    //derect pizza details
    public function pizzaDetails($pizzaId){
        $pizza = Product::where('id',$pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.detail',compact('pizza','pizzaList'));
    }




    //cart list
    public function cartList(){
        $cartList = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as product_image')
                    ->leftJoin('products','products.id','carts.product_id')
                    ->where('carts.user_id',Auth::user()->id)
                    ->get();

        $totalPrice = 0;
        foreach($cartList as $c){
            $totalPrice += ($c->pizza_price * $c->qty);
        }

        return view('user.main.cart',compact('cartList','totalPrice'));
    }

    //cart history
    public function cartHistory(){
        $orders = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate('5');
        return view('user.main.history',compact('orders'));
    }

    //user list from admin pannel
    public function userList(){
        $users = User::when(request('key'),function($query){
                        $query->orWhere('name','like','%'.request('key').'%')
                              ->orWhere('email','like','%'.request('key').'%')
                              ->orWhere('gender','like','%'.request('key').'%')
                              ->orWhere('address','like','%'.request('key').'%');
                    })
                    ->where('role','user')->paginate(3);
        return view('admin.account.user.list',compact('users'));
    }

    //change role
    public function changeUserRole(Request $request){
        User::where('id',$request->userId)
            ->update(['role'=>$request->role]);
    }

    //user delete
    public function userDelete(Request $request){
        User::where('id',$request->userId)->delete();
        Order::where('user_id',$request->userId)->delete();
        OrderList::where('user_id',$request->userId)->delete();

        return back()->with(['deleteSuccess' => 'This account has been removed']);

    }

    //password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newPassword'
        ])->validate();
    }

    //account validation check
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'image' => 'mimes:png,jpg,jpeg|file',
            'phone' => 'required',
            'address' => 'required'
        ])->validate();
    }

    //get user data
    private function getUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'updated_at' => Carbon::now()
        ];
    }
}
