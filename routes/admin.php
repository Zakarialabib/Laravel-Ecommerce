<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\FeaturedBannerController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SmptController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\NotificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/subcategories', [CategoryController::class, 'subcategories'])->name('subcategories');
Route::get('/brand', [BrandController::class, 'index'])->name('brands');
Route::get('/product', [ProductController::class, 'index'])->name('products');
Route::get('/orders', [OrderController::class, 'index'])->name('orders');
Route::get('/users', [UserController::class, 'index'])->name('users');

Route::get('/sections', [SectionController::class, 'index'])->name('sections');
Route::get('/featuredBanners', [FeaturedBannerController::class, 'index'])->name('featuredBanners');
Route::get('/pages', [PageController::class, 'index'])->name('pages');
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');
Route::get('sliders', [SliderController::class, 'index'])->name('sliders');
Route::get('/settings', [SettingController::class, 'index'])->name('settings');
Route::get('/report', [ReportController::class, 'index'])->name('report');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/notification', [NotificationController::class, 'index'])->name('notification');
Route::get('/smpt', [SmptController::class, 'index'])->name('smpt');
Route::get('/language', [LanguageController::class, 'index'])->name('language');
Route::get('roles', [UserController::class, 'roles'])->name('roles');
Route::get('permissions', [UserController::class, 'permissions'])->name('permissions');
Route::get('currencies', [SettingController::class, 'currencies'])->name('currencies');
});