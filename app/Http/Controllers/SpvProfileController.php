<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SpvProfileController extends Controller
{
    /**
     * Display the SPV's profile form.
     */
    public function edit(Request $request): View
    {
        return view('spv.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the SPV's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $data = $request->validated();

        // Handle photo upload
        if ($request->hasFile('photo')) {
            \Log::info('Photo upload started for SPV user: ' . $user->id);

            // Delete old photo if exists
            if ($user->photo) {
                $oldPhotoPath = public_path('profile-pictures/' . $user->photo);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                    \Log::info('Deleting old photo: ' . $user->photo);
                }
            }

            $photo = $request->file('photo');
            $filename = 'spv_profile_' . $user->id . '_' . time() . '.' . $photo->getClientOriginalExtension();
            \Log::info('Generated filename: ' . $filename);

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
            \Log::info('Photo upload completed successfully for SPV');
        }

        // Fill user data with validated data
        $user->fill($data);

        // If email is changed, mark it as unverified
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Save changes
        $user->save();

        // If photo was uploaded, redirect to crop page
        if ($request->hasFile('photo')) {
            return redirect()->route('profile.crop-photo')->with('status', 'photo-uploaded');
        }

        return Redirect::route('spv.profile.edit')->with('status', 'profile-updated');
    }
}