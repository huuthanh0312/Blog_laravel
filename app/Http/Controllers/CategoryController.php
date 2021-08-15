<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function AllCat()
    {
        //way 1 : eloquent ORM
        //$categories = Category::all();

        //way 2 eloquent ORM Pagination
        $categories = Category::latest()->paginate(5); // lấy theo thứ tự giảm dần stt
        $trashCat = Category::onlyTrashed()->latest()->paginate(3);

        //way3: query builder
        //$categories = DB::table('categories')->latest()->get();

        //Query Pagination
        //$categories = DB::table('categories')->latest()->paginate(5);

        //Query Builder join Table
        // $categories = DB::table('categories')
        //                 ->join('users','categories.user_id','users.id')
        //                 ->select('categories.*','users.name')
        //                 ->latest()->paginate(5);

        return view('admin.category.index',compact('categories','trashCat'));
    }


    public function AddCat(Request $request){
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',

        ],
        [
            'category_name.required' => 'Please Input Category Name',
            'category_name.max' => 'Category Less Than 255Chars',
        ]);

        // Away 1: Eloquent ORM
        Category::insert([
            'category_name'=>$request->category_name,
            'user_id'=>Auth::user()->id,
            'created_at'=>Carbon::now()
        ]);

        //Away 2:
        // $category = new Category();
        // $category->category_name = $request->category_name;
        // $category->user_id = Auth::user()->id;
        // $category->save();

        //Away 3 : Query Builder
        // $data = array();
        // $data['category_name']= $request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // $data['created_at'] = Carbon::now();
        // DB::table('categories')->insert($data);

        return redirect()->back()->with('success','Category Inserted Successfull');
    }

    public function Edit($id)
    {
        //way 1 : elopquent ORM 
        // $categories = Category::find($id);

        //way 2 : query builder
        $categories = DB::table('categories')->where('id',$id)->first();


        return view('admin.category.edit', compact('categories'));
    }

    public function Update(Request $request, $id)
    {
        //way 1 : elopquent ORM 
        // $update = Category::find($id)->update([
        //     'category_name'=>$request->category_name,
        //     'user_id'=>Auth::user()->id
        // ]);

        //way 2 : query builder
        $categories = array();
        $categories['category_name']= $request->category_name;
        $categories['user_id']= Auth::user()->id;
        DB::table('categories')->where('id', $id)->update($categories);

        return redirect()->route('all.category')->with('success','Category Updated Successfull');
    }

    public function SoftDelete($id)
    {
        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('success','Category Soft Deleted Success');
    }

    public function Restore($id)
    {
        $delete = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success','Category Restore Success');

    }

    public function PDelete($id){
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success','Category Permanently Deleted');
    }
}
