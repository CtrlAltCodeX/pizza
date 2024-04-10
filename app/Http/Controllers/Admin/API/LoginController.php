<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Login
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        $val = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($val->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $val->errors()->first()
            ]);
        }

        if (Auth::attempt($request->all())) {
            $user = Auth::user();
            $token = $user->createToken('AuthToken')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'token' => $token,
                'message' => 'login successfull'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'These credentials do not match our records.'
            ], 200);
        }
    }

    /**
     * Register
     *
     * @param Request $request
     * @return void
     */
    public function register(Request $request)
    {
        $val = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        if ($val->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $val->errors()->first()
            ]);
        }

        $password = Hash::make($request->password);

        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'phone' => $request->phone,
        ]);

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully registered'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong'
            ]);
        }
    }

    /**
     * Logout
     *
     * @param Request $request
     * @return array
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response([
            'success' => true,
            'message' => 'User Logout Successfully',
        ], 200);
    }
}
