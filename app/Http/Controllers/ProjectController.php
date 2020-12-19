<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Validator;
use App\Services\Projectservice;

class ProjectController extends Controller
{
    protected $Project;

    public function __construct(Projectservice $Projectserv)
    {
        $this->Projectserv   = $Projectserv;
    }
    public function index(){
    	
    	return view('projectform');
    }
    //public function store(Request $request){

    // $project_obj = new project();
     //$project_obj->name = $request->name;
      //$project_obj->descr = $request->descr;
    // $project_obj->site_user_id = $request->site_user_id;
     //$project_obj->status = $request->status;
   //  $project_obj->save();

   
    public function saveData(Request $request){
         
        try {

            /* data validation */
            $validator = Validator::make($request->all(), [
                        'name' => 'required', 
                        'descr'    => 'required|unique:projects',                       
                      
            ]);


            if ($validator->fails()) :
              
                 /* data validation response ready */
                $validatorMsg = $validator->errors()->toArray(); /* get error msg */
               
                foreach ($validatorMsg as $key => $error) {
                    $message = $error[0];
                    break;
                }

                $responsedata   = [
                                  'status' => false, 
                                  'message'    => $message,
                                  'data'   => new \stdClass()
                                ];
            else :

                $saveUsers = $this->Projectserv->saveProjects($request);

                $responsedata = [
                             'status'     => true, 
                             'message'    => "User data saved",
                             'data'       => new \stdClass()
                            ];


            endif;
        } catch (Exception $e) {
            /* build response  */
            $responsedata = [
                             'status'     => false, 
                             'message'    => $e->getMessage(),
                             'data'       => new \stdClass()
                            ];
        }   

        return response()->json($responsedata);
    }
    //$_POST['']
}

    

    

