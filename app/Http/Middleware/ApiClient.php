<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

use App\User;
use DB; 

class ApiClient
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $client_id = $request->header('client_id');
        $authorization_header = $request->header('Authorization');
        $client_secret = str_replace("Basic ","",$authorization_header);
        /*$client = DB::table('clients')
                    ->where('client_id', $client_id)
                    ->where('client_secret',$client_secret)
                    ->first();


        if($client){
            return $next($request);
        }
        dd("hh",$request->header('client_id'),$request->header('Authorization'),$authorization_header);
        */

        // $access_token = $request->header('Authorization');
        // $access_token = str_replace("Bearer ","",$access_token);
        if($authorization_header){
            $user = User::where('access_token',$authorization_header)->first();

            if($user){
                $request->merge(array("user"=>$user));
                return $next($request);
            }
        }

        return response('Unauthorized.', 401);
        
        // if ($this->auth->guard($guard)->guest()) {
        
        //     return response('Unauthorized.', 401);
        // }
        // return $next($request);
    }
}
