<?php

namespace App\Http\Controllers;

use App\Models\slider;
use App\Models\Slider as ModelsSlider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    public function HomeSlider()
    {
        $sliders = slider::latest()->get();
        return view ('admin.slider.index',compact('sliders'));
    }
    public function Addslider()
    {
        return view('admin.slider.create');
    }
    public function StoreSlider(Request $request)
    {
        $slider_image = $request->file('image');

        $name_gen = hexdec(uniqid()) . '.' . $slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920, 1080)->save('image/slider/' . $name_gen);

        $last_img = 'image/slider/' . $name_gen;




        slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);
        
        return Redirect()->route('home.slider')->with('success', 'Slider inserted successfully');

    }
}

