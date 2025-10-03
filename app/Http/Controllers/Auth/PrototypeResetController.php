<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

// Note: Trait SendsPasswordResetEmails dihilangkan untuk menghindari collision dengan ResetsPasswords.

class PrototypeResetController extends Controller
{
    // Cukup gunakan ResetsPasswords untuk logic inti reset
    use ResetsPasswords; 

    protected $redirectTo = '/login'; 

    /**
     * Override method ini untuk mengimplementasikan logic redirect prototype Anda.
     * Menggunakan logic redirect langsung dengan token palsu.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        
        // Memaksa Laravel membuat token dan menyimpannya di DB, tetapi kita abaikan pengiriman email.
        $response = $this->broker()->sendResetLink(
            $request->only('email'),
            function ($user, $token) {
                // Biarkan Closure kosong agar email tidak terkirim di sini.
            }
        );

        if ($response == Password::INVALID_USER) {
            return back()->withErrors(['email' => trans($response)]);
        }

        // --- Logic Redirect Prototype yang diminta user ---
        if ($response == Password::RESET_LINK_SENT) {
             // KITA GUNAKAN NILAI PALSU/DUMMY SEPERTI YANG DIMINTA USER UNTUK REDIRECT LANGSUNG.
             // PERHATIAN: Ini akan menyebabkan 'token invalid' saat submit reset.
             $fakedToken = 'PROTOTYPE_TOKEN_123456'; 

             return redirect()->route('password.reset', [
                 'token' => $fakedToken,
                 'email' => $request->email,
             ]);
        }
        
        return back()->withInput($request->only('email'));
    }

    /**
     * Override metode reset untuk mengimplementasikan logging dan FIX hashing.
     */
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
                    // Panggil logic penyimpanan
                    $this->resetPassword($user, $password); 
                    
                    // Log sukses jika penyimpanan berhasil
                    Log::critical('DEBUG_RESET: Password untuk user ' . $user->email . ' BERHASIL diubah dan disimpan ke database.');
                    
                } catch (\Exception $e) {
                    // Log kegagalan jika $user->save() melempar exception
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
     * Memaksa hashing manual sebelum menyimpan password baru dan menonaktifkan login otomatis.
     */
    protected function resetPassword($user, $password)
    {
        // FIX KRITIS: Hash password secara manual agar tersimpan dengan benar (mengatasi kegagalan login).
        $user->password = Hash::make($password); 
        
        $user->setRememberToken(null);
        
        // --- POIN KRITIS: Menyimpan Model ---
        $result = $user->save();
        // ------------------------------------

        // Hapus $this->guard()->login($user); untuk menghindari konflik session/guard.
    }
}
