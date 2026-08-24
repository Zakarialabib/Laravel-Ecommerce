<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SmptController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Livewire\Admin\Backup\Index as BackupIndex;
use App\Http\Livewire\Admin\Blog\Index as BlogIndex;
use App\Http\Livewire\Admin\BlogCategory\Index as BlogCategoryIndex;
use App\Http\Livewire\Admin\Brands\Index as BrandIndex;
use App\Http\Livewire\Admin\Categories\Index as CategoryIndex;
use App\Http\Livewire\Admin\Currency\Index as CurrencyIndex;
use App\Http\Livewire\Admin\Customer\Index as CustomerIndex;
use App\Http\Livewire\Admin\Email\Index as EmailIndex;
use App\Http\Livewire\Admin\FeaturedBanner\Index as FeaturedBannerIndex;
use App\Http\Livewire\Admin\Language\Index as LanguageIndex;
use App\Http\Livewire\Admin\Menu\Index as MenuIndex;
use App\Http\Livewire\Admin\Order\Index as OrderIndex;
use App\Http\Livewire\Admin\OrderForm\Index as OrderFormIndex;
use App\Http\Livewire\Admin\Page\Index as PageIndex;
use App\Http\Livewire\Admin\Product\Index as ProductIndex;
use App\Http\Livewire\Admin\Role\Index as RoleIndex;
use App\Http\Livewire\Admin\Section\Index as SectionIndex;
use App\Http\Livewire\Admin\Settings\Index as SettingsIndex;
use App\Http\Livewire\Admin\Shipping\Index as ShippingIndex;
use App\Http\Livewire\Admin\Slider\Index as SliderIndex;
use App\Http\Livewire\Admin\Subcategory\Index as SubcategoryIndex;
use App\Http\Livewire\Admin\Subscriber\Index as SubscriberIndex;
use App\Http\Livewire\Admin\Users\Index as UsersIndex;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Index/list pages are served by full-page Livewire 4 components
| (Route::livewire mirrors the proven /admin/backup pattern). Non-index
| actions (create/edit/store/...) remain on their controllers.
|
*/

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'role:ADMIN', 'firewall.all']], function () {
    // change lang
    Route::get('/lang/{lang}', [DashboardController::class, 'changeLanguage'])->name('changelanguage');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Index pages (Livewire)
    Route::livewire('/categories', CategoryIndex::class)->name('categories');
    Route::get('/subcategories', [CategoryController::class, 'subcategories'])->name('subcategories');
    Route::livewire('/brands', BrandIndex::class)->name('brands');
    Route::livewire('/currencies', CurrencyIndex::class)->name('currencies');
    Route::livewire('/customers', CustomerIndex::class)->name('customers');
    Route::livewire('/emails', EmailIndex::class)->name('emails');
    Route::livewire('/featuredBanners', FeaturedBannerIndex::class)->name('featuredBanners');
    Route::livewire('/languages', LanguageIndex::class)->name('languages');
    Route::livewire('/menus', MenuIndex::class)->name('menus');
    Route::livewire('/orders', OrderIndex::class)->name('orders');
    Route::livewire('/order-forms', OrderFormIndex::class)->name('orderforms');
    Route::livewire('/pages', PageIndex::class)->name('pages');
    Route::livewire('/products', ProductIndex::class)->name('products');
    Route::livewire('/roles', RoleIndex::class)->name('roles');
    Route::livewire('/sections', SectionIndex::class)->name('sections');
    Route::livewire('/settings', SettingsIndex::class)->name('settings');
    Route::livewire('/shipping', ShippingIndex::class)->name('setting.shipping');
    Route::livewire('/sliders', SliderIndex::class)->name('sliders');
    Route::livewire('/blogs', BlogIndex::class)->name('blogs');
    Route::livewire('/blog/category', BlogCategoryIndex::class)->name('blogcategories');
    Route::livewire('/subscribers', SubscriberIndex::class)->name('subscribers');
    Route::livewire('/users', UsersIndex::class)->name('users');

    // Non-index admin actions (controllers)
    Route::get('/section/create', [SectionController::class, 'create'])->name('section.create');
    Route::get('/section/edit/{id}', [SectionController::class, 'edit'])->name('section.edit');
    Route::get('/page/settings', [PageController::class, 'settings'])->name('page.settings');
    Route::livewire('/backup', BackupIndex::class)->name('setting.backup');
    Route::get('/popupsettings', [SettingController::class, 'popupsettings'])->name('setting.popupsettings');
    Route::get('/redirects', [SettingController::class, 'redirects'])->name('setting.redirects');
    Route::get('/smpt', [SmptController::class, 'index'])->name('smpt');
    Route::get('/permissions', [UsersController::class, 'permissions'])->name('permissions');
    Route::get('/report', [ReportController::class, 'index'])->name('report');
    Route::get('/notification', [NotificationController::class, 'index'])->name('notification');
    Route::get('/language', [LanguageController::class, 'index'])->name('language');
});
