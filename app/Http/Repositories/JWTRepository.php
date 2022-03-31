<?php


namespace App\Http\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Interfaces\JWTInterface;
use App\Http\traits\ApiResponceTrait;
use Illuminate\Support\Facades\Validator;

class JWTRepository implements JWTInterface
{
    use ApiResponceTrait;
    
    /**
     * Register user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register( $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string',
        ]);

        if($validator->fails()) {
            return $this->apiResponce(404,'Validation Error',$validator->errors());
        }

        $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

        return $this->login($request);
    }

    /**
     * login user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login( $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return $this->apiResponce(404,'Validation Error',$validator->errors());
        }

        if (!$token = auth()->attempt($validator->validated())) {
            return $this->apiResponce(404,'Unauthorized',$validator->errors());
            
        }

        return $this->respondWithToken($token);
    }

    /**
     * Logout user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return $this->apiResponce(200,'User successfully logged out.') ;
    }

    

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithToken($token)
    {
        $array=[
            'access_token' => $token,
        
         
        ];
        return $this->apiResponce(200,'login',null,$array);
    }


}