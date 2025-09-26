<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class PhotoboothController extends Controller
{
    /**
     * Display the photobooth interface.
     */
    public function index(): View
    {
        return view('photobooth');
    }

    /**
     * Capture and save a photo from the photobooth.
     */
    public function capture(Request $request): JsonResponse
    {
        $request->validate([
            'image' => 'required|string',
        ]);

        try {
            // Get the base64 image data
            $imageData = $request->input('image');
            
            // Remove the data URL prefix (data:image/png;base64,)
            $imageData = preg_replace('/^data:image\/(png|jpeg);base64,/', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            
            // Generate unique filename
            $filename = 'photobooth_' . time() . '_' . uniqid() . '.png';
            $filepath = public_path('photos/' . $filename);
            
            // Create photos directory if it doesn't exist
            if (!file_exists(public_path('photos'))) {
                mkdir(public_path('photos'), 0755, true);
            }
            
            // Save the image
            file_put_contents($filepath, base64_decode($imageData));
            
            return response()->json([
                'success' => true,
                'message' => 'Photo captured successfully!',
                'filename' => $filename,
                'url' => asset('photos/' . $filename)
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to capture photo: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get list of captured photos.
     */
    public function gallery(): JsonResponse
    {
        try {
            $photosDir = public_path('photos');
            $photos = [];
            
            if (file_exists($photosDir)) {
                $files = glob($photosDir . '/photobooth_*.png');
                foreach ($files as $file) {
                    $filename = basename($file);
                    $photos[] = [
                        'filename' => $filename,
                        'url' => asset('photos/' . $filename),
                        'created_at' => date('Y-m-d H:i:s', filemtime($file))
                    ];
                }
                
                // Sort by creation time (newest first)
                usort($photos, function($a, $b) {
                    return strtotime($b['created_at']) - strtotime($a['created_at']);
                });
            }
            
            return response()->json([
                'success' => true,
                'photos' => $photos
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load gallery: ' . $e->getMessage()
            ], 500);
        }
    }
}