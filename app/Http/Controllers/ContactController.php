<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //User Contact
    public function contact(){
        $user = User::get();
       return view('user.contact.contact',compact('user'));
    }

    // sentMessage function
    public function sentMessage(Request $request){
        $user = User::get();
        $data = $this->requestMessage($request);
        $this->messageValidationCheck($request);
        Contact::create($data);
        return redirect()->route('user#contact');
    }

    //admin side contact list
    public function contactList(){
        $contact= Contact::orderBy('created_at','desc')->paginate(3);
        return view('admin.contact.contact',compact('contact'));
    }

    //Request message box
    private function requestMessage($request){
        return [
            'name' =>$request->user()->name,
            'email' => $request->user()->email,
            'message' => $request->message
        ];
    }

    // message Validation Check
    private function messageValidationCheck($request){
        $validationRule =[
            'message' => 'required|min:5',
        ];

       Validator::make($request->all(),$validationRule)->validate();
    }
}
