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
            \Log::info('Photo upload started for user: ' . $user->id);
            
            // Delete old photo if exists
            if ($user->photo) {
                $oldPhotoPath = public_path('profile-pictures/' . $user->photo);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                    \Log::info('Deleting old photo: ' . $user->photo);
                }
            }

            $photo = $request->file('photo');
            $filename = 'profile_' . $user->id . '_' . time() . '.' . $photo->getClientOriginalExtension();
            \Log::info('Generated filename: ' . $filename);

            // Debug file info
            \Log::info('File original name: ' . $photo->getClientOriginalName());
            \Log::info('File size: ' . $photo->getSize());
            \Log::info('File mime type: ' . $photo->getMimeType());
            \Log::info('File is valid: ' . ($photo->isValid() ? 'true' : 'false'));

            // Create directory if it doesn't exist
            $uploadPath = public_path('profile-pictures');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
                \Log::info('Created directory: ' . $uploadPath);
            }

            // Store the new photo using move() method
            try {
                $photo->move($uploadPath, $filename);
                \Log::info('Photo moved to: ' . $uploadPath . '/' . $filename);
                
                // Check if file actually exists
                $fullPath = $uploadPath . '/' . $filename;
                \Log::info('Full path: ' . $fullPath);
                \Log::info('File exists after move: ' . (file_exists($fullPath) ? 'true' : 'false'));
                
                if (file_exists($fullPath)) {
                    \Log::info('File size after move: ' . filesize($fullPath));
                }
            } catch (\Exception $e) {
                \Log::error('Error moving file: ' . $e->getMessage());
                throw $e;
            }

            // Update the photo field in the user data
            $data['photo'] = $filename;
            \Log::info('Photo upload completed successfully');
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
            Storage::delete('public/profile-pictures/' . $user->photo);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
