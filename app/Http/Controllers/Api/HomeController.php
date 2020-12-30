<?php

namespace App\Http\Controllers\Api;

use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Services\SiteUsersService;
use App\Services\VerifyUsersService;
use App\Mail\VerifyMail;
use App\Mail\ResetPasswordMail;

class HomeController extends Controller
{

	  protected $siteUsersServ;
    protected $verifyUsersServ;

    public function __construct(SiteUsersService $siteUsersServObj, VerifyUsersService $verifyUsersServObj)
    {
        $this->siteUsersServ   = $siteUsersServObj;
        $this->verifyUsersServ = $verifyUsersServObj;
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
    public function forgetPassword(){
      return view('api/forget-password');
    }
     public function newPassword(){
      return view('api/new_password');


    }
  

    


    public function submitUserLogin(Request $request){
     
     try {

        /* data validation */
            $validator = Validator::make($request->all(), [
                        
                        'email'    => 'required|email',                        
                        'password' => 'required|min:8|max:30',
                        
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

              $responsedata = $this->siteUsersServ->loginUsers($request);            
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

            	$lastId = $this->siteUsersServ->saveUsers($request);

              $verify_token = $this->verifyUsersServ->saveVerifyUser($lastId);

            	$username  = $request->input('fullname');
            	$useremail = $request->input('email');
            	$activation_url = "http://localhost:8000/api/verifyUserToken/".$verify_token;
            	$site_url       = "http://localhost:8000/home";

            	Mail::to($useremail)->send(new VerifyMail($username,$activation_url,$site_url));
            	
              return redirect('api/userLogin');
              //return \Redirect::route('userLogin');

            	/*$responsedata = [
                             'status'     => true, 
                             'message'    => "User data saved",
                 		         'data'       => $saveUsers
                            ];*/


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

    public function checkVerifyUser($token, Request $request){
       try {

        $verifyUserData = $this->verifyUsersServ->checkVerifyUser($token);

        if (!empty($verifyUserData)) {
          $updateUser = $this->siteUsersServ->updateUser($verifyUserData->user_id);
          return redirect('api/userLogin');
        }else{
          return redirect('api/register');
        }

      } catch (Exception $e) {
            /* build response  */
          $responsedata = [
                             'status'     => false, 
                             'message'    => $e->getMessage(),
                             'data'       => new \stdClass()
                            ];
        } 
    }
    


    public function forgetPasswordUser(Request $request){
     
      try {

        /* data validation */
            $validator = Validator::make($request->all(), [
                        'email'    => 'required|email',                        
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
                                  'data'   => array(),
                                ];
            else :


            $responsedata = $this->siteUsersServ->forgetPasswordUsers($request);


            /*echo "<pre>";
            print_r($responsedata);
            die();*/


            $username  = $responsedata['data']['name'];
            $useremail = $responsedata['data']['email'];

            $activation_url = "http://localhost:8000/api/new_password";
            $site_url       = "http://localhost:8000/home";

            $i = 0;
            $otpPin = ""; 
            while($i < 4){
                $otpPin .= mt_rand(0, 9);
                $i++;
            }

            Mail::to($useremail)->send(new ResetPasswordMail($username,$activation_url,$site_url, $otpPin));

            return redirect('api/new_password');
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
}
 