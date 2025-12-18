<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;
use App\Models\AboutStrength;

class AboutController extends Controller
{
    public function show()
    {
        try {
            $about = AboutPage::getContent();
        } catch (\Exception $e) {
            $about = new AboutPage();
        }

        $strengths = AboutStrength::active()->ordered()->get();

        return view('pages.about', compact('about', 'strengths'));
    }
}
