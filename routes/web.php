<?php

use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UnderConstructionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 */
Route::get('/under_construction', [UnderConstructionController::class, 'underConstruction'])->name('underConstruction');

// Route::get('/sitemap.xml', function () {
//     return response()->file(public_path('sitemap.xml'));
// });

Route::get('/admin_', function () {
    return redirect()->route('dashboard.index');
})
    ->middleware('adminauth');

Route::group(['prefix' => '/admin'], function () {
    Route::get('/login', [AdminAuthController::class, 'getLogin'])->name('getLogin');
    Route::post('/login', [AdminAuthController::class, 'postLogin'])->name('postLogin');
    Route::post('/logout', [AdminAuthController::class, 'adminLogout'])->name('adminLogout');
    Route::resource('dashboard', DashboardController::class)->middleware('adminauth');
});

// Route::group(['middleware' => 'adminauth'], function () {
//     Route::resource('colors', ProductColorController::class);
//     Route::resource('sizes', ProductSizeController::class);
//     Route::resource('types', ProductTypeController::class);
//     Route::resource('materials', ProductMaterialController::class);
//     Route::resource('product_categories', ProductCategoryController::class);
//     Route::resource('products', ProductsController::class);
//     Route::resource('product_images', ProductImageController::class);
//     Route::resource('orders', OrdersController::class);
//     Route::resource('order_items', OrderItemsController::class);
//     Route::resource('admins', AdminController::class);
//     Route::resource('users', UserController::class);
//     Route::resource('blogs', BlogController::class);
//     Route::resource('blog_categories', BlogCategoryController::class);
//     Route::resource('blog_images', BlogImageController::class);
//     Route::resource('contact', ContactsController::class);
//     Route::resource('prices', PricesController::class);
//     Route::resource('comment', CommentsController::class);

//     Route::resource('permissions', PermissionsController::class);
//     Route::resource('roles', RolesController::class);

//     Route::get('/promo', [PromoCodeController::class, 'index'])->name('promo.index');
//     Route::get('/create/promo', [PromoCodeController::class, 'create'])->name('promo.create');
//     Route::post('/create-promo', [PromoCodeController::class, 'createPromo'])->name('create.promo');
//     Route::get('/promo-edit/{id}', [PromoCodeController::class, 'edit'])->name('promo.edit');
//     Route::get('/promo-details/{id}', [PromoCodeController::class, 'show'])->name('promo.show');
//     Route::PATCH('/promo-update/{id}', [PromoCodeController::class, 'update'])->name('promo.update');
//     Route::DELETE('/promo-destroy/{id}', [PromoCodeController::class, 'destroy'])->name('promo.destroy');
// });

Auth::routes();

Route::redirect('/home', '/');
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/portfolio', [PagesController::class, 'portfolio'])->name('portfolio');
Route::get('/portfolio/details', [PagesController::class, 'portfolio_details'])->name('portfolio_details');
Route::get('/tutorials', [PagesController::class, 'tutorials'])->name('tutorials');
Route::get('/tutorials/datails', [PagesController::class, 'tutorials_datails'])->name('tutorials_datails');
Route::get('/education', [PagesController::class, 'education'])->name('education');
Route::get('/education/details', [PagesController::class, 'education_details'])->name('education_details');
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::get('/contact/store', [PagesController::class, 'contact_store'])->name('contact_store');
Route::get('/comments', [PagesController::class, 'comments'])->name('comments');

// Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
// Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
// Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
// Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
// Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
