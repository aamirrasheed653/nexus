<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    protected function genToken($user, $email)
    {
        $plainTextToken = $user->createToken($email)->plainTextToken;
        $parts = explode('|', $plainTextToken);  //token and expiry date are separated by '|' in Laravel
        return $parts[1];
    }
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'role' => 'required'
        ]);
        $user = User::create([
            ...$data,
            'password' => Hash::make($request->password)
        ]);
        $token = $this->genToken($user, $request->email);
        $user['token'] = $token;
        return $user;

    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response(['message' => 'invalid credentials']);
        }
        $user['token'] = $this->genToken($user, $user->email);
        return $user;
    }

    public function changepass(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed'
        ]);
        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->save();
        return response(['message' => 'Password changed successfully'], 201);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response(['message' => 'Logged out'], 200);
    }
}
