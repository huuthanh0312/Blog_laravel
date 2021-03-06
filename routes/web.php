<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ChangePass;
use App\Models\Multipic;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $home_about = DB::table('home_abouts')->get();
    $images = Multipic::all();
    return view('home', compact('brands','home_about','images'));
});


Route::get('/home',function(){
    return Redirect('/');
});


//Category Controller - Route
Route::get('/category/all',[CategoryController::class,'AllCat'])->name('all.category');

Route::post('/category/add',[CategoryController::class,'AddCat'])->name('store.category');

Route::get('/category/edit/{id}',[CategoryController::class,'Edit']);

Route::post('/category/update/{id}',[CategoryController::class,'Update']);

Route::get('/softdelete/category/{id}',[CategoryController::class,'SoftDelete']);

Route::get('/category/restore/{id}',[CategoryController::class,'Restore']);

Route::get('/pdelete/category/{id}',[CategoryController::class,'PDelete']);

//Brand Controller - Route
Route::get('/brand/all',[BrandController::class,'AllBrand'])->name('all.brand');

Route::post('/brand/add',[BrandController::class,'StoreBrand'])->name('store.brand');

Route::get('/brand/edit/{id}',[BrandController::class,'Edit']);

Route::post('/brand/update/{id}',[BrandController::class,'Update']);

Route::get('/brand/delete/{id}',[BrandController::class,'Delete']);

//Multi Image Controller Route
Route::get('/multi/image',[BrandController::class,'Multi'])->name('multi.image');

Route::post('/multi/add',[BrandController::class,'StoreImg'])->name('store.multi');


//Home Controller All Route Admin

Route::get('/home/slider',[HomeController::class,'HomeSlider'])->name('home.slider');

Route::get('/add/slider',[HomeController::class,'AddSlider'])->name('add.slider');

Route::post('/store/slider',[HomeController::class,'StoreSlider'])->name('store.slider');

Route::get('/edit/slider/{id}',[HomeController::class,'EditSlider']);

Route::post('/update/slider/{id}',[HomeController::class,'UpdateSlider']);

Route::get('/delete/slider/{id}',[HomeController::class,'DeleteSlider']);

Route::get('/user/logout',[HomeController::class,'Logout'])->name('user.logout');


// About Controller All Routes
Route::get('/home/about',[AboutController::class,'HomeAbout'])->name('home.about');

Route::get('/add/about',[AboutController::class,'AddAbout'])->name('add.about');

Route::post('/store/about',[AboutController::class,'StoreAbout'])->name('store.about');

Route::get('/edit/about/{id}',[AboutController::class,'EditAbout']);

Route::post('/update/about/{id}',[AboutController::class,'UpdateAbout']);

Route::get('/delete/about/{id}',[AboutController::class,'DeleteAbout']);


//Portfolio route 
Route::get('/portfolio',[AboutController::class,'Portfolio'])->name('portfolio');


//Contact Controller All route
Route::get('/contact',[ContactController::class,'Contact'])->name('contact');

Route::post('/contact/form',[ContactController::class,'ContactForm'])->name('contact.form');


// Admin Contact Page Route
Route::get('/admin/contact',[ContactController::class,'AdminContact'])->name('admin.contact')->middleware('auth');;

Route::get('/admin/add/contact',[ContactController::class,'AdminAddContact'])->name('add.contact')->middleware('auth');;

Route::post('/admin/store/contact',[ContactController::class,'AdminStoreContact'])->name('store.contact')->middleware('auth');;

Route::get('/admin/edit/contact/{id}',[ContactController::class,'AdminEditContact'])->middleware('auth');;

Route::post('/admin/update/contact/{id}',[ContactController::class,'AdminUpdateContact'])->middleware('auth');;

Route::get('/admin/delete/contact/{id}',[ContactController::class,'AdminDeleteContact'])->middleware('auth');;

Route::get('/admin/message/contact',[ContactController::class,'ContactMessage'])->name('contact.message')->middleware('auth');


// Change Password Page Route
Route::get('/user/password',[ChangePass::class,'CPassword'])->name('change.password');

Route::post('/password/update',[ChangePass::class,'UpdatePassword'])->name('password.update');

//Change Profile Page Route
Route::get('user/profile',[ChangePass::class,'ProfileInfo'])->name('profile.info');

Route::post('user/profile/update',[ChangePass::class,'UpdateProfile'])->name('update.user.profile');




// Authention Controller
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all();
    // $users = DB::table('users')->get();
    return view('admin.index');
})->name('dashboard');

