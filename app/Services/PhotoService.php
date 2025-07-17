<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PhotoService
{
    private const UPLOAD_PATH = 'profile-pictures';
    private const MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
    private const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    /**
     * Upload and store user profile photo
     */
    public function uploadPhoto(User $user, UploadedFile $photo): string
    {
        $this->validatePhoto($photo);
        
        // Delete old photo
        $this->deleteUserPhoto($user);
        
        // Generate unique filename
        $filename = $this->generateFilename($user, $photo);
        
        // Store photo
        $this->storePhoto($photo, $filename);
        
        Log::info("Photo uploaded successfully for user {$user->id}: {$filename}");
        
        return $filename;
    }

    /**
     * Save cropped photo from base64 data
     */
    public function saveCroppedPhoto(User $user, string $base64Data, string $originalPhoto): string
    {
        $imageData = $this->decodeBase64Image($base64Data);
        
        // Generate filename for cropped image
        $filename = 'profile_' . $user->id . '_cropped_' . time() . '.jpg';
        
        // Save cropped image
        $this->saveImageData($imageData, $filename);
        
        // Clean up old photos
        $this->deletePhotoFile($user->photo);
        $this->deletePhotoFile($originalPhoto);
        
        Log::info("Cropped photo saved successfully for user {$user->id}: {$filename}");
        
        return $filename;
    }

    /**
     * Delete user's profile photo
     */
    public function deleteUserPhoto(User $user): void
    {
        if ($user->photo) {
            $this->deletePhotoFile($user->photo);
        }
    }

    /**
     * Validate uploaded photo
     */
    private function validatePhoto(UploadedFile $photo): void
    {
        if (!$photo->isValid()) {
            throw new \InvalidArgumentException('File upload tidak valid');
        }

        if ($photo->getSize() > self::MAX_FILE_SIZE) {
            throw new \InvalidArgumentException('Ukuran file terlalu besar (maksimal 10MB)');
        }

        $extension = strtolower($photo->getClientOriginalExtension());
        if (!in_array($extension, self::ALLOWED_EXTENSIONS)) {
            throw new \InvalidArgumentException('Format file tidak didukung');
        }
    }

    /**
     * Generate unique filename
     */
    private function generateFilename(User $user, UploadedFile $photo): string
    {
        return 'profile_' . $user->id . '_' . time() . '.' . $photo->getClientOriginalExtension();
    }

    /**
     * Store photo to disk
     */
    private function storePhoto(UploadedFile $photo, string $filename): void
    {
        $uploadPath = public_path(self::UPLOAD_PATH);
        
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $photo->move($uploadPath, $filename);
        
        if (!file_exists($uploadPath . '/' . $filename)) {
            throw new \RuntimeException('Gagal menyimpan file');
        }
    }

    /**
     * Decode base64 image data
     */
    private function decodeBase64Image(string $base64Data): string
    {
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Data));
        
        if ($imageData === false) {
            throw new \InvalidArgumentException('Data gambar tidak valid');
        }
        
        return $imageData;
    }

    /**
     * Save image data to file
     */
    private function saveImageData(string $imageData, string $filename): void
    {
        $uploadPath = public_path(self::UPLOAD_PATH);
        
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $fullPath = $uploadPath . '/' . $filename;
        
        if (file_put_contents($fullPath, $imageData) === false) {
            throw new \RuntimeException('Gagal menyimpan gambar');
        }
    }

    /**
     * Delete photo file from disk
     */
    private function deletePhotoFile(?string $filename): void
    {
        if (!$filename) {
            return;
        }

        $filePath = public_path(self::UPLOAD_PATH . '/' . $filename);
        
        if (file_exists($filePath)) {
            unlink($filePath);
            Log::info("Deleted photo file: {$filename}");
        }
    }

    /**
     * Get photo URL
     */
    public function getPhotoUrl(?string $filename): ?string
    {
        if (!$filename) {
            return null;
        }

        return asset(self::UPLOAD_PATH . '/' . $filename);
    }

    /**
     * Check if photo exists
     */
    public function photoExists(?string $filename): bool
    {
        if (!$filename) {
            return false;
        }

        return file_exists(public_path(self::UPLOAD_PATH . '/' . $filename));
    }
}