<?php

namespace App\Http\Controllers\Api;

use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Services\SiteUsersService;
use App\Mail\VerifyMail;

class HomeController extends Controller
{

	protected $siteUsersServ;

    public function __construct(SiteUsersService $siteUsersServ)
    {
        $this->siteUsersServ   = $siteUsersServ;
    }


    public function index(){
    	return view('api/home');
    }

    public function loginView(){
    	return view('api/login');
    }
     public function registerView(){
    	return view('api/registration');
    }

    public function userRegister(Request $request){
    	 
    	try {

    		/* data validation */
            $validator = Validator::make($request->all(), [
                        'fullname' => 'required', 
                        'email'    => 'required|email|unique:site_users',                        
                        'password' => 'required|min:8|max:30',
                        'phone'    => 'required|min:8|max:14',              
                        
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

            	$saveUsers = $this->siteUsersServ->saveUsers($request);

            	$username  = $request->input('fullname');
            	$useremail = $request->input('email');
            	$activation_url = "http://localhost:8000/api/register";
            	$site_url = "http://localhost:8000/home";

            	Mail::to($useremail)->send(new VerifyMail($username,$activation_url,$site_url));
            	
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
