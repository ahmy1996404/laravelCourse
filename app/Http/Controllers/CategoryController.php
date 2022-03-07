<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{

    /**
     * AllCat
     *
     * @return View
     */
    public function AllCat()
    {
        return view('admin.category.index');
    }
    /**
     * AddCat
     *
     * @return void
     */
    public function AddCat(Request $request)
    {
        $validated = $request->validate(
            [
            'category_name' => 'required|unique:categories|max:255',
            ],
        [
            'category_name.required'=>'Please insert category name',
            'category_name.max'=>'Category must be less than 255 chars'
            ]
        );
        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        // $category = new Category();
        // $category->category_name = $request->category_name;
        // $category->user_id = Auth::user()->id;
        // $category->save();

        return Redirect()->back()->with('success','Category Inserted Successfull');

    }
}
