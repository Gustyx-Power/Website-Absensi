<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class SocialiteController extends Controller
{
    /**
     * Redirect ke Google OAuth
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle callback dari Google OAuth dengan "Role Lock" mechanism
     * 
     * ROLE LOCK LOGIC:
     * - Jika email sudah ada di database (Owner/Admin) → Update avatar/name saja, JANGAN UBAH ROLE
     * - Jika email baru → Create user baru dengan role 'employee'
     */
    public function handleGoogleCallback()
    {
        try {
            // Get user info dari Google
            $googleUser = Socialite::driver('google')->user();

            // Cari user berdasarkan email
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // USER SUDAH ADA - Update hanya avatar dan name, PRESERVE role
                $user->update([
                    'name' => $googleUser->getName(),
                    'avatar' => $googleUser->getAvatar(),
                    'google_id' => $googleUser->getId(),
                    'email_verified_at' => now(),
                    // TIDAK update role! Ini adalah ROLE LOCK mechanism
                ]);

                // Log untuk debugging
                \Log::info("Existing user logged in via Google: {$user->email} (Role: {$user->role})");
            } else {
                // USER BARU - Create dengan role 'employee'
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'avatar' => $googleUser->getAvatar(),
                    'google_id' => $googleUser->getId(),
                    'email_verified_at' => now(),
                    'role' => 'employee', // Force role ke employee untuk user baru
                    'password' => null, // No password karena auth via Google
                ]);

                // Log untuk debugging
                \Log::info("New user created via Google: {$user->email} (Role: employee)");
            }

            // Login user
            Auth::login($user, true);

            // Redirect berdasarkan role
            return $this->redirectBasedOnRole($user);

        } catch (Exception $e) {
            \Log::error('Google OAuth Error: ' . $e->getMessage());

            return redirect('/login')->with('error', 'Gagal login dengan Google. Silakan coba lagi.');
        }
    }

    /**
     * Redirect user berdasarkan role
     */
    private function redirectBasedOnRole(User $user)
    {
        if ($user->isOwner() || $user->isAdmin()) {
            return redirect()->route('admin.dashboard')
                ->with('success', "Selamat datang, {$user->name}!");
        }

        return redirect()->route('employee.check-in')
            ->with('success', "Selamat datang, {$user->name}!");
    }

    /**
     * Logout
     */
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil logout.');
    }
}
