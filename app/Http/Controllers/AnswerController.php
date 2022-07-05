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
    public function addAnswer(Request $request,$dethi_id) {
        $hocsinh_id = $request->Cookie("customer_id");
        $list_answer = $request->input('list_answer');   
        if($hocsinh_id){
        $check = Answer::where('hocsinh_id', $hocsinh_id)->where('dethi_id',$dethi_id)->get();
        if($check){
            foreach($list_answer as $list_answer) {
                $answer = Answer::Where('cauhoi_id', $list_answer['question_id'])->where('hocsinh_id',$hocsinh_id)->first();
                $answer->hocsinh_id = $hocsinh_id;
                $answer->dethi_id = $dethi_id;
                $answer->cauhoi_id = $list_answer['question_id'];
                $answer->dapan = $list_answer['answer'];
                $answer->save();
            }
        }
        else{
        foreach($list_answer as $list_answer) {
            $answer = new Answer();
            $answer->hocsinh_id = $hocsinh_id;
            $answer->dethi_id = $dethi_id;
            $answer->cauhoi_id = $list_answer['question_id'];
            $answer->dapan = $list_answer['answer'];
            $answer->save();
        }
    }
        return $answer;
    }
        else{
            return "Đăng nhập để thi";
        }
}   
    public function updateAnswer($id, Request $request) {
        $hocsinh_id = $request->Cookie("customer_id");
        if ($hocsinh_id){
        $answer = Answer::Where('id', $id)->first();
        $answer->dapan = $request->input('answer');
        $answer->save();
        return $answer;
        }
        else{
            return "Vui lòng đăng nhập";
        }
    }
    public function deleteAnswer($id) {
        $hocsinh_id = $request->Cookie("customer_id");
        if ($hocsinh_id){
        $answer = Answer::Where('id', $id)->first();
        if($answer){
            $answer->delete();
        }
        $answer = Answer::orderBy('id', 'asc')->get();
        return "Xóa câu trả lời thành công";
        }
        else{
            return "Vui lòng đăng nhập";
        }
    } 
    public function submit(Request $request,$dethi_id){
        // add or update answer to table
        $hocsinh_id = $request->Cookie("customer_id");
        $list_answer = $request->input('list_answer');   
        if($hocsinh_id){
        $check = Task::where('hocsinh_id', $hocsinh_id)->where('dethi_id',$dethi_id)->get();
        if(empty($check)){
            foreach($list_answer as $list_answer) {
                $answer = Answer::Where('cauhoi_id', $list_answer['question_id'])->where('hocsinh_id',$hocsinh_id)->first();
                $answer->hocsinh_id = $hocsinh_id;
                $answer->dethi_id = $dethi_id;
                $answer->cauhoi_id = $list_answer['question_id'];
                $answer->dapan = $list_answer['answer'];
                $answer->save();
                
            }
        }
        else{
        foreach($list_answer as $list_answer) {
            $answer = new Answer();
            $answer->hocsinh_id = $hocsinh_id;
            $answer->dethi_id = $dethi_id;
            $answer->cauhoi_id = $list_answer['question_id'];
            $answer->dapan = $list_answer['answer'];
            $answer->save();
        }
    }

        //caculator mark and create or update result
        $answer = Answer::where('hocsinh_id', $hocsinh_id)->where('dethi_id', $dethi_id)->get();
        $quantityquestion = AllTest::where('id', $dethi_id)->first()->question;
        $mark = 0;
        $markofone = 10 / $quantityquestion;
        foreach($answer as $answers) {
            $question_id = $answers->cauhoi_id ;
            $yourAnswer = $answers->dapan;
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
            $task->diemso = $mark;
            $task->save();
            return $task;
        }
    }
    else{
        return "Đăng nhập để làm bài";
    }
}
    public function doExercise($dethi_id,Request $request){
        $hocsinh_id = $request->Cookie("customer_id");
        $task = Task::where('hocsinh_id', $hocsinh_id)->where('dethi_id', $dethi_id)->first();
        if($task){
            return "Lam lai bai thi";
        }else{
            return "Bắt đầu bài thi";
        }
    }
    
}
