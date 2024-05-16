<?php

namespace App\Http\Controllers\Login;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LoginController extends Controller
{
    // Login
    public function login(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validateUser->fails()) {
                return response()->json([
                    'Status' => false,
                    'Message' => 'Validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            if (!$user || md5($request->password) !== $user->password) {
                return response()->json([
                    'Status' => false,
                    'Message' => 'Email and Password do not match'
                ], 401);
            }

            // Membuat token
            $token = Str::random(40);

            // Mendapatkan waktu saat ini dalam format yang benar
            $currentTime = Carbon::now()->format('Y-m-d H:i:s');

            // Menyisipkan data ke tabel user_token
            DB::table('user_token')->insert([
                'email' => $user->email,
                'token' => hash('sha256', $token),
                'date_created' => $currentTime
            ]);

            return response()->json([
                'Status' => true,
                'Message' => 'Login successfully',
                'token' => $token,
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'Status' => false,
                'Message' => $th->getMessage(),
            ], 500);
        }
    }

    // Logout
    public function logout(Request $request) 
    {
        try {
            $token = $request->header('Authorization');

            if (!$token) {
                return response()->json([
                    'Status' => false,
                    'Message' => 'Token not provided'
                ], 401);
            }
    
            $token = str_replace('Bearer ', '', $token);
    
            $userToken = DB::table('user_token')->where('token', hash('sha256', $token))->first();
    
            if (!$userToken) {
                return response()->json([
                    'Status' => false,
                    'Message' => 'Invalid token'
                ], 401);
            }
    
            // Hapus token dari tabel user_token
            DB::table('user_token')->where('token', hash('sha256', $token))->delete();
    
            return response()->json([
                'Status' => true,
                'Message' => 'Logged out successfully'
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'Status' => false,
                'Message' => $th->getMessage(),
            ], 500);
        }
    }
}
