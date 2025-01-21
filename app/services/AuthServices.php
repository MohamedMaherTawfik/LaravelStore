<?php

namespace App\Services;

use App\Http\Controllers\api\apiResponseusers;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\ValidationException;

class AuthServices
{
    use apiResponseusers;
    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'address'=>'required',
            'phone'=>'required',
        ]);

        if($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),400 );
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['user'] =  $user;

        return $this->apiResponse($success, 'User register successfully.',200);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return $this->apiResponse(null, 'Unauthorized', 401);
        }

        $success = $this->respondWithToken($token);

        return $this->apiResponse($success, 'User login successfully.',200);
    }

    public function profile()
    {
        $success = auth()->user();

        return $this->apiResponse($success, 'Refresh token return successfully.',200);
    }


    public function logout()
    {
        auth()->logout();

        return $this->apiResponse([], 'Successfully logged out.',200);
    }

    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }

}
