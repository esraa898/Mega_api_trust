<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\JWTInterface;
use Illuminate\Http\Request;


class JWTController extends Controller
{


    /**
     * Create a new AuthController instance.
     *
     * @return void
     */

    protected $JwtInterface;
    public function __construct(JWTInterface $JwtInterface)
    {
        $this->JwtInterface = $JwtInterface;
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Register user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        return $this->JwtInterface->register($request);
    }

    /**
     * login user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        return $this->JwtInterface->login($request);
    }

    /**
     * Logout user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        return $this->JwtInterface->logout();
    }



    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return $this->JwtInterface->respondWithToken($token);
    }
}
