<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeaturedBannerController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SmptController;
use App\Http\Controllers\Admin\UsersController;
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

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'role:ADMIN', 'firewall.all']], function () {
    // change lang
    Route::get('/lang/{lang}', [DashboardController::class, 'changeLanguage'])->name('changelanguage');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/subcategories', [CategoryController::class, 'subcategories'])->name('subcategories');
    Route::get('/brands', [BrandController::class, 'index'])->name('brands');
    Route::get('/products', [ProductController::class, 'index'])->name('products');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders');

    Route::get('/users', [UsersController::class, 'index'])->name('users');

    Route::get('/sections', [SectionController::class, 'index'])->name('sections');
    Route::get('/section/create', [SectionController::class, 'create'])->name('section.create');
    Route::get('/section/edit/{id}', [SectionController::class, 'edit'])->name('section.edit');

    Route::get('/featuredBanners', [FeaturedBannerController::class, 'index'])->name('featuredBanners');
    Route::get('/pages', [PageController::class, 'index'])->name('pages');
    Route::get('/page/create', [PageController::class, 'create'])->name('page.create');
    Route::get('/order-forms', [PageController::class, 'orderForms'])->name('orderforms');

    Route::get('/sliders', [SliderController::class, 'index'])->name('sliders');

    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');
    Route::get('/blog/category', [BlogCategoryController::class, 'index'])->name('blogcategories');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::get('/shipping', [ShippingController::class, 'index'])->name('setting.shipping');
    Route::get('/popupsettings', [SettingController::class, 'popupsettings'])->name('setting.popupsettings');
    Route::get('/redirects', [SettingController::class, 'redirects'])->name('setting.redirects');

    Route::get('/report', [ReportController::class, 'index'])->name('report');

    Route::get('/notification', [NotificationController::class, 'index'])->name('notification');
    Route::get('/smpt', [SmptController::class, 'index'])->name('smpt');
    Route::get('/language', [LanguageController::class, 'index'])->name('language');
    Route::get('/roles', [RolesController::class, 'index'])->name('roles');
    Route::get('/permissions', [UsersController::class, 'permissions'])->name('permissions');
    Route::get('/currencies', [SettingController::class, 'currencies'])->name('currencies');
});
