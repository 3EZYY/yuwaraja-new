# Photo Management System

## Overview
Sistem manajemen foto profile yang lengkap dengan fitur upload, crop, dan validasi untuk aplikasi Laravel.

## Features
- ✅ Upload foto profile dengan validasi
- ✅ Crop foto dengan multiple aspect ratio
- ✅ Preview real-time
- ✅ Auto cleanup foto lama
- ✅ Responsive design
- ✅ Keyboard shortcuts
- ✅ Error handling yang robust

## Architecture

### Service Layer
```php
App\Services\PhotoService
```
Menangani semua business logic terkait foto:
- Upload dan validasi
- Crop dan resize
- File management
- Cleanup

### Request Validation
```php
App\Http\Requests\CropPhotoRequest
```
Validasi khusus untuk crop foto dengan:
- Base64 image validation
- File size limits
- Original photo existence check

### Configuration
```php
config/photo.php
```
Centralized configuration untuk:
- Upload settings
- Crop options
- Storage configuration
- Validation rules

## Usage

### Basic Upload
```php
$photoService = new PhotoService();
$filename = $photoService->uploadPhoto($user, $uploadedFile);
$user->photo = $filename;
$user->save();
```

### Crop Photo
```php
$filename = $photoService->saveCroppedPhoto($user, $base64Data, $originalPhoto);
$user->photo = $filename;
$user->save();
```

### Frontend Integration
```html
<!-- Include the component -->
<script src="{{ asset('js/photo-cropper.js') }}"></script>

<!-- Initialize with custom options -->
<script>
const cropper = new PhotoCropper({
    defaultAspectRatio: 1,
    outputOptions: {
        width: 400,
        height: 400
    }
});
</script>
```

## Configuration Options

### Upload Settings
```php
'upload' => [
    'path' => 'profile-pictures',
    'max_size' => 10 * 1024 * 1024, // 10MB
    'allowed_extensions' => ['jpg', 'jpeg', 'png', 'gif', 'webp'],
]
```

### Crop Settings
```php
'crop' => [
    'output_format' => 'jpg',
    'output_quality' => 0.9,
    'default_size' => ['width' => 300, 'height' => 300],
]
```

## Security Considerations

### File Validation
- ✅ File type validation (extension + MIME type)
- ✅ File size limits
- ✅ Image content validation
- ✅ Path traversal protection

### Storage Security
- ✅ Files stored outside web root when possible
- ✅ Unique filename generation
- ✅ Old file cleanup
- ✅ Permission management

## Testing

### Run Tests
```bash
php artisan test --filter PhotoServiceTest
```

### Test Coverage
- ✅ Upload validation
- ✅ File type restrictions
- ✅ Size limits
- ✅ Crop functionality
- ✅ Error handling

## Performance Optimization

### Image Processing
- Optimized canvas rendering
- Progressive JPEG output
- Efficient memory usage
- Lazy loading for previews

### File Management
- Automatic cleanup of old files
- Efficient storage structure
- CDN-ready asset URLs

## Keyboard Shortcuts

| Shortcut | Action |
|----------|--------|
| `Ctrl/Cmd + Enter` | Save cropped photo |
| `Escape` | Cancel and go back |
| `Ctrl/Cmd + 1` | Set 1:1 aspect ratio |

## Browser Support
- ✅ Chrome 60+
- ✅ Firefox 55+
- ✅ Safari 12+
- ✅ Edge 79+

## Troubleshooting

### Common Issues

#### "Undefined variable $user"
Pastikan controller mengirim variabel user ke view:
```php
return view('profile.crop-photo', ['user' => $user]);
```

#### "File not found"
Periksa permission direktori dan path:
```bash
chmod 755 public/profile-pictures
```

#### "Memory limit exceeded"
Tingkatkan memory limit untuk file besar:
```php
ini_set('memory_limit', '256M');
```

## Future Enhancements

### Planned Features
- [ ] Multiple photo upload
- [ ] Batch processing
- [ ] Image filters
- [ ] Cloud storage integration
- [ ] Progressive web app support
- [ ] Advanced crop tools (rotate, flip)

### Performance Improvements
- [ ] WebP format support
- [ ] Image compression optimization
- [ ] Lazy loading implementation
- [ ] CDN integration

## Contributing
1. Fork the repository
2. Create feature branch
3. Add tests for new functionality
4. Ensure all tests pass
5. Submit pull request

## License
MIT License - see LICENSE file for details