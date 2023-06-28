<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Blog
Route::get('/blog', [BlogPostController::class, 'index'])->name('blog.index');
//Blog Post controller show using blog category slug and blog post slug
Route::get('/blog/{category}/{post}', [BlogPostController::class, 'show'])->name('blog.show');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Define admin routes here
});
