<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function editAuthor(Request $request,$id){
        $admin = $request->cookie('customer_id');
        $admin = Customer::where('customer_id', $admin)->first();
        if ($admin->author == 'admin'){
            $new_author = $request->input('author');
            $admin->author = $new_author;
            $admin->save();
            return "Bạn đã sửa quyền thành công".$admin;
        }
        else {
            return "Bạn chưa đăng nhập hoặc không được cấp quyền để làm điều này";
        }
    }
    public function addUser(Request $request){
        $admin = $request->cookie('customer_id');
        if($admin){
        $admin = Customer::where('customer_id', $admin)->first()->author;
        if ($admin == 'admin'){
        $email = $request->input("email");
        $phonenumber = $request->input("phonenumber");
        $password = $request->input("password");
        $check = Customer::where('email', $email)->orWhere('phonenumber', $phonenumber)->first();
        if($check ) {
            return "Email or phonenumber already registered";
        }
        else {
            $user = new Customer();
            $user->firstname = $request->input("firstname");
            $user->lastname = $request->input("lastname");
            $user->email = $request->input("email");
            $user->password = md5($request->input("password"));
            $user->phonenumber = $request->input("phonenumber");
            $user->author = $request->input("author");
            $user->dob = $request->input("dob");
            $user->api_token = Str::random(60);
            $user->save();
            return "Thêm".$user->author." thành công". $user;
        }
    }
    else {
        return "Bạn chưa đăng nhập hoặc không được cấp quyền để làm điều này";
    }

}
    else{
        return "Vui lòng đăng nhập";
    }
}
    public function deleteUser($id){
        $admin = $request->cookie('customer_id');
        if($admin){
        $admin = Customer::where('customer_id', $admin)->first()->author;
        if ($admin == 'admin'){
            $user = Customer::where('customer_id',$id)->first();
            if($user->author= 'teacher'){
                $user->delete();
                $user->save();
            }
            elseif($user->author = 'user'){
                $task = Task::where('hocsinh_id',$id)->get();
                foreach($task as $task){
                    $task->delete();
                    $task->save();
                }
                $answer = Answer::where('hocsinh_id',$id)->get();
                foreach($answer as $answer){
                    $answer->delete();
                    $answer->save();
                }
                $user->delete();
                $user->save();
            }
            else{
                return "Người này không tồn tại";
            }
        }
            else {
                return "Bạn chưa đăng nhập hoặc không được cấp quyền để làm điều này";
            }
        
        }
            else{
                return "Vui lòng đăng nhập";
            }
    }
    
}
