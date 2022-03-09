<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
Route::get('/home', function () {
    echo 'this is home page';
});
Route::get('/about', function () {
    return view('about');
});

Route::get('/contact' , [ContactController::class , 'index'])->name('contact');

// Category Controller
Route::get('/category/all' , [CategoryController::class , 'AllCat'])->name('all.category');
Route::post('/category/add' , [CategoryController::class , 'AddCat'])->name('store.category');
Route::get('/category/edit/{id}' , [CategoryController::class , 'Edit']);
Route::post('/category/update/{id}' , [CategoryController::class , 'Update']);
Route::get('softdelete/category/{id}' , [CategoryController::class , 'SoftDelete']);
Route::get('/category/restore/{id}' , [CategoryController::class , 'Restore']);
Route::get('pdelete/category/{id}' , [CategoryController::class , 'Pdelete']);

// Brand Controller
Route::get('/brand/all' , [BrandController::class , 'AllBrand'])->name('all.brand');
Route::post('/brand/add' , [BrandController::class , 'StoreBrand'])->name('store.brand');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    //$users = User::all();
    $users = DB::table('users')->get();
    return view('dashboard' , compact('users'));
})->name('dashboard');
