<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

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
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city_name' => 'nullable|string|max:100',
            'province_name' => 'nullable|string|max:100',
            'district_name' => 'nullable|string|max:100',
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
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
            'city' => $data['city_name'] ?? null,
            'province' => $data['province_name'] ?? null,
            'district' => $data['district_name'] ?? null,
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

    /**
     * Get all provinces from Indonesia regions API
     */
    public function getProvinces()
    {
        try {
            $provinces = Cache::remember('provinces', 60 * 60 * 24, function () {
                $response = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
                return $response->json();
            });

            return response()->json($provinces);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch provinces'], 500);
        }
    }

    /**
     * Get regencies by province ID
     */
    public function getRegencies($provinceId)
    {
        try {
            $regencies = Cache::remember("regencies_{$provinceId}", 60 * 60 * 24, function () use ($provinceId) {
                $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/regencies/{$provinceId}.json");
                return $response->json();
            });

            return response()->json($regencies);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch regencies'], 500);
        }
    }

    /**
     * Get districts by regency ID
     */
    public function getDistricts($regencyId)
    {
        try {
            $districts = Cache::remember("districts_{$regencyId}", 60 * 60 * 24, function () use ($regencyId) {
                $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/districts/{$regencyId}.json");
                return $response->json();
            });

            return response()->json($districts);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch districts'], 500);
        }
    }
}
