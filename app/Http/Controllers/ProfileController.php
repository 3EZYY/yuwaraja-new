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

        // If photo was uploaded, redirect to crop page
        if ($request->hasFile('photo')) {
            return redirect()->route('profile.crop-photo')->with('status', 'photo-uploaded');
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Show crop photo page.
     */
    public function cropPhoto(Request $request): View
    {
        $user = $request->user();
        
        // Check if user has a photo
        if (!$user->photo) {
            if ($user->role === 'spv') {
                return redirect()->route('spv.profile.edit')->with('error', 'Tidak ada foto untuk di-crop.');
            } else {
                return redirect()->route('profile.edit')->with('error', 'Tidak ada foto untuk di-crop.');
            }
        }
        
        return view('profile.crop-photo', [
            'user' => $user,
            'photo' => $user->photo
        ]);
    }

    /**
     * Save cropped photo.
     */
    public function saveCroppedPhoto(Request $request): RedirectResponse
    {
        $request->validate([
            'cropped_image' => 'required|string',
            'original_photo' => 'required|string'
        ]);

        $user = $request->user();
        $croppedImageData = $request->input('cropped_image');
        $originalPhoto = $request->input('original_photo');

        // Decode base64 image
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $croppedImageData));
        
        if ($imageData === false) {
            return back()->withErrors(['cropped_image' => 'Data gambar tidak valid.']);
        }

        try {
            // Generate new filename
            $filename = 'profile_' . $user->id . '_cropped_' . time() . '.jpg';
            $uploadPath = public_path('profile-pictures');
            
            // Create directory if it doesn't exist
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Save the cropped image
            $fullPath = $uploadPath . '/' . $filename;
            file_put_contents($fullPath, $imageData);

            // Delete old photo if it exists and is different
            if ($user->photo && $user->photo !== $originalPhoto) {
                $oldPhotoPath = $uploadPath . '/' . $user->photo;
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            // Delete original photo if it's different from the new one
            if ($originalPhoto && $originalPhoto !== $filename) {
                $originalPhotoPath = $uploadPath . '/' . $originalPhoto;
                if (file_exists($originalPhotoPath)) {
                    unlink($originalPhotoPath);
                }
            }

            // Update user photo
            $user->photo = $filename;
            $user->save();

            // Redirect berdasarkan role
            if ($user->role === 'spv') {
                return redirect()->route('spv.profile.edit')->with('status', 'profile-photo-updated');
            } else {
                return redirect()->route('profile.edit')->with('status', 'profile-photo-updated');
            }

        } catch (\Exception $e) {
            \Log::error('Error saving cropped photo: ' . $e->getMessage());
            return back()->withErrors(['cropped_image' => 'Gagal menyimpan foto. Silakan coba lagi.']);
        }
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
