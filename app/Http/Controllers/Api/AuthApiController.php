<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthApiController extends Controller
{
    //register
    public function register(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ])->validate();

        if($validator){
            $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        User::create($data);

        $user = User::where('email',$request->email)->first();

        return response()->json([
                    'status' => true,
                    'user' => $user,
                    'token' => $user->createToken(time())->plainTextToken
                ],200);
        }else{
            return response()->json([
                'status'=>false,
                'message'=> 'Validation Error'
            ]);
        }

    }

    //login
    public function login(Request $request){
        $user = User::where('email',$request->email)->first();

        if(isset($user)){
            if(Hash::check($request->password,$user->password)){
                return response()->json([
                    'status' => true,
                    'user' => $user,
                    'token' => $user->createToken(time())->plainTextToken
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'user' => null,
                    'token' => null
                ]);
            }
        }else{
            return response()->json([
                    'status' => false,
                    'user' => null,
                    'token' => null
                ]);
        }
    }
}
