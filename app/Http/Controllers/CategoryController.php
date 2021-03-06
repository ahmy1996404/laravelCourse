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
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * AllCat
     *
     * @return View
     */
    public function AllCat()
    {
        //ORM

        $categories = Category::latest()->paginate(5);
        $trashCat = Category::onlyTrashed()->latest()->paginate(3);
        // Quary Builder

        // $categories = DB::table('categories')->latest()->paginate(5);

        // Quary Builder with relation JOIN

        // $categories = DB::table('categories')
        // ->join('users', 'categories.user_id','users.id')
        // ->select('categories.*','users.name')
        // ->latest()->paginate(5);

        return view('admin.category.index', compact('categories' , 'trashCat'));
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
    public function SoftDelete($id)
    {
        $categories = Category::find($id)->delete();
        return Redirect()->back()->with('success','Category soft deleted successfull');

    }
    public function Restore($id)
    {
        $categories = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success','Category restored successfull');


    }
    public function Pdelete($id)
    {
        $categories = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success','Category Permenently deleted successfull');


    }
}
