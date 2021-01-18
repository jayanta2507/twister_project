<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SiteUsersService;
use App\Models\SiteUsers;

class DashboardController extends Controller
{
    
    public function index(){
    	
    	return view('admin/dashboard');
    }

     public function Site_users(){

     	$data = SiteUsers:: all();

     /*	echo "<pre>";
     	print_r($data);
     	die;*/
    	
    	 return view('admin/site-users',['siteUserArr'=>$data]);
    }
}
