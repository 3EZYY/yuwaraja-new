<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\UploadedFile;

class FileTypeValidation implements ValidationRule
{
    protected array $allowedExtensions;
    protected array $allowedMimeTypes;

    public function __construct()
    {
        $this->allowedExtensions = ['pdf', 'doc', 'docx', 'txt', 'zip', 'rar'];
        $this->allowedMimeTypes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'text/plain',
            'application/zip',
            'application/x-zip-compressed',
            'application/x-rar-compressed',
            'application/vnd.rar',
            'application/octet-stream',
            'application/x-compressed',
            'multipart/x-zip'
        ];
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$value instanceof UploadedFile) {
            return;
        }

        $extension = strtolower($value->getClientOriginalExtension());
        $mimeType = $value->getMimeType();
        $originalName = $value->getClientOriginalName();

        // Check extension from filename if extension detection fails
        if (empty($extension) && $originalName) {
            $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        }

        // Validate by extension first (most reliable)
        if (!in_array($extension, $this->allowedExtensions)) {
            $fail('File harus berformat PDF, DOC, DOCX, TXT, ZIP, atau RAR.');
            return;
        }

        // Additional validation for specific file types
        if ($extension === 'pdf' && !str_contains($mimeType, 'pdf')) {
            // Allow PDF files even if MIME type detection fails
            if (!str_contains($originalName, '.pdf')) {
                $fail('File PDF tidak valid.');
                return;
            }
        }

        // For ZIP and RAR files, be more lenient with MIME types
        if (in_array($extension, ['zip', 'rar'])) {
            $archiveMimes = [
                'application/zip',
                'application/x-zip-compressed',
                'application/x-rar-compressed',
                'application/vnd.rar',
                'application/octet-stream',
                'application/x-compressed',
                'multipart/x-zip'
            ];
            
            if (!in_array($mimeType, $archiveMimes)) {
                // Still allow if extension is correct
                if (!in_array($extension, ['zip', 'rar'])) {
                    $fail('File arsip tidak valid.');
                    return;
                }
            }
        }
    }
}
