<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MailController extends Controller
{
    // Normal index (for Blade view)
    public function index()
    {
        $mails = Mail::latest()->get();

        return view('admin.mails', compact('mails'));
    }

    // Store API (with file upload support)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'address'     => 'required|string|max:255',
            'description' => 'required|string',
            'media'       => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,mp4|max:20480', // 20MB
            'story'       => 'nullable|string',
        ]);

        // handle file upload
        if ($request->hasFile('media')) {
            $path = $request->file('media')->store('mails', 'public'); 
            $validated['media'] = $path;
        }

        dd($request->all());

        $mail = Mail::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Mail created successfully',
            'data'    => $mail,
        ], 201);
    }
}
