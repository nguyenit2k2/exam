<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Customer;
use Illuminate\Support\Facades\Cookie;

class CustomerController extends Controller
{
    public function login(Request $request){
        $info = $request->input("info");
        $password = md5(md5($request->input("password")));
        $result = Customer::where('email', $info)->orwhere("phonenumber", $info)->where('password', $password)->first();
        if($result){
            $customer_id = $result->customer_id;
            $cookie = cookie("customer_id", $customer_id);
            return response($result)->withCookie($cookie) ;
        }
        else{
            return "Sai tài khoản hoặc mật khẩu";
        }
    }
    public function logout(Request $request){
        Cookie::forget('customer_id');
        return "Đăng xuất thành công";
    }
    public function register(Request $request){
        $customer = new Customer();
        $customer->firstname = $request->input("firstname");
        $customer->lastname = $request->input("lastname");
        $customer->email = $request->input("email");
        $customer->phonenumber = $request->input("phonenumber");
        $customer->password = md5($request->input("password"));
        $customer->class = $request->input("class");
        $customer->dob = $request->input("dob");
        $customer->save();
        return $customer;
    }
    public function test(){
        $minutes = 1;
        $cookie = cookie('name', 'value', $minutes);
        return response('Hello World')->cookie($cookie);
    }
}
