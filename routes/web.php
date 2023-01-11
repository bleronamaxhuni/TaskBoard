<?php

use App\Http\Controllers\TaskController;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('tasks/create', [TaskController::class, 'index']);
Route::post('tasks/create', [TaskController::class, 'store']);
Route::get('tasks/create/{task}',[TaskController::class,'edit']);
Route::patch('tasks/create/{task}', [TaskController::class, 'update']);
Route::patch('tasks/create/{task}', [TaskController::class, 'update']);
Route::delete('tasks/create/{task}', [TaskController::class, 'destroy']);
Route::patch('tasks/create/{task}/completed', [TaskController::class, 'completed']);
Route::get('tasks/create', [TaskController::class, 'search']);