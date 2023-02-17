<?php

namespace App\Repositories;



use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthRepositoryInterface
{
    public function register(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed'
        ]);

        if($validator->fails()){
            return response()->json([
                "msg"=>$validator->errors()
            ],404);
        }

        $user = User::create([
            'name' => $request['name'],
            'password' => bcrypt($request['password']),
            'email' => $request['email']
        ]);
        return response()->json([
            "register"=>"Success"
        ],200);
    }

    public function login(Request $request){
        $validator=Validator::make($request->all(),[
            'email' => 'required|string|email',
            'password' => 'required|string|min:6'
        ]);

        if($validator->fails()){
            return response()->json([
                "msg"=>$validator->errors()
            ],404);
        }
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user=Auth::user();
            return response()->json([
                'access_token'=>$user->createToken('user')->plainTextToken,
                'token_type'=>'Bearer'
            ]);
        }else{
            return response()->json([
                "login"=>"Error"
            ],400);
        }
    }

    public function logout(Request $request){
         $user=$request->user();
         if($user != null){
          
         $user->tokens()->delete();

         return response()->json([
            "logout"=>"Success"
        ],200);
    }else{
        return response()->json([
            "logout"=>"Error"
        ],404);
    }
    }
}
    
