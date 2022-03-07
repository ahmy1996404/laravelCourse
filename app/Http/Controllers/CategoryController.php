<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],
    [
        'category_name.required'=>'Please insert category name',
        'category_name.max'=>'Category must be less than 255 chars'

    ]);
    }
}
