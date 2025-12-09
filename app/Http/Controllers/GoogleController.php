<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Cek apakah Google mengirim email
            if (!$googleUser->getEmail()) {
                return redirect('/login')->withErrors('Email tidak tersedia dari akun Google Anda.');
            }

            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName() ?? $googleUser->getNickname() ?? 'User Google',
                    'password' => bcrypt('google-default'),
                    'google_id' => $googleUser->getId(),
                ]
            );

            // Jika user baru, set role default
            if ($user->wasRecentlyCreated) {
                $user->role = 'petani'; // default role
                $user->save();
            }

            Auth::login($user);

            return redirect('/');

        } catch (\Exception $e) {
            // Tampilkan error Google sebenarnya untuk debug
            return redirect('/login')->withErrors('Gagal login dengan Google: ');
        }
    }
}
