<?php

use App\Http\Controllers\PostController;
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

Route::resource('posts', PostController::class);
Route::get('checkTodo/{id}', [PostController::class,'checkTodo'])->name('checkTodo');
Route::get('getCompleted', [PostController::class,'getCompleted'])->name('posts.getCompleted');
Route::get('getIncompleted', [PostController::class,'getIncompleted'])->name('posts.getIncompleted');
Route::get('selectAll', [PostController::class,'selectAll'])->name('posts.selectAll');
Route::get('deselectAll', [PostController::class,'deselectAll'])->name('posts.deselectAll');
 