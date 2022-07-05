<?php
namespace App\Http\Controllers;
use App\Models\Question;
use App\Models\AllTest;
use App\Models\Test;
use Illuminate\Http\Request;
use Session;
use App\Models\Answer;
class QuestionController extends Controller
{
    public function showQuestion($id){
        $question = Question::where('alltest_id', $id)->orderBy('question_id','asc')->get();
        return $question;
    }
    public function addQuestion(Request $request){

        $check = $request->cookie('customer_id');
        if($check){
        $check = Customer::where('customer_id', $check)->first()->author;
        if($check!='user'){
        // add all test 
        $test = $request->input('test');
        $alltest = new AllTest();
        $alltest->exam_id = $test['exam_id'];
        $alltest->test_id = $test['test_id'];
        $alltest->name = $test['name'];
        $alltest->school = $test['school'];
        $alltest->date = $test['date'];
        $alltest->question = $test['question'];
        $alltest->time = $test['time'];
        $alltest->save();
        Test::Where('test_id', $alltest->test_id)->increment('quantity_exam', 1);
        //add question
        $questions = $request->input('questions');
        foreach($questions as $questions){ 
        $question = new Question();
        $question->alltest_id = $alltest->id;
        $question->question = $questions['question'];
        $question->answer_a = $questions['answer_a'];
        $question->answer_b = $questions['answer_b'];
        $question->answer_c = $questions['answer_c'];
        $question->answer_d = $questions['answer_d'];
        $question->answer = $questions['answer'];
        $question->save();
        }
        return "thêm đề thi thành công";
    }
        else{
            return "Bạn không có quyền truy cập chức năng này";
        }
    }
        else{
            return "Vui lòng đăng nhập";
        }
    }
    public function updateQuestion($id, Request $request){
        $check = $request->cookie('customer_id');
        if($check){
        $check = Customer::where('customer_id', $check)->first()->author;
        if($check!='user'){
        $question = Question::where('question_id', $id)->first();
        $question->alltest_id = $request->input('alltest_id');
        $question->question = $request->input('question');
        $question->answer_a = $request->input('answer_a');
        $question->answer_b = $request->input('answer_b');
        $question->answer_c = $request->input('answer_c');
        $question->answer_d = $request->input('answer_d');
        $question->answer = $request->input('answer');
        $question->save();
        return $question;
        }
        else{
            return "Bạn không có quyền truy cập chức năng này";
        }
    }
        else{
            return "Vui lòng đăng nhập";
        }
    }
    public function deleteQuestion($id, Request $request) {
        $check = $request->cookie('customer_id');
        if($check){
        $check = Customer::where('customer_id', $check)->first()->author;
        if($check!='user'){
        $question = Question::where('question_id', $id)->first();
        $question->delete();
        $question = Question::orderBy('question_id', 'asc')->get();
        return $question;
    }
    else{
        return "Bạn không có quyền truy cập chức năng này";
    }
}
    else{
        return "Vui lòng đăng nhập";
    }
}
}