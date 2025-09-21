<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    // Show the profile edit form
    public function edit()
    {
        $user = Auth::user();

        // Calculate user statistics
        $questionsAsked = Post::where('userID', Auth::id())
            ->where('status', 'active')
            ->count();

        $answersGiven = Comment::where('userID', Auth::id())
            ->where('status', 'active')
            ->count();

        return view('profile.edit', compact('user', 'questionsAsked', 'answersGiven'));
    }

    // Update profile info
    public function update(Request $request)
    {
        $isAjaxUpload = $request->ajax() || $request->wantsJson() || $request->has('ajax_upload');

        Log::info('Profile update called', [
            'is_ajax' => $request->ajax(),
            'wants_json' => $request->wantsJson(),
            'has_ajax_upload' => $request->has('ajax_upload'),
            'is_ajax_upload' => $isAjaxUpload,
            'has_file' => $request->hasFile('profile_picture'),
            'content_type' => $request->header('Content-Type'),
            'method' => $request->method()
        ]);

        try {
            $user = Auth::user();

            // If it's just a profile picture upload, handle it separately with minimal validation
            if ($isAjaxUpload && $request->hasFile('profile_picture') && !$request->filled('name')) {
                $request->validate([
                    'profile_picture' => ['required', 'image', 'max:5120'], // max 5MB
                ]);

                $file = $request->file('profile_picture');
                $path = $file->store('profile_pictures', 'public');

                // Optionally delete old profile picture if exists
                if ($user->profile_picture) {
                    Storage::disk('public')->delete($user->profile_picture);
                }

                $user->profile_picture = $path;
                $user->save();

                Log::info('Profile picture uploaded successfully', ['path' => $path, 'user' => $user->UserID]);

                return response()->json([
                    'success' => true,
                    'message' => 'Profile picture updated successfully!',
                    'profile_picture' => asset('storage/' . $path)
                ]);
            }

            // Handle full profile update
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->UserID . ',UserID'],
                'location' => ['nullable', 'string', 'max:255'],
                'farm_type' => ['nullable', 'string', 'max:255'],
                'bio' => ['nullable', 'string'],
                'profile_picture' => ['nullable', 'image', 'max:5120'], // max 5MB
            ]);

            if ($validator->fails()) {
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Validation failed',
                        'errors' => $validator->errors()
                    ], 422);
                }
                return back()->withErrors($validator)->withInput();
            }

            $user->name = $request->name ?? $user->name;
            $user->email = $request->email ?? $user->email;
            $user->location = $request->location;
            $user->farm_type = $request->farm_type;
            $user->bio = $request->bio;

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $path = $file->store('profile_pictures', 'public');

            // Optionally delete old profile picture if exists
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $user->profile_picture = $path;
            Log::info('Profile picture uploaded: ' . $path . ' for user: ' . $user->UserID);
        }

        $user->save();
        Log::info('User saved with profile_picture: ' . ($user->profile_picture ?? 'NULL'));

        // Refresh the user model to ensure latest data is loaded
        $user->refresh();

        // Check if it's an AJAX request (for profile picture upload)
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully!',
                'profile_picture' => $user->profile_picture ? asset('storage/' . $user->profile_picture) : null
            ]);
        }

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');

        } catch (\Exception $e) {
            Log::error('Profile update error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error updating profile: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Error updating profile. Please try again.');
        }
    }

    // Update password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'confirmed', Password::defaults()],
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
        }

        Auth::user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Password updated successfully!');
    }

    // Set password for Google users (who don't have one)
    public function setPassword(Request $request)
    {
        $user = Auth::user();

        // Only allow if user doesn't have a password (Google users)
        if ($user->has_password) {
            return back()->with('error', 'You already have a password. Use the update password form instead.');
        }

        $request->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user->update([
            'password' => Hash::make($request->password),
            'has_password' => true,
        ]);

        return back()->with('success', 'Password set successfully! You can now login manually with your email and password.');
    }

    // Delete account
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
