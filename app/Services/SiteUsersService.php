<?php

namespace App\Services;

use App\Models\SiteUsers;
use App\Models\UserLoginDetails;
use DB;
use Illuminate\Support\Facades\Hash;

class SiteUsersService
{

	protected $siteusersAssignVar;
	protected $userLoginDetailsAssignVer;

	public function __construct(SiteUsers $siteusersObj, UserLoginDetails $userLoginDetailsObj)
	{
		$this->siteusersAssignVar        = $siteusersObj;
		$this->userLoginDetailsAssignVer = $userLoginDetailsObj;
	}

	/**
     * Display a listing of the Dashboard.
     *
     * @param varchar searchKey this the key for seach record
     * @return \Illuminate\Http\Response
     */

	public function saveUsers($request)
	{
		$check_user_phone	= $this->siteusersAssignVar->where('phone',$request->input('phone'))->count();

		if ($check_user_phone==0) {
			$this->siteusersAssignVar->name     = $request->input('fullname');
			$this->siteusersAssignVar->email    = $request->input('email');
			$this->siteusersAssignVar->password = Hash::make($request->input('password'));
			$this->siteusersAssignVar->phone    = $request->input('phone');
			$this->siteusersAssignVar->save();

			return $this->siteusersAssignVar->id;
		}else{
			return 0;
		}
		
	}
	public function updatePassword($request)
	{
        $otp              = $request->input('otp');
		$new_pass         = $request->input('new_password');
		$confirm_pass     = $request->input('confirm_password');

		if($new_pass==$confirm_pass){

			$check_user_otp	= $this->siteusersAssignVar->where('otp',$otp)->first();
           		

		    $check_user_otp->password  = Hash::make($request->input('new_password'));
            $check_user_otp->update();

	      
			}else  //if password not matched
			{
				$responsedata = array(
									'status'	=> 0,
									'data' 		=> array(),
									'message'	=> "Invalid "
								);
			}
	

		return $this->siteusersAssignVar->id;
	}



	public function updateUser($user_id){
		
		$getUser =  $this->siteusersAssignVar->where('id',$user_id)->first();

		$getUser->email_verified_status = '1';

		$getUser->update();
	}
 
	public function updateOtp($user_id, $otpPin)
    {
    	$getUser =  $this->siteusersAssignVar->where('id', $user_id)->first();
    	$getUser->otp = $otpPin;
    	$getUser->update();
     }


	public function loginUsers($request)
	{
		$email    = $request->input('email');
		$pass     = $request->input('password');

		$check_user_count 	= $this->siteusersAssignVar->where('email',$email)->count();
	    $user               = $this->siteusersAssignVar->where('email',$email)->first();
	   

		if($check_user_count > 0){
			 $user_pass          = $user->password;
	      	if(Hash::check($pass,$user_pass)) //check if password matched
			{
				// check if status is 1
				if($user->email_verified_status == 0){
					$responsedata = array(
									'status'	=> 0,
									'message'	=> "Your Signup request is pending",
									'data' 		=> array(),
								);

					
				} 
				else{
					$user_id_with_time 	= $user->id.':'.date("Y-m-d H:i:s");
					$token 				= Hash::make($user_id_with_time);
					$token 				= str_replace("/","", $token);
					$expiry_time   		= strtotime("+60 minutes");


					$this->userLoginDetailsAssignVer->user_id     = $user->id;
					$this->userLoginDetailsAssignVer->token       = $token;
					$this->userLoginDetailsAssignVer->login_time  = date("Y-m-d H:i:s");
					$this->userLoginDetailsAssignVer->expiry_time = date("Y-m-d H:i:s",$expiry_time);
					$this->userLoginDetailsAssignVer->save();

						$user = $user->toArray();

					$responsedata = array(
							'status'	=> 1,
							'data' 		=> $user,
							'message'	=> "Login successfully"
						);
				}
			}
			else  //if password not matched
			{
				$responsedata = array(
									'status'	=> 0,
									'data' 		=> array(),
									'message'	=> "Invalid credential"
								);
			}
		}
		else{
			$responsedata = array(
									'status'	=> 0,
									'data' 		=> array(),
									'message'	=> "Invalid User"
								);
		}



		return response()->json($responsedata);
		/*$this->siteusersAssignVar->email    = $request->input('email');
		$this->siteusersAssignVar->password = Hash::make($request->input('password'));
		
		$this->siteusersAssignVar->save();

		return $this->siteusersAssignVar->id;
		echo $siteusersAssignVar;*/
	}

	/**
     * Store a newly created resource in storage.
     *
     */
public function forgetPasswordUsers($request)
	{
		$email    = $request->input('email');

		$check_user_count 	= $this->siteusersAssignVar->where('email',$email)->count();
	    $user               = $this->siteusersAssignVar->where('email',$email)->first();
	   

		if($check_user_count > 0){
			 
				// check if status is 1
				if($user->email_verified_status == 0){
					$responsedata = array(
									'status'	=> 0,
									'message'	=> "Your email does not exsist",
									'data' 		=> array(),
								);

					
				} 
				else{
					
					$user = $user->toArray();

					$responsedata = array(
							        'status'	=> 1,
							        'message'	=> "User data get successfully",
							        'data' 		=> $user,
						);
				
				}

			}
			else  //if password not matched
			{
				$responsedata = array(
									'status'	=> 0,
									'data' 		=> array(),
									'message'	=> "Invalid credential"
								);
			}
			
			return $responsedata;
		}
		



		/*$this->siteusersAssignVar->email    = $request->input('email');
		$this->siteusersAssignVar->password = Hash::make($request->input('password'));
		
		$this->siteusersAssignVar->save();

		return $this->siteusersAssignVar->id;
		echo $siteusersAssignVar;*/
	
	public function create($attributes)
	{	
 		//
	}

	public function edit($id)
	{
       //
	}

	public function update($attributes, $id)
	{
		//
	}

	public function destroy($id){

		//
	}
 

	 
}
