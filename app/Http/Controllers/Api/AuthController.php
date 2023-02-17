<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Interfaces\AuthRepositoryInterface;

class AuthController extends Controller
{
    private $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(Request $request){
        return   $register = $this->authRepository->register($request);
        
    }

    public function login(Request $request){
        return $login=$this->authRepository->login($request);
    }

    public function logout(Request $request){
        return $logout=$this->authRepository->logout($request);
    }
}
