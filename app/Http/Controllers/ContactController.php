<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Tour;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show(Request $request)
    {
        $tour = null;

        // Check if a tour slug is provided
        if ($request->has('tour')) {
            $tour = Tour::where('slug', $request->tour)->first();
        }

        return view('contact', compact('tour'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:2|max:100',
            'email' => 'required|email',
            'phone' => 'nullable|max:20',
            'message' => 'required|min:10|max:2000',
        ]);

        Inquiry::create([
            'type' => 'contact',
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'message' => $validated['message'],
            'status' => 'new',
        ]);

        return back()->with('success', 'Thank you for your message. We will get back to you soon!');
    }
}
