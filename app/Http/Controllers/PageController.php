<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Slide;
use App\Product;
use App\ProductType;
use App\Cart;
use Session;
use App\Customer;
use App\Bill;
use App\BillDetail;
use App\User;
use Hash;
use Auth;
// Nên tách ra thanh nhiều controller tương ứng với mỗi model
// cần nâng cấp lên win 10, win 7 để chơi game đợi tẹo t tìm lại cái tool đó cho
class PageController extends Controller
{
    public function getIndex(){
    	$slide = Slide::all();
    	//return view('page.trangchu',['slide'=> $slide]);
    	// nên tách mấy func kiểu này ra để sau này chỉ cần sửa 1 chỗ thôi
        //dùng php storm để code nhanh hơn 
        //phần view có đụng đến html,css ko hay là coppy hết,đụng it thôi
    	$new_product = Product::getListProduct(); 
    	$promotion_product = Product::where('promotion_price','<>',0)->paginate(8);
    	return view('page.trangchu',compact('slide','new_product','promotion_product'));
    }

    public function getLoaisp($type){
    	$type_product = Product::where('id_type',$type)->get();
    	$other_product = Product::where('id_type','<>',$type)->paginate(3);
    	$type_p =  ProductType::all();
    	$name_product = ProductType::where('id',$type)->first();
    	return view('page.product_type',compact('type_product','other_product','type_p','name_product'));
    }

    public function getProduct(Request $req, $id = null){
    	$product = Product::where('id',$id)->first();
    	return view('page.product',compact('product'));
    }

    public function getContact(){
    	return view('page.contact');
    }

    public function getAbout(){
    	return view('page.about');
    }

    public function getaddToCart(Request $req,$id){
    	$product = Product::find($id);
    	$oldCart = Session('cart')?Session::get('cart'):null;
    	$cart = new Cart($oldCart);
    	$cart->add($product,$id);
    	$req->session()->put('cart',$cart);
    	return redirect()->back();
    }
    
    public function getDeleteCart($id){
    	$oldCart = Session::has('cart')?Session::get('cart'):null;
    	$cart =  new Cart($oldCart);
    	$cart->removeItem($id);
    	if(count($cart->items) >0)
    		Session::put('cart',$cart);
    	else
    		Session::forget('cart');
    	return redirect()->back();
    }


    public function getCheckout(){
    	return view('page.checkout');
    }

    public function postCheckout(Request $req){

    	$cart = Session::get('cart');

    	$customer = new Customer;
    	$customer->name = $req->full_name;
    	$customer->gender = $req->gender;
    	$customer->email = $req->email;
    	$customer->address = $req->address;
    	$customer->phone_number = $req->phone;
    	$customer->note = $req->notes;
    	$customer->save();

    	$bill = new Bill;
    	$bill->id_customer = $customer->id;
    	$bill->date_order = date('Y-m-d');
    	$bill->total = $cart->totalPrice;
    	$bill->payment = $req->payment_method;
    	$bill->note = $req->notes;
    	$bill->save();

    	
    	foreach($cart ->items  as $key=>$value){
    		$bill_detail = new BillDetail;
    		$bill_detail->id_bill = $bill->id;
    		$bill_detail->id_product = $key;
    		$bill_detail->quantity = $value['qty'];
    		$bill_detail->unit_price = $value['price']/$value['qty'];
    		$bill_detail->save();

    	}

    	Session::forget('cart');
    	//return view('page.about');
    	return redirect()->back();
    }

    public function getlogin()
    {
    	return view('page.login');
    }

    public function getsignup()
    {
    	return view('page.signup');
    }

    public function postsignup(RegisterRequesttô $req)
    {
        //viết lệnh php artisan ở đâu giờ
    	
    	// Các cái khác tương tự
    	$user = new stdClass();
    	$user->full_name = $req->fullname;
    	$user->email = $req->email;
    	$user->password = Hash::make($req->password);
    	$user->phone= $req->phone;
    	$user->address = $req->address;
    	User::insert($user);

    	return redirect()->back()->with('success','Create account Success');

    }

    public function postlogin(Request $req)
    {
    	$this->validate($req,[
    		'email'=>'required',
    		'password'=>'required|min:6|max:20'

    	],
    	[
    		'email.required'=>'Vui long nhap email',
    		'email.email'=>'Khong dung dinh dang email',
    		'password.required'=> 'Vui long nhap password',
    		'password.min' => 'Password it nhat 6 ki tu',
    		'password.max' => 'Password nhieu nhat 20 ki tu'
    	]);

    	$login =  array('email' =>$req->email,'password'=>$req->password);
    	if(Auth::attempt($login))
    	{
    		return redirect()->back()->with(['flag'=>'success','message'=>'Login Success']);
    	}
    	else{
    		return redirect()->back()->with(['flag'=>'danger','message'=>'Login Fail']);
    	}
    } 

    public function getlogout()
    {
    	Auth::logout();
    	return redirect()->route('trang-chu');
    }

    public function getsearch(Request $req)
    {
    	$product = Product::where('name','like','%'.$req->key.'%')->orwhere('unit_price',$req->key)->get();
    	return view('page.search',compact('product'));
    }        
}
