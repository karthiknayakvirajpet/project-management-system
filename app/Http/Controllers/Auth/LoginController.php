<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /************************************************************************
    *Registration Form
    *************************************************************************/
    public function registerForm()
    {        
        return view('auth.register');
    }

    /************************************************************************
    *User registration
    *************************************************************************/
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:1,2', // Ensure role is either 1 or 2
        ]);

        if ($validator->fails()) 
        {
            return $request->route()->getPrefix() === 'api' ? $this->api400($validator->errors()) : $this->webError($validator);
        }

        //create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        if($user) //Success
        {
            if($request->route()->getPrefix() === 'api') //api
            {
                return $this->api201();
            }
            else //web
            {
                return redirect()->route('login')->with('success', 'Registered successfully.');
            }
        }
        else //Fail
        {
            if($request->route()->getPrefix() === 'api') //api
            {
                return $this->api400('Failed.');
            }
            else //web
            {
                return redirect()->back()->withErrors(['error' => 'Something went wrong.']);
            }
        }
    }

    /************************************************************************
    *Login Form
    *************************************************************************/
    public function loginForm()
    {
        //If user is already logged in then redirect to home
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        return view('auth.login');
    }

    /************************************************************************
    *Login function
    *************************************************************************/
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) 
        {
            return $request->route()->getPrefix() === 'api' ? $this->api400($validator->errors()) : $this->webError($validator);
        }

        //login credentials
        $credentials = $request->only('email', 'password');

        //authentication logic
        if (Auth::attempt($credentials))
        {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken; //create a token for API

            if($request->route()->getPrefix() === 'api') //api
            {
                return response()->json([
                    'message' => 'Success.',
                    'data' => ['access_token' => $token, 'token_type' => 'Bearer',],
                ])->setStatusCode(200);
            }
            else //web
            {
                return redirect()->intended('/dashboard');
            }
        }
        else //Fail
        {
            if($request->route()->getPrefix() === 'api') //api
            {
                return response()->json(['message' => 'Invalid credentials.','data' => []])->setStatusCode(401);
            }
            else //web
            {
                return redirect()->back()->withInput()->withErrors(['login' => 'Invalid credentials.']);
            }
        }
    }

    /************************************************************************
    *Logout function
    *************************************************************************/
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
