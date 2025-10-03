<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class CustomResetPasswordController extends Controller
{
    // Menggunakan trait bawaan Laravel
    use ResetsPasswords;

    protected $redirectTo = '/login'; 

    public function reset(Request $request)
    {
        // 1. Validasi Input
        $request->validate($this->rules(), $this->validationErrorMessages());

        // DEBUG: Catat token yang diterima untuk diagnosis
        Log::critical('DEBUG_TOKEN_SENT: Email: ' . $request->email . ' | Token Diterima: ' . Str::limit($request->token, 20));

        // 2. Proses Reset Bawaan Laravel
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                
                try {
                    $this->resetPassword($user, $password); 
                    Log::critical('DEBUG_RESET: Password untuk user ' . $user->email . ' BERHASIL diubah dan disimpan ke database.');
                    
                } catch (\Exception $e) {
                    Log::error('DEBUG_RESET_ERROR: GAGAL menyimpan password baru. Error: ' . $e->getMessage());
                    throw $e; 
                }
            }
        );

        // 3. Tanggapi Hasil Reset
        return $response == Password::PASSWORD_RESET
                    ? $this->sendResetResponse($request, $response)
                    : $this->sendResetFailedResponse($request, $response);
    }
    
    /**
     * Memaksa hashing manual sebelum menyimpan password baru.
     */
    protected function resetPassword($user, $password)
    {
        // --- FIX KRITIS: Hash password secara manual ---
        $user->password = Hash::make($password); 
        // ---------------------------------------------
        
        $user->setRememberToken(null);
        $user->save();
        
        // Memaksa login ulang
        $this->guard()->login($user);
    }
}
