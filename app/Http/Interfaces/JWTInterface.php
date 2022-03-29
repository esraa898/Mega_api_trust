<?php 

namespace App\Http\Interfaces;

interface  JWTInterface{ 

    public function register( $request);
    public function login( $request);
    public function logout();
    public function respondWithToken($token);
    
}