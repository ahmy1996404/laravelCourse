<?php

namespace App\Http\Controllers;

use App\Models\HomeAbout;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function HomeAbout()
    {
        $homeabout = HomeAbout::latest()->get();
        return view('admin.home.index',compact('homeabout'));
    }
    public function AddAbout()
    {
        return view('admin.home.create');
    }
    public function StoreAbout(Request $request)
    {
        HomeAbout::insert([
            'title' =>$request -> title,
            'short_dis' =>$request -> title,
            'log_dis' =>$request -> log_dis,
            'created_at'=> Carbon::now()
        ]);
        return redirect()->route('home.about')->with('success','About inserted successfully');
    }
}
