<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request){
        $val = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($val->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $val->errors()->first()
            ]);
        }

        if (Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password,
            'is_admin' => 0
        ])) {
            return response()->json([
                'status' => 'success',
                'message' => 'login successfull'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'These credentials do not match our records.'
            ], 200);
        }
    }

    public function register(Request $request){
        $val = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:admin,email',
            'password' => 'required'
        ]);

        if($val->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $val->errors()->first()
            ]);
        }
        $password = Hash::make($request->password);

        $data = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'is_admin' => 0
        ]);

        if($data){
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully registered'
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong'
            ]);
        }
    }
}
