<?php

use App\http\controllers\ProjectController;
use App\http\controllers\PostController;

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



Route::get('/Project',[ProjectController::class,'index']);

Route::post('/save-data',[ProjectController::class,'store']);


Route::get('/Post',[PostController::class,'index']);

Route::post('/post-data',[PostController::class,'store']);