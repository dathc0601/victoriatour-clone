<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;
use App\Models\AboutStrength;

class AboutController extends Controller
{
    public function show()
    {
        $about = AboutPage::getContent();
        $strengths = AboutStrength::active()->ordered()->get();

        return view('pages.about', compact('about', 'strengths'));
    }
}
