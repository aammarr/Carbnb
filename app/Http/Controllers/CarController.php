<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Hash;;
use App\User;
use App\Car;
use Validator;
use DB;


class CarController extends Controller
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

    public function getCars(Request $request){
    		$car = new Car(); 
    		$data = $car->getAllCars();

    		if(!$data){
    			return response()->json([
                    'status' => 'true',
                    'response' => null,
                    'error' => null
                ]);

    		}else{
    			return response()->json([
                    'status' => 'true',
                    'response' => $data,
                    'error' => null
                ]);
    		}
    }

    public function getUserCars(Request $request){
    	$userId = $request['user']['id'];
        $user = User::find($userId);

        $car = new Car(); 
    		$data = $car->getUserCars($userId);

    		if(!$data){
    			return response()->json([
                    'status' => 'true',
                    'response' => null,
                    'error' => null
                ]);

    		}else{
    			return response()->json([
                    'status' => 'true',
                    'response' => $data,
                    'error' => null
                ]);
    		}
    }

    public function addUserCar(Request $request){

    	$this->validate($request,[
    	    'user_id' => 'required',
        	
        	'user_id' 		  => 'required',
	        'category_id' 	  => 'required',

	    	'car_title'	      => 'required',
	        'car_make' 		  => 'required',
	        'car_model'	 	  => 'required',
	        'car_year' 		  => 'required',
	        'car_color' 	  => 'required',
	        'car_engine_type' 	=> 'required',
	        'car_transmission' 	=> 'required',
	        'car_chasisNumber' 	=> 'required',
	        'car_engineNumber' 	=> 'required',
	        'car_ratePerDay' 	=> 'required',
	        'car_ratePerHour' 	=> 'required',
	        'bluetooth' 	=> 'required',
            'childseat'     => 'required',
	        'gps' 	        => 'required',
	        'four_wheel' 	=> 'required',
	        'ac' 			=> 'required',
	        'delivery_onSite' 	=> 'required',
	        'withDriver' 		=> 'required',
	        'rental_deposit' 	=> 'required',
	        'car_paper' 	=> 'required',
	        'car_address' 	=> 'required',
            'car_lat'       => 'required',
	        'car_long' 		=> 'required',
            'available_from'      => 'required',
	        'available_to' 		=> 'required',
	        'car_payment_method' => 'required',
	        'car_avatar_1' => 'required',
	        'car_avatar_2' => 'required',
	        'car_avatar_3' => 'required',
	        'car_avatar_4' => 'required',
	        'car_avatar_5' => 'required',
   		]);

    	$userId = $request['user']['id'];
        $user = User::find($userId);

    	$car = new Car();
    	
    	$car->user_id 		=  $userId;
        $car->category_id 	= $request->category_id;

    	$car->car_title 	= $request->car_title;
        $car->car_make 		= $request->car_make;
        $car->car_model	 	= $request->car_model;
        $car->car_year 		= $request->car_year;
        $car->car_color 	= $request->car_color;
        $car->car_engine_type 	= $request->car_engine_type;
        $car->car_transmission 	= $request->car_transmission;
        $car->car_chasisNumber 	= $request->car_chasisNumber;
        $car->car_engineNumber 	= $request->car_engineNumber;
        $car_ratePerDay 	= $request->car_ratePerDay;
        $car_ratePerHour 	= $request->car_ratePerHour;
        $car->bluetooth 	= $request->bluetooth;
        $car->childseat     = $request->childseat;
        $car->gps 	        = $request->gps;
        $car->four_wheel 	= $request->four_wheel;
        $car->ac 			= $request->ac;
        $car->delivery_onSite 	= $request->delivery_onSite;
        $car->withDriver 		=  $request->withDriver;
        $car->rental_deposit 	=  $request->rental_deposit;
        $car->car_paper 	=  $request->car_paper;
        $car->car_address 	=  $request->car_address;
        $car->car_lat 		=  $request->car_lat;
        $car->car_long 		=  $request->car_long;
        $car->available_from 	=  $request->available_from;
        $car->available_to 		=  $request->available_to;
        $car->car_payment_method=  $request->car_payment_method; 
        $car->car_avatar_1 =  $request->car_avatar_1;
        $car->car_avatar_2 =  $request->car_avatar_2;
        $car->car_avatar_3 =  $request->car_avatar_3;
        $car->car_avatar_4 =  $request->car_avatar_4;
        $car->car_avatar_5 =  $request->car_avatar_5;
        $car->save();

        return response()->json([
                    'status' => 'true',
                    'response' => ["Your car has been added!"],
                    'error' => null
                ]);
    }
}