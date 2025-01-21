<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\userResource;
use App\Models\User;
use App\Services\AuthServices;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class AuthController extends Controller
{
    use apiResponseusers;
    private $AuthServices;
    public function __construct(AuthServices $AuthServices)
    {
        $this->AuthServices = $AuthServices;
    }
    public function register(\Illuminate\Http\Request $request)
    {
        return $this->AuthServices->register($request);
    }

    public function login()
    {
        return $this->AuthServices->login();
    }
    public function logout()
    {
        return $this->AuthServices->logout();
    }
}
