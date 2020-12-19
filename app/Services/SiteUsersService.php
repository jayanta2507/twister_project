<?php

namespace App\Services;

use App\Models\SiteUsers;
use DB;

class SiteUsersService
{

	protected $siteusers;

	public function __construct(SiteUsers $siteusers)
	{
		$this->siteusers = $siteusers;

	}

	/**
     * Display a listing of the Dashboard.
     *
     * @param varchar searchKey this the key for seach record
     * @return \Illuminate\Http\Response
     */

	public function saveUsers($request)
	{

		$this->siteusers->name     = $request->input('fullname');
		$this->siteusers->email    = $request->input('email');
		$this->siteusers->password = $request->input('password');
		$this->siteusers->phone    = $request->input('phone');
		$userIsSaved = $this->siteusers->save();

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