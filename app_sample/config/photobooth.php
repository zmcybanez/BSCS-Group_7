<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Photobooth Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains configuration options for the Photobooth feature
    | of the Farm Guide application. You can modify these settings to
    | customize the behavior of the photobooth.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Storage Settings
    |--------------------------------------------------------------------------
    |
    | Configure where photos are stored and how they are managed.
    |
    */
    'storage' => [
        'path' => 'photos',
        'disk' => 'public',
        'max_file_size' => 5 * 1024 * 1024, // 5MB
        'allowed_formats' => ['png', 'jpg', 'jpeg'],
        'cleanup_older_than_days' => 30, // Auto-delete photos older than 30 days
    ],

    /*
    |--------------------------------------------------------------------------
    | Image Settings
    |--------------------------------------------------------------------------
    |
    | Configure image quality and processing options.
    |
    */
    'image' => [
        'default_quality' => 0.9,
        'max_width' => 1920,
        'max_height' => 1080,
        'thumbnail_size' => 150,
        'watermark' => [
            'enabled' => false,
            'text' => 'Farm Guide',
            'position' => 'bottom-right',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Camera Settings
    |--------------------------------------------------------------------------
    |
    | Default camera configuration options.
    |
    */
    'camera' => [
        'default_width' => 640,
        'default_height' => 480,
        'facing_mode' => 'user', // 'user' for front camera, 'environment' for back
        'auto_start' => false,
        'show_controls' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Gallery Settings
    |--------------------------------------------------------------------------
    |
    | Configure how the photo gallery is displayed.
    |
    */
    'gallery' => [
        'per_page' => 20,
        'sort_order' => 'desc', // 'asc' or 'desc'
        'show_metadata' => true,
        'enable_download' => true,
        'enable_delete' => false, // Set to true to allow photo deletion
    ],

    /*
    |--------------------------------------------------------------------------
    | Security Settings
    |--------------------------------------------------------------------------
    |
    | Security-related configuration options.
    |
    */
    'security' => [
        'require_auth' => false, // Set to true to require user login
        'rate_limit' => [
            'enabled' => true,
            'max_captures_per_minute' => 10,
        ],
        'allowed_origins' => ['*'], // CORS settings
    ],

    /*
    |--------------------------------------------------------------------------
    | Feature Flags
    |--------------------------------------------------------------------------
    |
    | Enable or disable specific features.
    |
    */
    'features' => [
        'filters' => true,
        'timestamp_overlay' => true,
        'social_sharing' => false,
        'batch_capture' => false,
        'video_recording' => false, // Future feature
        'qr_code_integration' => false, // Future feature
    ],

    /*
    |--------------------------------------------------------------------------
    | UI Customization
    |--------------------------------------------------------------------------
    |
    | Customize the user interface appearance.
    |
    */
    'ui' => [
        'theme' => 'farm-green', // 'farm-green', 'dark', 'light'
        'show_logo' => true,
        'custom_css' => null, // Path to custom CSS file
        'language' => 'en', // Default language
    ],

    /*
    |--------------------------------------------------------------------------
    | Notifications
    |--------------------------------------------------------------------------
    |
    | Configure notification settings.
    |
    */
    'notifications' => [
        'success_messages' => true,
        'error_messages' => true,
        'sound_effects' => false,
        'auto_hide_after' => 4000, // Milliseconds
    ],
];