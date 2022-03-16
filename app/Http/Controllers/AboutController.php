<?php

namespace App\Http\Controllers;

use App\Models\HomeAbout;
use App\Models\Multipic;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function HomeAbout()
    {
        $homeabout = HomeAbout::latest()->get();
        return view('admin.home.index', compact('homeabout'));
    }
    public function AddAbout()
    {
        return view('admin.home.create');
    }
    public function StoreAbout(Request $request)
    {
        HomeAbout::insert([
            'title' => $request->title,
            'short_dis' => $request->short_dis,
            'log_dis' => $request->log_dis,
            'created_at' => Carbon::now()
        ]);
        return redirect()->route('home.about')->with('success', 'About inserted successfully');
    }
    public function EditAbout($id)
    {
        $homeabout = HomeAbout::find($id);
        return view('admin.home.edit', compact('homeabout'));
    }
    public function UpdateAbout(Request $request, $id)
    {
        $update = HomeAbout::find($id)->update([
            'title' => $request->title,
            'short_dis' => $request->short_dis,
            'log_dis' => $request->log_dis,
        ]);
        return redirect()->route('home.about')->with('success', 'About updated successfully');
    }
    public function DeleteAbout($id)
    {
        $delete = HomeAbout::find($id)->delete();
        return redirect()->back()->with('success', 'About deleted successfully');
    }

    function Portifolio()
    {
        $images = Multipic::all();
        return view('pages.portifolio',compact('images'));
    }
}
