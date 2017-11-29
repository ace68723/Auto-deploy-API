<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\JWTAuth;

use App\User;

class AuthController extends Controller
{
    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    public function loginPost(Request $request)
    {
        $this->validate($request, [
            'username'    => 'required',
            'password' => 'required',
        ]);
        $user = User::where('username', '=', $request['username'])
                      ->where('password', '=',  $request['password'])
                      ->first();
        if (!$user){
          $result['ev_message'] = "User not found";
          $result['ev_error'] = 1;
          return $result;
        }
        $result = array();
        try {
          if (!$user || !$token=$this->jwt->fromUser($user)) {
              $result['ev_message'] = "Invalid token";
              $result['ev_error'] = 1;
              return $result;
          }
        } catch (Exception $e) {
            $result['ev_message'] = "Invalid credential";
            $result['ev_error'] = 1;
            return $result;
        }

        $result['ev_token'] = $token;
        $result['ev_error'] = 0;
        return response()->json($result);
    }
}
