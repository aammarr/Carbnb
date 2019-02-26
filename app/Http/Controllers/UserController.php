<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Hash;;
use App\User;
use Validator;
use DB;


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function signup(Request $request){

    	$this->validate($request,[
    	    'name' => 'required',
        	'email' => 'required|email|unique:users',
        	'password' => 'required|min:6',
        	'nic_number' => 'required',
        	'licence_number' => 'required',
            'country_code' => 'required',
            'city_id' => 'required',
            'phone' => 'required',
        	'address' => 'required',
   		]);

    	try{
 
    		$user = User::Create([
    			'email'=>$request['email'],
    			'password'=>app('hash')->make($request->input('password')),
    			'name'=>$request['name'],
    			'phone'=>$request['phone'],
    			'address'=>$request['address'],
    			'city_id'=>$request['city_id'],
    			'country_code'=>$request['country_code'],
    			'nic_number'=>$request['nic_number'],
    			'license_number'=>$request['licence_number'],
    			'role_id'=>'3',
    			'nic_isVerified'=>'0',
    			'license_isVerified'=>'0',
    			'isVerified'=>'0',
    			'access_token' => app('hash')->make('asdasdasdasdasd')
    		]);

            return response()->json($user);
    	}
    	catch(Exception $e){
    		// print_r($e);
    		return response()->json(['status' => 'fail'],401);
    	}

    }

    public function login(Request $request){
    	
    	$this->validate($request,[
    	    
        	'email' => 'required|email',
        	'password' => 'required|min:6',
        	
   		]);

   		try{
   			$email 		= $request['email'];
   			$password 	= $request['password'];

   			$user = User::where(['email'=>$email,'role_id'=>'3'])->first();

            if(empty($user)){
                return response()->json([
                    'status' => 'false',
                    'response' => null,
                    'error' => [
                        'custom_code' => '404', 
                        'message' => "Wrong Email or Password Entered!"
                    ],
                ],404);
            }


   			if(Hash::check($request->input('password'), $user->password)){
 
		        $apikey = base64_encode(str_random(40));
		        User::where('email', $request->input('email'))->update(['access_token'=>$apikey]);
	   			$user['access_token']=$apikey;
		 
		        return response()->json([
		        	'status' => 'true',
		        	'response' => $user,
		        	'error' => null
		        ]);
		 
		    }else{
		 
		        return response()->json([
		        	'status' => 'false',
		        	'response' => null,
		        	'error' => [
		        		'custom_code' => '404', 
		        		'message' => "Wrong Email or Password Entered!"
		        	],
		        ],404);
		 
		    }
   		}
   		catch(Exception $e){

   		}
    }

    public function forgetPassword(Request $request){
    	dd("forget password api.. ");
    }

    public function logout(Request $request){
    	
    	$user = User::where('email',$request->user['email'])->first();
        if(!$user){
        	return response()->json(['status' => 'false','response' => null,
        		'error' => [
		        		'custom_code' => '404', 
		        		'message' => "No User Found!"
		        	],
		        ],404);
        }

        $user->access_token = null;
        $user->fcm_token = null;
        $user->save(); 
    	
    	return response()->json([
		        	'status' => 'true',
		        	'response' => null,
		        	'error' => null
		        ]);
    }

    public function changePassword(Request $request){
    	dd($request);
    }

    public function profile(Request $request){
    	$user = $request['user'];
    	if(!$user){
        	return response()->json(['status' => 'false','response' => null,
        		'error' => [
		        		'custom_code' => '404', 
		        		'message' => "No User Found!"
		        	],
		        ],404);
        }

        return response()->json([
		        	'status' => 'true',
		        	'response' => $user,
		        	'error' => null
		        ]);

    }

    public function updateProfile(Request $request){

        $userId = $request['user']['id'];
        $user = User::find($userId);

        $name;$phone;$country_id;$city_id;$address;
        
        if(!$user){
            return response()->json(['status' => 'false','response' => null,
                'error' => [
                        'custom_code' => '404', 
                        'message' => "No User Found!"
                    ],
                ],404);
        }else{

            if(empty($request->name)){$name = $user['name']; }else{ $user->name = $request->name; }      
            if(empty($request->phone)){$phone = $user['phone']; }else{ $user->phone = $request->phone; }      
            if(empty($request->country_id)){$country_id = $user['country_id']; }else{ $user->country_id = $request->country_id; }      
            if(empty($request->city_id)){$city_id = $user['city_id']; }else{ $user->city_id = $request->city_id; }      
            if(empty($request->address)){$address = $user['address']; }else{ $user->address = $request->address; }                  
            $user->save();

            return response()->json([
                    'status' => 'true',
                    'response' => $user,
                    'error' => null
                ]);
        }
    }

}
