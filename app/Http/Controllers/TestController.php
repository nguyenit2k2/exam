<?php
namespace App\Http\Controllers;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function showTest($id=null){
        if($id == null){
        return Test::orderBy('test_id')->get();
    }
        else{
            return Test::where('test_id', $id)->get();
        }
}   
    public function addTest(Request $request){
        try{
            $test = new Test();
            $test->exam_id = $request->input('exam_id');
            $test->exam = $request->input('exam');
            $test->image = $request->input('image');
            $test->content = $request->input('content');
            $test->save();
            return $test;
        }
        catch(Throwable $err){
            return $err->getMessage();
        }
    }       
    public function updateTest(Request $request , $id){
        try{
            $test = Test::Where('test_id', $id)->first();
            $test->exam_id = $request->input('exam_id');
            $test->exam = $request->input('exam');
            $test->image = $request->input('image');
            $test->content = $request->input('content');
            $test->save();
            return $test;
        }
        catch(Throwable $err){
            return $err->getMessage();
        }
    }       
    public function deleteTest($id){
        try{
            $test = Test::Where('test_id', $id)->first();
            $test->delete();
            $test = Test::orderBy('test_id', 'asc')->get();
            return  $test;
        }
        catch(Throwable $err){
            return $err->getMessage();
        }
    }       
}