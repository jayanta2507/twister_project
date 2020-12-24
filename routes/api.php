<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\http\controllers\Api\HomeController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/home',[HomeController::class,'index'])->name('home');

//Route::middleware(['auth:sanctum', 'verified'])->group(function () {
	//Route::get('/home',[HomeController::class,'index'])->name('home');

	Route::get('/home','Api\HomeController@index')->name('home');
//});

//Route::get('/home',function(){
    //Route::get('/home',[HomeController::class,'index'])->name('home');
//});


Route::get('/userLogin','Api\HomeController@loginView')->name('userLogin');
Route::get('/register','Api\HomeController@registerView')->name('registration');
Route::post('/userRegister','Api\HomeController@userRegister')->name('userRegister');
Route::get('/verifyUserToken/{token}','Api\HomeController@checkVerifyUser')->name('verifyUserToken');
Route::get('/login','Api\HomeController@View')->name('registration');
Route::post('/submitUserLogin','Api\HomeController@submitUserLogin')->name('submitUserLogin');



