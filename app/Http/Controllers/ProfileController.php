<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $data = $request->validated();

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo file if exists
            if ($user->photo) {
                Storage::delete('public/profile/' . $user->photo);
            }

            $photo = $request->file('photo');
            $filename = 'profile_' . $user->id . '_' . time() . '.' . $photo->getClientOriginalExtension();

            // Store the photo in the public/storage/profile directory
            $photo->storeAs('public/profile', $filename);

            // Update the photo field in the user data
            $data['photo'] = $filename;
        }

        // Check if NIM is being changed and verify it's unique
        if ($user->nim !== $data['nim']) {
            $existingUser = \App\Models\User::where('nim', $data['nim'])->where('id', '!=', $user->id)->first();
            if ($existingUser) {
                return back()->withErrors(['nim' => 'NIM sudah digunakan oleh mahasiswa lain.'])->withInput();
            }
        }

        // Fill user data with validated data
        $user->fill($data);

        // If email is changed, mark it as unverified
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Save changes
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Clean up user's profile photo if it exists
        if ($user->photo) {
            Storage::delete('public/profile/' . $user->photo);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
