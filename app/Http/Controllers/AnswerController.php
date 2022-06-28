<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AllTest;
use App\Models\Answer;
use App\Models\Task;
use App\Models\Question;
use Illuminate\Support\Facades\Cookie;


class AnswerController extends Controller
{
    public function showAnswer($id=null){
        if($id===null){
            $answer = Answer::orderBy('id', 'asc')->get();
        }
        else{
            $answer = Answer::where('id',$id)->first();
        }
        return $answer;
    }
    public function addAnswer($id, Request $request) {
        $question = Question::where('question_id', $id)->first();
        // $hocsinh_id = Session::get('customer_id');
        $hocsinh_id = $request->Cookie("customer_id");
        if ($hocsinh_id){
        if($question){
        $answer = new Answer();
        $answer->hocsinh_id = $hocsinh_id;
        $answer->cauhoi_id = $id;
        $answer->dapan = $request->input('answer');
        $answer->dethi_id = $request->input('test_id');
        $answer->save();
        return $answer;
    }
    }else{
        return "Vui lòng đăng nhập";
    }
}   
    public function updateAnswer($id, Request $request) {
        $answer = Answer::Where('id', $id)->first();
        $answer->dapan = $request->input('answer');
        $answer->save();
        return $answer;
    }
    public function deleteAnswer($id) {
        $answer = Answer::Where('id', $id)->first();
        if($answer){
            $answer->delete();
        }
        $answer = Answer::orderBy('id', 'asc')->get();
    }
    public function submit(Request $request,$dethi_id){
        $hocsinh_id = $request->Cookie("customer_id");
        $answer = Answer::where('hocsinh_id', $hocsinh_id)->where('dethi_id', $dethi_id)->get();
        $quantityquestion = AllTest::where('id', $dethi_id)->first()->question;
        $mark = 0;
        $markofone = 10 / $quantityquestion;
        foreach($answer as $answer) {
            $question_id = $answer->cauhoi_id ;
            $yourAnswer = $answer->dapan;
            $answer = Question::where('question_id', $question_id)->first()->answer;
            if($answer == $yourAnswer){
                $mark= $mark + $markofone;
            }
        }
        $task = Task::where('hocsinh_id',$hocsinh_id)->where('dethi_id',$dethi_id)->first();
        if($task == null){
        $task = new Task();
        $task->hocsinh_id = $hocsinh_id;
        $task->dethi_id = $dethi_id;
        $task->diemso = $mark;
        $task->save();
        AllTest::where('id', $dethi_id)->increment('turn' , 1);
        return $task;
    }
        else{
            return "Bai thi da nop, ban co the lam lai" ; 
        }
    }
    public function doExercise($dethi_id,Request $request){
        $hocsinh_id = $request->Cookie("customer_id");
        $task = Task::where('hocsinh_id', $hocsinh_id)->where('dethi_id', $dethi_id)->first();
        if($task){
            $answer = Answer::where('hocsinh_id', $hocsinh_id)->where('dethi_id', $dethi_id)->get();
            foreach($answer as $answer){
            $answer->delete();
            }
            $task->delete();
            return "Lam lai bai thi";
        }else{
            return "Bắt đầu bài thi";
        }
    }
    
}
