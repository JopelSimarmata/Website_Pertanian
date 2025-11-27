<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = null;
        if ($user) {
            $profile = DB::table('user_profiles')->where('user_id', $user->id)->first();
        }

        return view('pages.profile', compact('user', 'profile'));
    }

    /**
     * Update profile data (simple implementation).
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        if (! $user) {
            return redirect()->route('profile.index')->with('error', 'User not authenticated');
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'id_number' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'bank_name' => 'nullable|string|max:100',
            'bank_account_name' => 'nullable|string|max:255',
            'bank_account_number' => 'nullable|string|max:50',
            'avatar' => 'nullable|file|image|max:5120',
        ]);

        // update basic user
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

        // handle avatar upload (stored under storage/app/public/profiles)
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $ext = $file->getClientOriginalExtension();
            $filename = $user->id . '_avatar.' . $ext;
            // store in public disk (storage/app/public/profiles)
            $file->storeAs('profiles', $filename, 'public');
            // store relative path (without 'public/') so we can use asset('storage/...') in views
            $avatarPath = 'profiles/' . $filename;
        }

        // store profile fields in user_profiles table (include avatar if uploaded)
        $profilePayload = [
            'id_number' => $data['id_number'] ?? null,
            'address' => $data['address'] ?? null,
            'city' => $data['city'] ?? null,
            'province' => $data['province'] ?? null,
            'postal_code' => $data['postal_code'] ?? null,
            'bank_name' => $data['bank_name'] ?? null,
            'bank_account_name' => $data['bank_account_name'] ?? null,
            'bank_account_number' => $data['bank_account_number'] ?? null,
            'updated_at' => now(),
        ];

        if ($avatarPath) {
            $profilePayload['avatar'] = $avatarPath;
        }

        DB::table('user_profiles')->updateOrInsert(
            ['user_id' => $user->id],
            array_merge(['user_id' => $user->id, 'created_at' => now()], $profilePayload)
        );

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui');
    }
}
