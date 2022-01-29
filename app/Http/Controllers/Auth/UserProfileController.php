<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserProfileRequest;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('auth.change-password');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = $request->user();
        $user->password = Hash::make($request->password);

        if ($user->save()) {
            return back()->with('success', 'Your password has been changed successfully!');
        } else {
            return back()->with('error', 'Can not change the password!');
        }
    }

    public function edit()
    {
        return view('auth.profile');
    }

    public function update(UserProfileRequest $request)
    {
        if ($request->user()->update($request->validated())) {
            return back()->with('success', 'Your profile has been updated successfully!');
        } else {
            return back()->with('error', 'Can not update your profile!');
        }
    }
}
