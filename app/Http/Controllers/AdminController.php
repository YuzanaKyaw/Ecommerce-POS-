<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //
    //change password page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }

    //change password
    public function changePassword(Request $request){
        /*
            1. all field must be fill
            2. new password & confim password length must be greater than 6
            3. new password $ confim password must be same
            4. client old password must be same with db password
            5. password change
        */
        $this->passwordValitationCheck($request);

        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbHashPassword = $user->password;

        //Hash::check(plain-text,$hashValue)
        if(Hash::check($request->oldPassword,$dbHashPassword)){
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
            return redirect()->route('category#list')->with(['pwdChangeSuccess' => 'Your new password has been saved!']);
        }
        return back()->with(['notMatch' => 'The credential old password not match.Try Again!']);

    }

    //accont details
    public function accountDeatail(){
        return view('admin.account.details');
    }

    //admin profile page
    public function accountEdit(){
        return view('admin.account.edit');
    }

    //update account profile
    public function accountUpdate($id,Request $request){

        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);
        //for image
        if($request->hasFile('image')){
            // 1. old image name | check => delete | store new image
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;
            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }
        User::where('id',$id)->update($data);
        return redirect()->route('admin#details')->with(['updateSuccess' => 'Your changes have been saved!']);
    }

    //search
    public function adminList(){
        $admins = User::when(request('key'),function($query){
                    $query->orWhere('name','like','%'.request('key').'%')
                          ->orWhere('email','like','%'.request('key').'%')
                          ->orWhere('gender','like','%'.request('key').'%')
                          ->orWhere('address','like','%'.request('key').'%');
                })
                ->where('role','admin')->paginate(3);
        $admins->appends(request()->all());
        return view('admin.account.adminList',compact('admins'));
    }

    //admin delete
    public function adminDelete($id){
        User::where('id',$id)->delete();
        return redirect()->route('admin#list')->with(['deleteSuccess'=>'Delete Admin Account Successfully!']);
    }

    //change role
    public function changeRole($id){
        $account = User::where('id',$id)->first();
        return view('admin.account.changeRole',compact('account'));
    }

    //change for role
    public function change($id,Request $request){
        $data = $this->requestUserData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
    }

    //request user data
    private function requestUserData($request){
        return [
            'role' => $request->role
        ];
    }

    //get user function
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

    private function passwordValitationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newPassword'
        ])->validate();
    }
}
