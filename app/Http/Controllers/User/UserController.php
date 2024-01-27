<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home page
    public function home(){
        $pizza = Product::orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }

    // changePasswordPage
    public function changePasswordPage(){
        return view('user.password.change');
    }

    //change Password Function
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

    //user profile
    public function profile(){
        return view('user.password.profile');
    }

    //update Profile
    public function updateProfile($id,Request $request){
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
        return back()->with(['updateSuccess' => 'Update Successfully...']);
    }

    //filter pizza
    public function filter($categoryId){
        $pizza = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }

    //pizza detail page
    public function pizzaDetail($pizzaId){
        $pizza = Product::where('id', $pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.details',compact('pizza','pizzaList'));
    }

    //cart list
    public function cartList(){
        $cartList = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as pizza_image')
                    ->leftJoin('products','products.id','carts.product_id')
                    ->where('carts.user_id',Auth::user()->id)
                    ->get();

        $totalPrice = 0;

        foreach ($cartList as $CL){
            $totalPrice += $CL->pizza_price * $CL->qty ;
        }

        return view('user.main.cart',compact('cartList','totalPrice'));
    }

    //direct history page
    public function history (){
        $history = Order::where('user_id',Auth::user()->id)->get();
        $order = Order::where('user_id',Auth::user()->id)
                        ->orderBy('created_at','desc')
                        ->paginate(6);
        return view('user.main.history', compact('order','history'));
    }


    //userlist
    public function userList(){
        $users = User::where('role','user')->paginate(3);
        // dd($user->toArray());
        return view('admin.user.list',compact('users'));
    }

    //changeUserRole ajax Function
    public function changeUserRole(Request $request){
        User::where('id',$request->userId)->update([
            'role' => $request->role
        ]);

    }

    // user delete
    public function delete($id){
        User::where('id',$id)->delete();
        return redirect()->route('admin#userList');
    }

    // user view
    public function view($id){
        $user = User::where('id',$id)->get();
        // dd($user->toArray());
        return view('admin.user.view',compact('user'));
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
