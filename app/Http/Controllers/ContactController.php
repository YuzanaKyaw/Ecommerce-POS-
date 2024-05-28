<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ContactController extends Controller
{
    //contact page
    public function contactPage(){
        return view('user.contact.contact');
    }

    //send message
    public function sendMessage(Request $request){
        $this->contactValidationCheck($request);
        $data = $this->getContactMessage($request);

        Contact::create($data);

        return back()->with(['successMessage' => 'Thank You for your contact!']);

    }

    //admin contact list
    public function contactList(){
        $contactMessage = Contact::when(request('key'),function($query){
                            $query->orWhere('name','like','%'.request('key').'%')
                                  ->orWhere('email','like','%'.request('key').'%')
                                  ->orWhere('message','like','%'.request('key').'%');
                        })
                            ->orderBy('created_at','desc')->paginate(5);

        return view('admin.account.user.contactList',compact('contactMessage'));

    }

    //delete contact
    public function contactDelete(Request $request){
        Contact::where('contact_id',$request->contactId)->delete();
        return back()->with(['deleteSuccess' => 'Delete Message Successfully!']);
    }

    //validation check
    private function contactValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ])->validate();

    }

    //get contact message
    private function getContactMessage($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];
    }
}
