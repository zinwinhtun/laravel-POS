<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
     //change password page
     public function changePasswordPage(){
        return view('admin.account.changePassword');
    }

    //change password
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $DbHashValue =$user->password;

        if(Hash::check($request->currentPassword, $DbHashValue)){
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
            Auth::logout(); // change pass & direct logout

            return redirect()->route('auth#loginPage');
        }

        return back()->with(['notMatch'=> 'Old password is not correct. please enter correctly...']);
    }

    //account detail page
    public function detail(){
        return view('admin.account.detail');
    }

    //account edit page
    public function edit(){
        return view('admin.account.edit');
    }

    //profile update function
    public function update($id,Request $request) {
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);
        //image storage
        if($request->hasFile('image')){
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;

            if($dbImage != null ){
                Storage::delete('public/'. $dbImage);
            }
        }

        User::where('id',$id)->update($data);
        return redirect()->route('admin#detail')->with(['updateSuccess' => 'Update Successfully...']);
    }

    // admin list function
    public function list(){
        $admin = User::when(request('key'),function($query){
                    $query  ->orWhere('name','like','%'.request('key').'%')
                            ->orWhere('email','like','%'.request('key').'%')
                            ->orWhere('phone','like','%'.request('key').'%')
                            ->orWhere('gender','like','%'.request('key').'%')
                            ->orWhere('address','like','%'.request('key').'%');
                    })
                    ->where('role','admin')->paginate(3);
                    $admin->appends(request()->all());
        return view('admin.account.list',compact('admin'));
    }

    //admin delete function
    public function delete($id){
        User::Where('id',$id)->delete();
        return redirect()->route('admin#list')->with(['deleteSuccess' => 'Delete Successfully...']);
    }

    //change Role Admin to user view page
    public function changeRole($id){
        $account = User::where('id',$id)->first();
        return view('admin.account.changeRole',compact('account'));
    }

    //change role function
    public function change($id,Request $request){
        $data = $this->requestRoleData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
    }

    //ajax change role
    public function ajaxChangeRole(Request $request){
        User::where('id',$request->roleId)->update([
            'role' => $request->role
        ]);

    }

    //request role date
    private function requestRoleData($request){
        return [
            'role' => $request->role
        ];
    }
    //getUserData function
    private function getUserData($request){
        return [
            'name' => $request->name,
            'email' =>$request->email,
            'gender' =>$request->gender,
            'phone' =>$request->phone,
            'address' =>$request->address,
        ];
    }

    // accountValidationCheck function
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'image' => 'mimes:png,jpg,jpeg,webp|file',
            'gender' => 'required',
            'address' => 'required'
        ])->validate();
    }

    //password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'currentPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'comfirmNewPassword' => 'required|same:newPassword|min:6' //same[ new pass = comfirm pass ]
        ])->validate();
    }

}
