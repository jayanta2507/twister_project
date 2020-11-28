<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index(){
    	
    	return view('projectform');
    }
    public function store(Request $request){

     $project_obj = new project();
     $project_obj->title = $request->title;
    // $project_obj->site_user_id = $request->site_user_id;
     //$project_obj->status = $request->status;
     $project_obj->save();


    }

    }

