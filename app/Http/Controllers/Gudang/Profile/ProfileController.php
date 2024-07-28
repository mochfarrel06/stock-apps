<?php

namespace App\Http\Controllers\Gudang\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gudang\Profile\ProfilePasswordUpdateRequest;
use App\Http\Requests\Gudang\Profile\ProfileUpdateRequest;
use App\Traits\ProfileUploadTrait;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    use ProfileUploadTrait;

    public function index()
    {
        return view('gudang.profile.index');
    }

    public function editProfile()
    {
        return view('gudang.profile.editProfile');
    }

    public function updateProfile(ProfileUpdateRequest $request)
    {
        try {
            $userId = Auth::id();
            $user = User::findOrFail($userId);

            $imagePath = $this->uploadImage($request, 'avatar');

            if ($imagePath) {
                // Hapus gambar lama jika ada gambar baru yang diunggah
                if ($user->avatar && file_exists(public_path($user->avatar))) {
                    unlink(public_path($user->avatar));
                }
                $user->avatar = $imagePath;
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->avatar = isset($imagePath) ? $imagePath : $user->avatar;
            $user->username = $request->username;

            // Cek apakah ada perubahan data
            if ($user->isDirty()) {
                $user->save();
                session()->flash('success', 'Berhasil memperbarui data profil');
                return response()->json(['success' => true], 200);
            } else {
                session()->flash('info', 'Tidak melakukan perubahan data profil');
                return response()->json(['info' => true], 200);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Terdapat kesalahan data profil: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    function editPassword()
    {
        return view('gudang.profile.editPassword');
    }

    function updatePassword(ProfilePasswordUpdateRequest $request)
    {
        try {
            $userId = Auth::id();
            $user = User::findOrFail($userId);

            $user->password = bcrypt($request->password);

            if ($user->isDirty()) {
                $user->save();
                session()->flash('success', 'Berhasil memperbarui password');
                return response()->json(['success' => true], 200);
            } else {
                session()->flash('info', 'Tidak melakukan perubahan password');
                return response()->json(['info' => true], 200);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Terdapat kesalahan password: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
