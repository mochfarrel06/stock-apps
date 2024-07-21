<?php

namespace App\Http\Controllers\Manajer\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manajer\Profile\ProfilePasswordUpdateRequest;
use App\Http\Requests\Manajer\Profile\ProfileUpdateRequest;
use App\Models\User;
use App\Traits\ProfileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManajerProfileController extends Controller
{
    use ProfileUploadTrait;

    public function index()
    {
        return view('manajer.profile.index');
    }

    public function editProfile()
    {
        return view('manajer.profile.editProfile');
    }

    public function updateProfile(ProfileUpdateRequest $request)
    {
        try {
            $userId = Auth::id();
            $user = User::findOrFail($userId);

            $imagePath = $this->uploadImage($request, 'avatar');

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
        return view('manajer.profile.editPassword');
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
