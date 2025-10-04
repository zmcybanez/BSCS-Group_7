<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Create the contact record
            Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'status' => 'new'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Thank you for your message! We\'ll get back to you soon.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'There was an error sending your message. Please try again.'
            ], 500);
        }
    }

    public function index()
    {
        // This could be used for an admin panel to view contact submissions
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.contacts.index', compact('contacts'));
    }
}
