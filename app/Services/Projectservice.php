<?php

namespace App\Services;

use App\Models\Project;
use DB;

class ProjectService
{

	protected $project;

	public function __construct(project $project)
	{
		$this->project = $project;

	}

	/**
     * Display a listing of the Dashboard.
     *
     * @param varchar searchKey this the key for seach record
     * @return \Illuminate\Http\Response
     */

	public function saveProjects($request)
	{

		$this->project->name     = $request->input('name');
		$this->project->descr    = $request->input('descr');
		
		$projectIsSaved = $this->project->save();

		return $projectIsSaved;
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