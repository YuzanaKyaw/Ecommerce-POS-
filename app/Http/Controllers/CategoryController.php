<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class CategoryController extends Controller
{
    //list page
    public function list(){
        $categories = Category::when(request('key'),function($query){
                        $query->where('name','like','%' . request('key') .'%');
                    })
                    ->orderBy('id','desc')->paginate(5);
        return view('admin.category.list',compact('categories'));
    }

    //create page
    public function createPage(){
        return view('admin.category.create');
    }

    //create category
    public function createCategory(Request $request){
        $this->categoryValidatationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::create($data);

        return redirect()->route('category#list')->with(['createSuccess'=>'Category Create Successfully']);
    }

    //delete category
    public function delete($id){
        Category::where('id',$id)->delete();
        return redirect()->route('category#list')->with(['deleteSuccess'=>'Delete Successfully']);
    }

    //edit category
    public function edit($id){
        $category=Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    //update category
    public function update(Request $request){
        $this->categoryValidatationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::where('id',$request->categoryId)->update($data);
        return redirect()->route('category#list')->with(['updateSuccess'=>'Update Successfully!']);
    }


    //creatory validation
    private function categoryValidatationCheck($request){
        Validator::make($request->all(),[
            'categoryName' => 'required|unique:categories,name,'.$request->categoryId
        ],[
            'categoryName.required' => 'You need to fill category name field',
            'categoryName.unique' => 'Category name must be unque.Try again'
        ])->validate();
    }

    //request Category Data
    private function requestCategoryData($request){
        return [
            'name' => $request->categoryName
        ];
    }
}
