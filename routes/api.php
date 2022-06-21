<?php
use App\Http\Controllers\AllTestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\TestController;
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
Route::get('/exam/{id?}', [ExamController::class, 'show_exam']);
Route::post('/add-exam',[ExamController::class, 'add_exam']);
Route::put('/update-exam/{id}',[ExamController::class, 'update_exam']);
Route::delete('/delete-exam/{id}',[ExamController::class, 'delete_exam']);


//test
Route::get('/test/{id}', [TestController::class, 'show_test']);
Route::post('/add-test',[TestController::class, 'add_test']);
Route::put('/update-test/{id}',[TestController::class, 'update_test']);
Route::delete('/delete-test/{id}',[TestController::class, 'delete_test']);

//all test

Route::get('/alltest/{id?}', [AllTestController::class, 'show_alltest']);
Route::post('/add-alltest',[AllTestController::class, 'add_alltest']);
Route::put('/update-alltest/{id}',[AllTestController::class, 'update_alltest']);
Route::delete('/delete-alltest/{id}',[AllTestController::class, 'delete_alltest']);
