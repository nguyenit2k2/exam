<?php
use App\Http\Controllers\AllTestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//exam
Route::get('/exam/{id?}', [ExamController::class, 'showExam']);
Route::post('/add-exam',[ExamController::class, 'addExam']);
Route::put('/update-exam/{id}',[ExamController::class, 'updateExam']);
Route::delete('/delete-exam/{id}',[ExamController::class, 'deleteExam']);


//test
Route::get('/test/{id}', [TestController::class, 'showTest']);
Route::post('/add-test',[TestController::class, 'addTest']);
Route::put('/update-test/{id}',[TestController::class, 'updateTest']);
Route::delete('/delete-test/{id}',[TestController::class, 'deleteTest']);

//all test

Route::get('/alltest/{id?}', [AllTestController::class, 'showAllTest']);
Route::post('/add-alltest',[AllTestController::class, 'addAllTest']);
Route::put('/update-alltest/{id}',[AllTestController::class, 'updateAllTest']);
Route::delete('/delete-alltest/{id}',[AllTestController::class, 'deleteAllTest']);

//QuestionController

Route::get('/question/{id}', [QuestionController::class, 'showQuestion']);
Route::post('/add-question', [QuestionController::class, 'addQuestion']);
Route::put('/update-question/{id}', [QuestionController::class, 'updateQuestion']);
Route::delete('/delete  -question/{id}', [QuestionController::class, 'deleteQuestion']);

//CustomerController

Route::post('login', [CustomerController::class,'login']);
Route::post('logout', [CustomerController::class,'logout']);
Route::post('register', [CustomerController::class,'register']);



// Route::get('test', [CustomerController::class, 'test']);


Route::get('answer/{id?}', [AnswerController::class, 'showAnswer']);
Route::post('add-answer/{id}', [AnswerController::class, 'addAnswer']);
Route::put('update-answer/{id}', [AnswerController::class, 'updateAnswer']);
Route::delete('delete-answer/{id}', [AnswerController::class, 'deleteAnswer']);

Route::post('submit/{id}',[AnswerController::class, 'submit']);
Route::get('do-exercise/{id}',[AnswerController::class, 'doExercise']);

//AdminController
Route::post('add-user', [AdminController::class,'addUser']);
Route::put('edit-author/{id}', [AdminController::class, 'editAuthor']);
Route::delete('delete-user', [AdminController::class, 'deleteUser']);