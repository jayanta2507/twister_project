<?php

use App\http\controllers\ProjectController;
use App\http\controllers\PostController;
use App\http\controllers\DashboardController;
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
    return redirect('/login');
});

/*Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin/dashboard');
})->name('dashboard');*/

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

	Route::get('/dashboard','DashboardController@index')->name('dashboard');

	Route::get('/Project', 'ProjectController@index')->name('Project');
	//Route::post('/Project', 'ProjectController@store')->name('Project');
	Route::post('/saveData','ProjectController@saveData')->name('saveData');

	Route::get('/Site_user_table','DashboardController@Site_users')->name('Site_user_table');
});





//Route::post('/save-data',[ProjectController::class,'store']);


//Route::get('/Post',[PostController::class,'index']);

//Route::post('/post-data',[PostController::class,'store']);