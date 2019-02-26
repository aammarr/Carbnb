<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use DB;

class Car extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function getAllCars(){
        // return Car::all();
        return DB::table('cars as c')
                ->leftJoin('users as u','u.id','c.user_id')
                ->whereNull('c.deleted_at')
                ->select('c.*','u.name','u.avatar')
                ->get();
    }

    public function getUserCars($userId){
        // return Car::all();
        return DB::table('cars as c')
                ->leftJoin('users as u','u.id','c.user_id')
                ->where('c.user_id',$userId)
                ->whereNull('c.deleted_at')
                ->select('c.*','u.name','u.avatar')
                ->get();
    }
}
