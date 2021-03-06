<?php
namespace App\Http\Controllers;
use App\Models\AllTest;
use App\Models\Test;
use Illuminate\Http\Request;

class AlltestController extends Controller
{
    public function showAllTest($id=null){
        if($id == null){
        return AllTest::orderBy('test_id')->get();
    }
        else{
            return AllTest::where('test_id', $id)->get();
        }
}
    public function addAllTest(Request $request){
        try{
            $alltest = new AllTest();
            $alltest->exam_id = $request->input('exam_id');
            $alltest->test_id = $request->input('test_id');
            $alltest->name = $request->input('name');
            $alltest->school = $request->input('school');
            $alltest->date = $request->input('date');
            $alltest->question = $request->input('question');
            $alltest->time = $request->input('time');
            $alltest->save();
            Test::Where('test_id', $alltest->test_id)->increment('quantity_exam', 1);
            return $alltest;
        }
        catch(Throwable $err){
            return $err->getMessage();
        }
}       
    public function updateAllTest(Request $request , $id){
        try{
            $alltest = AllTest::Where('id', $id)->first();
            $alltest->exam_id = $request->input('exam_id');
            $alltest->test_id = $request->input('test_id');
            $alltest->name = $request->input('name');
            $alltest->school = $request->input('school');
            $alltest->date = $request->input('date');
            $alltest->question = $request->input('question');
            $alltest->time = $request->input('time');
            $alltest->save();
            return $alltest;
        }
        catch(Throwable $err){
            return $err->getMessage();
        }
    }       
    public function deleteAllTest($id){
        try{
            $alltest = AllTest::Where('id', $id)->first();
            $alltest->delete();
            $alltest = AllTest::orderBy('id', 'asc')->get();
            Test::Where('test_id', $alltest->test_id)->decrement('quantity_exam', 1);
            return  $alltest;
        }
        catch(Throwable $err){
            return $err->getMessage();
        }
    }       
}