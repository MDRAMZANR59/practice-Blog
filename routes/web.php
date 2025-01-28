<?php

use App\Http\Controllers\testres;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\addblogMiddleware;

// Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/',HomeController::class)->name('home'); //invoke controller
//all bolg home page
Route::get('/home/all-blog',[HomeController::class,'showBlog'])->name('allBlog');
//single blog page
Route::get('home/singleBlog/{id}',[HomeController::class,'singleblog'])->name('singleBlog');
//index page
Route::get('/admin/blogs', [BlogController::class, 'index'])->name('admin')->middleware(['auth', 'verified']);
//blog add form
Route::get('/admin/addblog',[BlogController::class,'create'])->name('blogForm');
//store blog
Route::POST('/blogStore',[BlogController::class,'store'])->name('blogStore');
//edit blog
// Route::get('/admin/editBlog/{id}',[BlogController::class,'edit'])->name('editBlog')->middleware(addblogMiddleware::class);
Route::get('/admin/editBlog/{id}',[BlogController::class,'edit'])->name('editBlog');
//update blog
Route::POST('/update/{id}',[BlogController::class,'update'])->name('update');
//delete blog
Route::get('/deleteBlog/{id}',[BlogController::class,'distroy'])->name('deleteBlog');
//password Reset Manual
Route::get('/resetPassword', [BlogController::class,'resetForm'])->name('resetPassword');
//store Password
Route::POST('/storePass', [BlogController::class,'storepassword'])->name('storePass');

// Route::get('hello',function(){
//     return view('hl',['name'=>'Akash']);
// });

// Route::resource('sdf', testres::class);


require __DIR__.'/auth.php';
