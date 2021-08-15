<?php

namespace App\Http\Controllers;

use App\Models\HomeAbout;
use App\Models\Multipic;
use Dotenv\Store\File\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;

class AboutController extends Controller
{
    public function HomeAbout()
    {
        $abouts = HomeAbout::latest()->get();
        return view('admin.about.index', compact('abouts'));
    }

    public function AddAbout(){
        return view('admin.about.create');
    }

    public function StoreAbout(Request $request){
        HomeAbout::insert([
            'title'=>$request->title,
            'short_dis'=>$request->short_dis,
            'long_dis'=>$request->long_dis,
            'created_at'=>Carbon::now(),
        ]);
        return Redirect()->route('home.about')->with('success','About Inserted Successfully');
    }
    
    public function EditAbout($id)
    {
        $about = HomeAbout::find($id);
        return view('admin.about.edit', compact('about'));
    }

    public function UpdateAbout(Request $request, $id){
        HomeAbout::find($id)->update([
            'title' =>$request->title,
            'short_dis' =>$request->short_dis,
            'long_dis' => $request->long_dis,
            'created_at' =>Carbon::now(),           
        ]);
        return Redirect()->route('home.about')->with('success','About Updated Successful');
    }

    public function DeleteAbout($id){
        HomeAbout::find($id)->delete();
        return Redirect()->back()->with('success','About Deleted Successful');
    }


    //Portfolio controller

    public function Portfolio(){
        $images = Multipic::latest()->get();
        return view('pages.portfolio',compact('images'));
    }

}
