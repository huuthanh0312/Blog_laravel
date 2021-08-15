<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Image;

class HomeController extends Controller
{
    public function HomeSlider()
    {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index',compact('sliders'));
    }
    public function AddSlider()
    {
        return view('admin.slider.create');
    }

    public function StoreSlider(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:sliders|min:4',
            'image' => 'required|mimes:jpg,jpeg,png'

        ],
        [
            'title.required' => 'Please Input Brand Name',
            'title.min' => 'Brand Longger Than 4 Chars',
        ]);

        $slider_image = $request->file('image');

        // Way 2: insert and resize image
        $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920,1088)->save('image/slider/'.$name_gen);

        $last_img = 'image/slider/'.$name_gen;

        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('home.slider')->with('success','Slider Inserted Successfull');
    }

    public function EditSlider($id)
    {
        $sliders = Slider::find($id);
        return view('admin.slider.edit', compact('sliders'));
    }

    public function UpdateSlider(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|unique:sliders|min:4',
            'image' => 'mimes:jpg,jpeg,png'

        ],
        [
            'title.required' => 'Please Input Brand Name',
            'title.min' => 'Brand Longger Than 4 Chars',
        ]);
        if($request->image){
            
            $old_image = $request->old_image; // get data image old

            $slider_image = $request->file('image');

            // Way 2: insert and resize image
            $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
            Image::make($slider_image)->resize(1920,1088)->save('image/slider/'.$name_gen);

            $last_img = 'image/slider/'.$name_gen;


            unlink($old_image);
            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'image'=> $last_img,
                'created_at' => Carbon::now(),
            ]);

            return redirect()->back()->with('success','Slider Inserted Successfull');
        }else{
            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'created_at' => Carbon::now(),
            ]);

            return redirect()->back()->with('success','Slider Inserted Successfull');
        }
    }
    public function DeleteSlider($id)
    {
        $old_image = Slider::find($id)->image;
        unlink($old_image);

        Slider::find($id)->delete();
        return redirect()->back()->with('success','Brand Deleted Successfull');
    }


    public function Logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success','Logout Successfull');
    }

}
