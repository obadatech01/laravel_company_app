<?php

use App\Models\Multipic;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangePassController;

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

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $abouts = DB::table('home_abouts')->first();
    $images = Multipic::all();
    return view('home', compact('brands', 'abouts', 'images'));
});

Route::get('/about', function () {
    return view('about');
});

// For Category Route
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'EditCat'])->name('edit.category');
Route::post('/category/update/{id}', [CategoryController::class, 'UpdateCat'])->name('update.category');
Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDeleteCat'])->name('softdelete.category');
Route::get('/category/restore/{id}', [CategoryController::class, 'RestoreCat'])->name('update.category');
Route::get('/pdelete/category/{id}', [CategoryController::class, 'PDeleteCat'])->name('pdelete.category');

// For Brand Route
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'AddBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'EditBrand'])->name('edit.brand');
Route::post('/brand/update/{id}', [BrandController::class, 'UpdateBrand'])->name('update.brand');
Route::get('/brand/delete/{id}', [BrandController::class, 'DeleteBrand'])->name('delete.brand');

// For Multipics Route
Route::get('/multi/image', [BrandController::class, 'Multipic'])->name('multi.image');
Route::post('/multi/add', [BrandController::class, 'AddImage'])->name('store.image');

// Admin All Route
Route::get('/home/slider', [HomeController::class, 'HomeSlider'])->name('home.slider');
Route::get('/add/slider', [HomeController::class, 'AddSlider'])->name('add.slider');
Route::post('/store/slider', [HomeController::class, 'StoreSlider'])->name('store.slider');


// Home About All Route
Route::get('/home/about', [AboutController::class, 'HomeAbout'])->name('home.about');
Route::get('/add/about', [AboutController::class, 'AddAbout'])->name('add.about');
Route::post('/store/about', [AboutController::class, 'StoreAbout'])->name('store.about');
Route::get('/edit/about/{id}', [AboutController::class, 'EditAbout'])->name('edit.about');
Route::post('/update/about/{id}', [AboutController::class, 'UpdateAbout'])->name('update.about');
Route::get('/delete/about/{id}', [AboutController::class, 'DeleteAbout'])->name('delete.about');

// Portfolio Page Route
Route::get('/portfolio', [AboutController::class, 'Portfolio'])->name('portfolio');

// Admin Contact Page Route
Route::get('/admin/contact', [ContactController::class, 'AdminContact'])->name('admin.contact');
Route::get('/add/contact', [ContactController::class, 'AdminAddContact'])->name('add.contact');
Route::post('/store/contact', [ContactController::class, 'AdminStoreContact'])->name('store.contact');
Route::get('/admin/message', [ContactController::class, 'AdminMessage'])->name('admin.message');
Route::get('/message/delete/{id}', [ContactController::class, 'DeleteMessage'])->name('delete.message');

// Home Contact Page Route
Route::get('/contact', [ContactController::class, 'AllContact'])->name('contact');
Route::post('/contact/form', [ContactController::class, 'ContactForm'])->name('contact.form');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    // $users = User::all();

    // $users = DB::table('users')->get();
    return view('admin.index');
})->name('dashboard');
Route::get('/user/logout', [BrandController::class, 'Logout'])->name('user.logout');

// Change Password & User Profile Route
Route::get('/user/password', [ChangePassController::class, 'ChangePassword'])->name('change.password');
Route::post('/password/update', [ChangePassController::class, 'UpdatePassword'])->name('password.update');

// User Profile
Route::get('/user/profile', [ChangePassController::class, 'EditProfile'])->name('profile.update');
Route::get('/user/profile/update', [ChangePassController::class, 'UpdateProfile'])->name('update.user.profile');

