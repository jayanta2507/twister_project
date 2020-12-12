<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class user extends Controller
{
    public function index(){
    	$name = 'Jenniffer';
    	$users = array(
    		'name'=>'Jyoti Vankala',
    		'class'=>'four',
    		'email'=>'jyoti@gmail.com',


    	);
    	return view('hello',compact('name','users'));
    }
}
