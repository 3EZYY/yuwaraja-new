<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Profile Photo Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for profile photo upload and management
    |
    */

    'upload' => [
        'path' => 'profile-pictures',
        'max_size' => 10 * 1024 * 1024, // 10MB
        'allowed_extensions' => ['jpg', 'jpeg', 'png', 'gif', 'webp'],
        'allowed_mime_types' => [
            'image/jpeg',
            'image/png', 
            'image/gif',
            'image/webp'
        ],
    ],

    'crop' => [
        'output_format' => 'jpg',
        'output_quality' => 0.9,
        'max_output_size' => 5 * 1024 * 1024, // 5MB
        'default_size' => [
            'width' => 300,
            'height' => 300
        ],
        'preview_sizes' => [
            'small' => ['width' => 64, 'height' => 64],
            'medium' => ['width' => 128, 'height' => 128],
            'large' => ['width' => 256, 'height' => 256],
        ],
        'aspect_ratios' => [
            'square' => 1,
            'landscape_4_3' => 4/3,
            'portrait_3_4' => 3/4,
            'widescreen_16_9' => 16/9,
            'free' => null
        ]
    ],

    'storage' => [
        'disk' => 'public',
        'cleanup_old_photos' => true,
        'backup_original' => false,
    ],

    'validation' => [
        'required_for_profile' => false,
        'auto_crop_after_upload' => true,
        'allow_multiple_formats' => true,
    ]
];