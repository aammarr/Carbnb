<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Hash;;
use App\User;
use Validator;
use DB;


class MiniController extends Controller
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

    public function getAllCountries(Request $request){
    	$data = DB::table('countries as c')
    			->whereNull('c.deleted_at')
    			->select('c.*')
    			->get();

    	return response()->json(['status' => 'true','response' => $data,'error' => null]);
    }
	
	public function getCityByCountryId(Request $request,$countryId){
        $data = DB::table('cities as c')
                ->whereNull('c.deleted_at')
                ->where('c.country_id',$countryId)
                ->select('c.*')
                ->get();

        return response()->json(['status' => 'true','response' => $data,'error' => null]);
    }

    public function getAllCategories(Request $request){
    	$data = DB::table('categories as c')
    			->whereNull('c.deleted_at')
    			->select('c.*')
    			->get();

    	return response()->json(['status' => 'true','response' => $data,'error' => null]);
    }
}
