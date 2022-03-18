<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Multipic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
class BrandController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function AllBrand()
    {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }
    public function StoreBrand(Request $request)
    {
        $validated = $request->validate(
            [
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image'=>'required|mimes:png,jpg'
            ],
        [
            'brand_name.required'=>'Please insert brand name',
            'brand_name.min'=>'Brand must be longer than 4 chars'
            ]
        );
        $brand_image = $request->file('brand_image');
        // $name_gen = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name = $name_gen . '.' . $img_ext;
        // $up_location = 'image/brand/';
        // $last_img = $up_location.$img_name;
        // $brand_image->move($up_location , $img_name);

        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);

        $last_img = 'image/brand/'.$name_gen;




        Brand::insert([
            'brand_name'=> $request->brand_name,
            'brand_image'=>$last_img,
            'created_at'=>Carbon::now()
        ]);

        $notification = array(
            "message"=> "Brand inserted successfully",
            "alert-type"=>'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function Edit($id)
    {
        $brands = Brand::find($id);
        return view('admin.brand.edit',compact('brands'));
    }
    public function Update(Request $request , $id)
    {
        $validated = $request->validate(
            [
            'brand_name' => 'required|min:4',
            ],
        [
            'brand_name.required'=>'Please insert brand name',
            'brand_name.min'=>'Brand must be longer than 4 chars'
            ]
        );
        $old_image = $request->old_image;
        $brand_image = $request->file('brand_image');
        if($brand_image){
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $up_location = 'image/brand/';
            $last_img = $up_location.$img_name;
            $brand_image->move($up_location , $img_name);
            unlink($old_image);
            Brand::find($id)->update([
                'brand_name'=> $request->brand_name,
                'brand_image'=>$last_img,
                'created_at'=>Carbon::now()
            ]);
            return Redirect()->back()->with('success','Brand updated successfully');
        }
        else{
            Brand::find($id)->update([
                'brand_name'=> $request->brand_name,
                'created_at'=>Carbon::now()
            ]);
            return Redirect()->back()->with('success','Brand updated successfully');
        }

    }
    /**
     * Delete the record with image
     *
     * @param  int $id Record id to delete
     * @return \Illuminate\Http\RedirectResponse
     */
    public function Delete($id)
    {
        $brand = Brand::find($id);
        $old_image = $brand->brand_image;
        unlink($old_image);
        $brand->delete();
         return Redirect()->back()->with('success','Brand deleted successfully');

    }

    public function Multipic()
    {
        $images = Multipic::all();
        return view('admin.multipic.index',compact('images'));
    }
    public function StoreImage(Request $request)
    {

        $image = $request->file('image');
        foreach($image as $multi_img){

        $name_gen = hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();
        Image::make($multi_img)->resize(300,200)->save('image/multi/'.$name_gen);

        $last_img = 'image/multi/'.$name_gen;

        Multipic::insert([
            'image'=> $last_img ,
            'created_at'=>Carbon::now()
        ]);
        }
        return Redirect()->back()->with('success','image inserted successfully');

    }

    public function Logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success','user Logout');
    }
}
