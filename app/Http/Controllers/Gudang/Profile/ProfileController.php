<?php

namespace App\Http\Controllers\Gudang\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gudang\Profile\ProfilePasswordUpdateRequest;
use App\Http\Requests\Gudang\Profile\ProfileUpdateRequest;
use App\Traits\ProfileUploadTrait;
use Illuminate\Http\Request;
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

    function updateProfile(ProfileUpdateRequest $request)
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);

        $imagePath = $this->uploadImage($request, 'avatar');

        $user->name = $request->name;
        $user->email = $request->email;
        $user->avatar = isset($imagePath) ? $imagePath : $user->avatar;
        $user->username = $request->username;
        $user->save();

        return redirect()->route('gudang.profile.index');
    }

    function editPassword()
    {
        return view('gudang.profile.editPassword');
    }

    function updatePassword(ProfilePasswordUpdateRequest $request)
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);

        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('gudang.profile.index');
    }
}
