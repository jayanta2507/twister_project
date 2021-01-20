<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SiteUsers;
use DB;
use App\Services\SiteUsersService;
//use App\Models\SiteUsers;


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
    public function usersList(){
    	$data =  SiteUsers::all();
    	return view('admin/usersList',['site_users'=>$data]);
    }
    public function emailVerification(){
    	 return view('admin/dashboard');
    	}
    public function user($id){
      $data = SiteUsers::find($id);
      return view('admin/updatePage',['data'=>$data]);
        }

    public function updateRegister(Request $request){
      

      $data = $request->all();
      $responsedata = $this->siteUsersServ->updateRegister($request,$data);
     return  redirect('usersList');

   }   
   public function deleteUser($id){
       
        $data = SiteUsers::find($id);
        $user_id = $data['id'];
        $responsedata = $this->siteUsersServ->deleteUser($user_id);
        return  redirect('usersList');
       //return Session::flash('success', 'The post was just trashed.');

  
      //  return response()->json(['success'=>'you have successfully deleted','data'=>$data]);
        

   }
    


    public function ChangeUserStatus(Request $request){

        $data = $request->all();

       /* \Log::info($request->all());
        $user = SiteUsers::find($request->user_id);
        $user->status = $request->status;
        $user->save();*/
        $responsedata = $this->siteUsersServ->userStatus($data,$request);

  
        return response()->json(['success'=>'Status change successfully.','data'=>$data]);
        
    }}
