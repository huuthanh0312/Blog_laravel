<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Brand;
use App\Models\Multipic;
use Illuminate\Support\Facades\Auth;
use Image;

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

    public function StoreBrand(Request $request){
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg,jpeg,png'

        ],
        [
            'brand_name.required' => 'Please Input Brand Name',
            'brand_image.min' => 'Brand Longger Than 4 Chars',
        ]);

        $brand_image = $request->file('brand_image');

        // WAY 1: Insert Images normal
        // $name_gen =  hexdec(uniqid());   // Convert format string hex
        // $img_ext = strtolower($brand_image->getClientOriginalExtension()); //tail img
        // $img_name  =  $name_gen.'.'.$img_ext;    // merge image name  example.png
        // $up_location = 'image/brand/';
        // $last_img = $up_location.$img_name;      //merge path image
        // $brand_image->move($up_location, $img_name);


        // Way 2: insert and resize image
        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);

        $last_img = 'image/brand/'.$name_gen;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message'=> 'Brand Inserted Successfull',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function Edit($id)
    {
        $brands = Brand::find($id);
        return view('admin.brand.edit', compact('brands'));
    }

    public function Update(Request $request,$id)
    {
        $validated = $request->validate([
            'brand_name' => 'required|min:4'

        ],
        [
            'brand_name.min' => 'Brand Longger Than 4 Chars',
        ]);
        if($request->brand_image){
            $old_imgage = $request->old_image; // get data image old

            $brand_image = $request->file('brand_image');

            // WAY 1: Insert Images normal
            // $name_gen =  hexdec(uniqid());   // Convert format string hex
            // $img_ext = strtolower($brand_image->getClientOriginalExtension());  //tail img
            // $img_name  =  $name_gen.'.'.$img_ext;    // merge image name  example.png
            // $up_location = 'image/brand/';
            // $last_img = $up_location.$img_name;      //merge path image
            // $brand_image->move($up_location, $img_name);

            // Way 2: insert and resize image
            $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
            Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);

            $last_img = 'image/brand/'.$name_gen;


            unlink($old_imgage);
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message'=> 'Brand Inserted Successfull',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        }else{
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message'=> 'Brand Inserted Successfull',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }

    }

    public function Delete($id)
    {
        $old_image = Brand::find($id)->brand_image;
        unlink($old_image);

        Brand::find($id)->delete();
        $notification = array(
            'message'=> 'Brand Deleted Successfull',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }

    // This is for Multi Image All Method
    public function Multi()
    {
        $images = Multipic::all();

        return view('admin.multipic.index', compact('images'));
    }

    public function StoreImg(Request $request){

        $image = $request->file('image');

        foreach($image as $multi_img){
            // Way 2: insert and resize image
            $name_gen = hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();
            Image::make($multi_img)->resize(300,300)->save('image/multi/'.$name_gen);

            $last_img = 'image/multi/'.$name_gen;

            Multipic::insert([
                'image' => $last_img,
                'created_at' => Carbon::now(),
            ]);
        }
        
        return redirect()->back()->with('success','Brand Inserted Successfull');
    }


}
