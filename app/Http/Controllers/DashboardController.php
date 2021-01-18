<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteUsers;
use DB;

class DashboardController extends Controller
{
    
    public function index(){
    	
    	return view('admin/dashboard');
    }
    public function usersList(){
    	$data =  SiteUsers::all();
    	return view('admin/usersList',['site_users'=>$data]);
    }
    public function emailVerification(){
    	 return view('admin/dashboard');
    	}

}
