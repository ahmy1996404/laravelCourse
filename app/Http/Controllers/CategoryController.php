<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        //ORM

        $categories = Category::latest()->paginate(5);

        // Quary Builder

        // $categories = DB::table('categories')->latest()->paginate(5);

        // Quary Builder with relation JOIN

        // $categories = DB::table('categories')
        // ->join('users', 'categories.user_id','users.id')
        // ->select('categories.*','users.name')
        // ->latest()->paginate(5);

        return view('admin.category.index', compact('categories'));
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

        // ORM

        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        // Quary builder

        // $category = new Category();
        // $category->category_name = $request->category_name;
        // $category->user_id = Auth::user()->id;
        // $category->save();

        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // DB::table('categories')->insert($data);

        return Redirect()->back()->with('success','Category Inserted Successfull');

    }

    public function Edit($id)
    {
        // ORM
        // $categories = Category::find($id);

        // Quary builder

        $categories = DB::table('categories')->where('id',$id)->first();
        return view('admin.category.edit',compact('categories'));
    }

    public function Update(Request $request , $id)
    {
        // ORM

        // $categories = Category::find($id)->update([
        //     'category_name'=> $request->category_name,
        //     'user_id' => Auth::user()->id
        // ]);

        // Quary builder

        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id',$id)->update($data);

        return Redirect()->route('all.category')->with('success','Category updated successfull');
    }
}
