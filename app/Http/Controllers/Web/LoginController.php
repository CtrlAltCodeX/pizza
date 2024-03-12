<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function Laravel\Prompts\password;

class LoginController extends Controller
{
    public function register(Request $request)
    {
        $val = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'phone' => 'required',
            'firstname' => 'required',
        ]);

        if ($val->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $val->errors()->first()
            ]);
        }

        $data = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            //            'address' => $request->address,
            'name' => $request->firstname,
        ]);

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'You have successfully registered'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Something is wrong.'
            ]);
        }
    }

    public function login(Request $request)
    {
        $val = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($val->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $val->errors()->first()
            ]);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json([
                'status' => 'success',
                'message' => 'login successfull'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Invalid email or Invalid password'
            ]);
            // return redirect()->back()->withInput()->withErrors(['email' => 'Invalid email', 'password' => 'Invalid password']);
        }
    }

    /**
     * Logout
     *
     * @return void
     */
    public function logout()
    {
        Auth::logout();

        return redirect()->back();
    }
}
