<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReplyController extends Controller
{
    //reply page
    public function replyPage($contactId){
        $contactInfo = Contact::where('contact_id',$contactId)->first();

        return view('admin.account.user.replyPage',compact('contactInfo'));
    }

    //send reply
    public function sendReply(Request $request){
        $this->messageValidationCheck($request);
        $data = $this->getReplyData($request);
        Reply::create($data);

        return redirect()->route('admin#contactList')->with(['successMessage'=>'Reply send successfully!']);
    }

    //user reply page
    public function userReplyPage(){
        $replies = Reply::where('customer_email',Auth::user()->email)->orderBy('created_at','desc')->paginate(5);
        // dd($replies->toArray());
        return view('user.contact.reply',compact('replies'));
    }

    //validation
    private function messageValidationCheck($request){
        Validator::make($request->all(),[
            'message' => 'required'
        ])->validate();
    }

    //get reply message
    private function getReplyData($request){
        return [
            'customer_name' => $request->customerName,
            'customer_email' => $request->customerEmail,
            'message' => $request->message
        ];
    }
}
