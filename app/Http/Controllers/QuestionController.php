<?php
namespace App\Http\Controllers;
use App\Models\Question;
use App\Models\AllTest;
use Illuminate\Http\Request;
use Session;
use App\Models\Answer;
class QuestionController extends Controller
{
    public function showQuestion($id){
        $question = Question::where('alltest_id', $id)->orderBy('question_id','asc')->get();
        return $question;
    }
    public function addQuestion($id, Request $request){
        $test = AllTest::where('id', $id)->first()->question;
        $question = new Question();
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
    public function updateQuestion($id, Request $request){
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
    public function deleteQuestion($id, Request $request) {
        $question = Question::where('question_id', $id)->first();
        $question->delete();
        $question = Question::orderBy('question_id', 'asc')->get();
        return $question;
    }

    //add answer by Session
    // public function add_answer($id, Request $request){
    //     $question = Question::where('question_id', $id)->first();
    //     if($question!= null){
    //         $newQuestion[$id] =
    //         [
    //             'question' => $question->question,
    //             'answer_a' => $question->answer_a,
    //             'answer_b' => $question->answer_b,
    //             'answer_c' => $question->answer_c,
    //             'answer_d' => $question->answer_d,
    //             'answer' => $request->input('answer')
    //         ];
    //         Session::put('Answer', $newQuestion);
    //         Session::save();
    //         $s = Session::get('Answer');
    //         return $s;
    //     }
        
    // }

    //add answer 
    

}