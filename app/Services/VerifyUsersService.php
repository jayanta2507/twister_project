<?php

namespace App\Services;

use App\Models\VerifyUsers;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

 
class VerifyUsersService
{

	protected $verifyuserAssignVar;

	public function __construct(VerifyUsers $verifyuserObj)
	{
		$this->verifyuserAssignVar = $verifyuserObj;

	}

	/**
     * Display a listing of the Dashboard.
     *
     * @param varchar searchKey this the key for seach record
     * @return \Illuminate\Http\Response
     */

	public function saveVerifyUser($lastId)
	{

		$this->verifyuserAssignVar->user_id  = $lastId;
		$this->verifyuserAssignVar->token    = Str::random(40);
		$this->verifyuserAssignVar->save();

		return $this->verifyuserAssignVar->token;
	}



	public function checkVerifyUser($token){
		$verifyUserData = $this->verifyuserAssignVar->select('user_id')->where('token',$token)->first();

		if (!empty($verifyUserData)) {
			return $verifyUserData;
		}else{
			$blankObj = new \stdClass();
			return $blankObj; 
		}
	}

	/**
     * Store a newly created resource in storage.
     *
     */

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