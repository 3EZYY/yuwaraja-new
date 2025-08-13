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

        // Save changes - handle database connection issues gracefully
        try {
            $user->save();
            \Log::info('User profile updated successfully for user: ' . $user->id);
            
            // If photo was uploaded, redirect to crop page
            if ($request->hasFile('photo')) {
                return redirect()->route('profile.crop-photo')->with('status', 'photo-uploaded');
            }

            return Redirect::route('profile.edit')->with('status', 'profile-updated');
        } catch (\Exception $dbException) {
            \Log::error('Database error while saving user profile: ' . $dbException->getMessage());
            
            // If photo was uploaded, still redirect to crop page even if database save failed
            if ($request->hasFile('photo')) {
                return redirect()->route('profile.crop-photo')->with('status', 'photo-uploaded')->with('warning', 'Foto berhasil diupload, namun ada masalah dengan database. Silakan hubungi administrator.');
            }
            
            return Redirect::route('profile.edit')->with('error', 'Terjadi masalah dengan database. Silakan coba lagi atau hubungi administrator.');
        }
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

            // Try to update user photo in database
            try {
                $user->photo = $filename;
                $user->save();
                \Log::info('Cropped photo filename saved to database for user: ' . $user->id);
                
                // Redirect ke halaman profile
                return redirect('/profile')->with('status', 'profile-photo-updated');
            } catch (\Exception $dbException) {
                \Log::warning('Could not save cropped photo filename to database (database unavailable), but photo file saved successfully: ' . $dbException->getMessage());
                
                // Redirect with warning that photo was saved but database update failed
                return redirect('/profile')->with('status', 'profile-photo-updated')->with('warning', 'Foto berhasil disimpan, namun ada masalah dengan database. Silakan hubungi administrator.');
            }

        } catch (\Exception $e) {
            \Log::error('Error saving cropped photo: ' . $e->getMessage());
            return back()->withErrors(['cropped_image' => 'Gagal menyimpan foto. Silakan coba lagi.']);
        }
    }

    /**
     * Upload profile photo via AJAX.
     */
    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
        ]);

        try {
            $user = $request->user();
            
            // Delete old photo if exists
            if ($user->photo) {
                $oldPhotoPath = public_path('profile-pictures/' . $user->photo);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            $photo = $request->file('photo');
            $filename = 'profile_' . $user->id . '_' . time() . '.' . $photo->getClientOriginalExtension();

            // Create directory if it doesn't exist
            $uploadPath = public_path('profile-pictures');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Store the new photo
            $photo->move($uploadPath, $filename);

            // Try to update user photo in database, but don't fail if database is unavailable
            try {
                $user->photo = $filename;
                $user->save();
                \Log::info('Photo filename saved to database for user: ' . $user->id);
            } catch (\Exception $dbException) {
                \Log::warning('Could not save photo filename to database (database unavailable), but photo file uploaded successfully: ' . $dbException->getMessage());
                // Continue execution - photo is uploaded even if database update fails
            }

            return response()->json([
                'success' => true,
                'message' => 'Foto profile berhasil diupload!',
                'photo_url' => asset('profile-pictures/' . $filename)
            ]);

        } catch (\Exception $e) {
            \Log::error('Error uploading profile photo: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupload foto profile. Silakan coba lagi.'
            ], 500);
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
