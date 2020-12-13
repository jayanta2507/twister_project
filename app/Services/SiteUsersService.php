<?php

namespace App\Services;

use App\Models\SiteUsers;
use DB;

class SiteUsersService
{

	protected $siteusersAssignVar;

	public function __construct(SiteUsers $siteusersObj)
	{
		$this->siteusersAssignVar = $siteusersObj;

	}

	/**
     * Display a listing of the Dashboard.
     *
     * @param varchar searchKey this the key for seach record
     * @return \Illuminate\Http\Response
     */

	public function saveUsers($request)
	{

		$this->siteusersAssignVar->name     = $request->input('fullname');
		$this->siteusersAssignVar->email    = $request->input('email');
		$this->siteusersAssignVar->password = $request->input('password');
		$this->siteusersAssignVar->phone    = $request->input('phone');
		$userIsSaved = $this->siteusersAssignVar->save();

		return $userIsSaved;
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