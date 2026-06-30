<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TestimonialController;

/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('pages.splash');
});

Route::get('/home', [HomeController::class, 'index']);

Route::get('/account/{id}', [AccountController::class, 'show']);

Route::get('/testimonial', [TestimonialController::class, 'create']);

Route::post('/testimonial', [TestimonialController::class, 'store']);

Route::get('/testimonials', [HomeController::class, 'testimonials']);

Route::get('/testimonial/create', [HomeController::class, 'testimonialForm']);

Route::post('/testimonial/store', [HomeController::class, 'storeTestimonial']);

/*
|--------------------------------------------------------------------------
| Admin Login
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/login', [AdminController::class, 'authenticate']);
Route::post('/admin/logout', [AdminController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::middleware('admin')->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard']);

    Route::get('/create', [AdminController::class, 'create']);

    Route::post('/store', [AdminController::class, 'store']);

    Route::get('/edit/{id}', [AdminController::class, 'edit']);

    Route::put('/update/{id}', [AdminController::class, 'update']);

    Route::delete('/delete/{id}', [AdminController::class, 'destroy']);
    Route::delete(
    '/gallery/delete/{id}/{image}',
    [AdminController::class, 'deleteGallery']
);
Route::get(
    '/testimonials',
    [TestimonialController::class, 'index']
);

Route::put(
    '/testimonials/approve/{id}',
    [TestimonialController::class, 'approve']
);

Route::delete(
    '/testimonials/delete/{id}',
    [TestimonialController::class, 'destroy']
);

});