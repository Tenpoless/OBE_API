<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
// use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Temukan user berdasarkan email
        $users = User::where('email', $credentials['email'])->get();

        // Jika tidak ada user dengan email tersebut
        if ($users->isEmpty()) {
            return response()->json(['error' => 'Email atau Password salah'], 401);
        }

        // Verifikasi password dan level
        foreach ($users as $user) {
            if ($user->verifyPassword($credentials['password'])) {
                if (in_array($user->level, [3, 4])) {
                    $customClaims = [
                        's' => $user->id_user,
                        'e' => now()->addHours(3)->timestamp,
                    ];

                    // Buat token dengan klaim khusus
                    try {
                        $token = JWTAuth::claims($customClaims)->fromUser($user);
                    } catch (JWTException $e) {
                        return response()->json(['error' => 'could_not_create_token'], 500);
                    }

                    // Dapatkan level user
                    $level = $user->level;

                    $id_user = $user->id_user;

                    $status = $user->status;

                    // Log informasi pengguna untuk debugging
                    Log::info('User ID: ' . $user->id . ', Level: ' . $level);

                    // Kembalikan token dan level
                    return response()->json(compact('token', 'level', 'id_user', 'status'));
                } else {
                    // Jika user berlevel selain 3 dan 4
                    return response()->json(['error' => 'Anda tidak terdaftar'], 401);
                }
            }
        }
        // Jika tidak ada user yang cocok dengan password
        return response()->json(['error' => 'Email atau Password salah'], 401);
    }
}
