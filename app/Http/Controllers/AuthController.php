<?php

// app/Http/Controllers/AuthController.php

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
        // $users = User::where('email', $credentials['email'])->get();
        // $users = User::where('email', $credentials['email'])->whereIn('level', [2,4])->get();
        $users = User::whereIn('level', [3, 4])->where('email', $credentials['email'])->get();
        // $users = User::where('email', $credentials['email'])->where('level', 2)->get();

        // Verifikasi password menggunakan MD5
        foreach ($users as $user) {
            if ($user->verifyPassword($credentials['password'])) {
                $token = JWTAuth::fromUser($user);

                // Dapatkan level user
                $level = $user->level;

                // Log informasi pengguna untuk debugging
                Log::info('User ID: ' . $user->id_user . ', Level: ' . $user->level);

                // Kembalikan token dan level
                return response()->json(compact('token', 'level'));
            }
        }

        // Jika tidak ada user yang cocok dengan email dan password
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
