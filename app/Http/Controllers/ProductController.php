<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //product list
    public function productList(){
        $pizzas = Product::select('products.*','categories.name as category_name')
                ->when(request('key'),function($query){
                    $query->orWhere('products.name','like','%'.request('key').'%')
                          ->orWhere('products.price','like','%'.request('key').'%')
                          ->orWhere('categories.name','like','%'.request('key').'%');
                })
                ->leftJoin('categories','products.category_id','categories.id')
                ->orderBy('products.created_at','desc')->paginate(5);
        $pizzas->appends(request()->all());

        return view('admin.product.pizzaList',compact('pizzas'));
    }

    //direct product create page
    public function createPage(){
        $categories = Category::select('id','name')->get();
        return (view('admin.product.create',compact('categories')));
    }

    //create product
    public function createProduct(Request $request){
        $this->productValidationCheck($request,'create');
        $data = $this->requestProductInfo($request);

        $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image'] = $fileName;


        Product::create($data);
        return redirect()->route('product#list')->with(['createSuccess'=>'Product create successfully!']);
    }

    //delete pizza
    public function delete($id){
        Product::where('id',$id)->delete();
        return redirect()->route('product#list')->with(['productDelete'=>'Product delete Success!']);
    }

    //detail page
    public function detail($id){
        $pizza = Product::where('products.id',$id)
                ->select('products.*','categories.name as category_name')
                ->leftJoin('categories','products.category_id','categories.id')
                ->first();
        //dd($pizza->toArray(),$id);
        return view('admin.product.detail',compact('pizza'));
    }

    //edit pizza
    public function edit($id){
        $pizza = Product::where('id',$id)->first();
        $categories = Category::get();
        //dd($pizza->toArray());
        return view('admin.product.edit',compact('pizza','categories'));
    }

    //update pizza
    public function update(Request $request){

        $this->productValidationCheck($request,'update');
        //dd($request);
        $data = $this->requestProductInfo($request);

        if($request->hasFile('pizzaImage')){
            $oldImage = Product::where('id',$request->pizzaId)->first()->toArray();
            $oldImage = $oldImage['image'];

            if($oldImage != null){
                Storage::delete('public/'.$oldImage);
            }
            $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public/',$fileName);
            $data['image'] = $fileName;
        }

        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('product#list')->with(['updateSuccess' => 'Product Update Successfully!']);

    }

    //request product info
    private function requestProductInfo($request){
        return [
            'category_id' => $request->pizzaCategory,
            'name' => $request->pizzaName,
            'description' => $request->pizzaDescription,
            'waiting_time' => $request->pizzaWaitingTime,
            'price' => $request->pizzaPrice
        ];
    }

    //product validation check
    public function productValidationCheck($request,$action){
        $validationRules = [
            'pizzaName' => 'required|min:5|unique:products,name,'.$request->pizzaId,
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required|min:10',
            'pizzaWaitingTime' => 'required',
            'pizzaPrice' => 'required'
        ];
        $validationRules['pizzaImage'] = $action == 'create' ? 'required|mimes:jpg,png,jpeg,webp,jfif|file': 'mimes:jpg,png,jpeg,webp,jfif|file';

        Validator::make($request->all(),$validationRules)->validate();

    }

}
