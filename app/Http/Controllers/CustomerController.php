<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Support\Str;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Customer;
use Illuminate\Support\Facades\Cookie;

class CustomerController extends Controller
{
    public function login(Request $request){
        $info = $request->input('info');
        $password = md5(md5($request->input("password")));
        $result = Customer::where('email', $info)->orwhere("phonenumber", $info)->where('password', $password)->first();
        if($result->author== 'user'){
            $customer_id = $result->customer_id;
            $result->api_token = Str::random(60);
            $result->save();
            $cookie = cookie("customer_id", $customer_id);
            return response($result)->withCookie($cookie) ;
        }

        elseif($result->author== 'teacher'){
            $customer_id = $result->customer_id;
            $result->api_token = Str::random(60);
            $result->save();
            $cookie = cookie("customer_id", $customer_id);
            return response($result)->withCookie($cookie) ;
        }
        elseif($result->author=='admin'){
            $customer_id = $result->customer_id;
            $result->api_token = Str::random(60);
            $result->save();
            $cookie = cookie("customer_id", $customer_id);
            return response($result)->withCookie($cookie) ;
        }
        else{
            return "Sai tài khoản hoặc mật khẩu";
        }
    }
    public function logout(Request $request){
        $token = Customer::where('customer_id',$request->Cookie('customer_id'))->first();
        if($token){
        $token->api_token = '';
        $token->save();
        Cookie::forget('customer_id');
        return "Đăng xuất thành công";
        }
        else{
            return "Vui lòng đăng nhập";
        }
    }
    public function register(Request $request){
        $check = Customer::where('email',$request->input('email'))->orWhere('phonenumber',$request->input('phonenumber'))->first();
        if($check){
            return "Email or phonenumber already registered";
        }
        else{
        $customer = new Customer();
        $customer->firstname = $request->input("firstname");
        $customer->lastname = $request->input("lastname");
        $customer->email = $request->input("email");
        $customer->phonenumber = $request->input("phonenumber");
        $customer->password = md5($request->input("password"));
        $customer->author = 'user';
        $customer->class = $request->input("class");
        $customer->dob = $request->input("dob");
        $customer->api_token = Str::random(60);
        $customer->save();
        return "Đăng kí thành công ! Vui lòng đăng nhập".$customer;
        }
    }
    
}