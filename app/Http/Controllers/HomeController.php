<?php

namespace App\Http\Controllers;

use App\Models\slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function HomeSlider()
    {
        $sliders = slider::latest()->get();
        return view ('admin.slider.index',compact('sliders'));
    }
}
