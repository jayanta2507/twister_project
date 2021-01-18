<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SiteUsersService;
use App\Models\SiteUsers;

class DashboardController extends Controller
{
     protected $siteUsersServ;
    protected $verifyUsersServ;

    public function __construct(SiteUsersService $siteUsersServObj)
    {
        $this->siteUsersServ   = $siteUsersServObj;
    }
    
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


    public function ChangeUserStatus(Request $request){

        $data = $request->all();

       /* \Log::info($request->all());
        $user = SiteUsers::find($request->user_id);
        $user->status = $request->status;
        $user->save();*/
        $responsedata = $this->siteUsersServ->userStatus($data);

  
        return response()->json(['success'=>'Status change successfully.','data'=>$data]);
        
    }
}
