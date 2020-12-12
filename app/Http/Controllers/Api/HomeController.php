<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
    	return view('api/home');
    }

    public function loginView(){
    	return view('api/login');
    }
     public function registerView(){
    	return view('api/registration');
    }
}
