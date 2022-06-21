<?php
namespace App\Http\Controllers;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function show_exam($id=null){
        if($id == null){
        return Exam::orderBy('exam_id')->get();
    }
        else{
            return Exam::where('exam_id', $id)->get();
        }
}
    public function add_exam(Request $request){
        try{
            $exam = new Exam();
            $exam->name = $request->input('name');
            $exam->type = $request->input('type');
            $exam->save();
            return $exam;
        }
        catch(Throwable $err){
            return $err->getMessage();
        }
}       
    public function update_exam(Request $request , $id){
        try{
            $exam = Exam::Where('exam_id', $id)->first();
            $exam->name = $request->input('name');
            $exam->type = $request->input('type');
            $exam->save();
            return $exam ;
        }
        catch(Throwable $err){
            return $err->getMessage();
        }
    }       
    public function delete_exam($id){
        try{
            $exam = Exam::Where('exam_id', $id)->first();
            $exam->delete();
            $exam = Exam::orderBy('exam_id', 'asc')->get();
            return  $exam;
        }
        catch(Throwable $err){
            return $err->getMessage();
        }
    }       
}