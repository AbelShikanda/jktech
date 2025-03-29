<?php

use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HolidayController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\ServiceTypeController;
use App\Http\Controllers\Admin\WorkScheduleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UnderConstructionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/under_construction', [UnderConstructionController::class, 'underConstruction'])->name('underConstruction');

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

Route::group(['middleware' => 'adminauth'], function () {
    Route::resource('types', ServiceTypeController::class);
    Route::resource('service_categories', ServiceCategoryController::class);
    Route::resource('services', ServicesController::class);
    Route::resource('work', WorkScheduleController::class);
    Route::resource('holiday', HolidayController::class);
    //     Route::resource('blogs', BlogController::class);
    //     Route::resource('blog_categories', BlogCategoryController::class);
    //     Route::resource('blog_images', BlogImageController::class);
    //     Route::resource('contact', ContactsController::class);
    //     Route::resource('prices', PricesController::class);

    //     Route::resource('permissions', PermissionsController::class);
    //     Route::resource('roles', RolesController::class);
});

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

Route::get('/bookings', [PagesController::class, 'bookings'])->name('bookings.index');
Route::post('/booking/consultation', [PagesController::class, 'bookingStore'])->name('bookings.store');
