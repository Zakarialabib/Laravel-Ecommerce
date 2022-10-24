<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\Admin\DashboardController;
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

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/catalog', [FrontController::class, 'catalog'])->name('front.catalog');
// Route::get('/catalog/{slug}', [FrontController::class, 'catalog'])->name('front.catalog');
Route::get('/product/{slug}', [FrontController::class, 'product'])->name('front.product');
Route::get('/cart', [FrontController::class, 'cart'])->name('front.cart');
Route::get('/checkout', [FrontController::class, 'checkout'])->name('front.checkout');
Route::get('/contact', [FrontController::class, 'contact'])->name('front.contact');
Route::get('/about', [FrontController::class, 'about'])->name('front.about');
Route::get('/blog', [FrontController::class, 'blog'])->name('front.blog');
Route::get('/blog/{slug}', [FrontController::class, 'blogSingle'])->name('front.blogSingle');
Route::get('/faq', [FrontController::class, 'faq'])->name('front.faq');


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';