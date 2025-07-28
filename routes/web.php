<?php

use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Admin\AppointmentsController;
use App\Http\Controllers\Admin\BundleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqsController;
use App\Http\Controllers\Admin\HolidayController;
use App\Http\Controllers\Admin\MemesController;
use App\Http\Controllers\Admin\MpesaPaymentsController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\ServiceImagesController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\ServiceTypeController;
use App\Http\Controllers\Admin\SoftwareController;
use App\Http\Controllers\Admin\UserSubscriptionController;
use App\Http\Controllers\Admin\WorkScheduleController;
use App\Http\Controllers\DownloadsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MpesaController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UnderConstructionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/under_construction', [UnderConstructionController::class, 'underConstruction'])->name('underConstruction');

Route::get('/admin_', function () {
    return redirect()->route('dashboard.index');
})->middleware('adminauth');

Route::group(['prefix' => '/admin'], function () {
    Route::get('/login', [AdminAuthController::class, 'getLogin'])->name('getLogin');
    Route::post('/login', [AdminAuthController::class, 'postLogin'])->name('postLogin');
    Route::post('/logout', [AdminAuthController::class, 'adminLogout'])->name('adminLogout');
    Route::resource('dashboard', DashboardController::class)->middleware('adminauth');
});

Route::group(['middleware' => 'adminauth'], function () {
    Route::resource('types', ServiceTypeController::class);
    Route::resource('service_categories', ServiceCategoryController::class);
    Route::get('/admin/services/image', [ServiceImagesController::class, 'index'])->name('service_Images.index');
    Route::get('/admin/services/{id}/image/create', [ServiceImagesController::class, 'create'])->name('service_Images.create');
    Route::post('/admin/service-images', [ServiceImagesController::class, 'store'])->name('service_Images.store');
    Route::get('/admin/service-images/{id}/edit', [ServiceImagesController::class, 'edit'])->name('service_Images.edit');
    Route::put('/admin/service-images/{id}', [ServiceImagesController::class, 'update'])->name('service_Images.update');
    Route::delete('/admin/service-images/{id}', [ServiceImagesController::class, 'destroy'])->name('service_Images.destroy');

    Route::resource('services', ServicesController::class);
    Route::resource('work', WorkScheduleController::class);
    Route::resource('holiday', HolidayController::class);
    Route::resource('faqs', FaqsController::class);
    Route::resource('portfolios', PortfolioController::class);
    Route::resource('memes', MemesController::class);
    Route::resource('bundles', BundleController::class);
    Route::resource('user-bundles', UserSubscriptionController::class);
    Route::resource('payments', MpesaPaymentsController::class);
    Route::resource('software', SoftwareController::class);

    Route::get('/admin/payments/export', [MpesaPaymentsController::class, 'export'])->name('payments.export');
    Route::get('/appointments', [AppointmentsController::class, 'index'])->name('appointment.index');
    Route::get('/appointments/{id}', [AppointmentsController::class, 'show'])->name('appointment.show');
    Route::get('/appointments/{id}/edit', [AppointmentsController::class, 'edit'])->name('appointment.edit');
    Route::put('/appointments/{id}', [AppointmentsController::class, 'update'])->name('appointment.update');

    //     Route::resource('blogs', BlogController::class);
    //     Route::resource('blog_categories', BlogCategoryController::class);
    //     Route::resource('blog_images', BlogImageController::class);
    //     Route::resource('contact', ContactsController::class);
    //     Route::resource('prices', PricesController::class);

    //     Route::resource('permissions', PermissionsController::class);
    //     Route::resource('roles', RolesController::class);
});

Auth::routes();
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
Route::redirect('/home', '/');
Route::get('/', [HomeController::class, 'index'])->name('home');
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
Route::get('/catalog', [PagesController::class, 'catalog'])->name('catalog');
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
Route::get('/portfolio', [PagesController::class, 'portfolio'])->name('portfolio');
Route::get('/portfolio/details', [PagesController::class, 'portfolio_details'])->name('portfolio_details');
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
Route::get('/tutorials', [PagesController::class, 'tutorials'])->name('tutorials');
Route::get('/tutorials/datails', [PagesController::class, 'tutorials_datails'])->name('tutorials_datails');
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
Route::get('/education', [PagesController::class, 'education'])->name('education');
Route::get('/education/details', [PagesController::class, 'education_details'])->name('education_details');
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
Route::get('/downloads', [PagesController::class, 'downloads'])->name('downloads');
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::post('/contact', [PagesController::class, 'contact_store'])->name('contact.store');
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
Route::get('/comments', [PagesController::class, 'comments'])->name('comments');
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
Route::get('/service/{id}', [PagesController::class, 'service'])->name('service');
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
Route::get('/bookings', [PagesController::class, 'bookings'])->name('bookings.index');
Route::post('/booking/consultation', [PagesController::class, 'bookingStore'])->name('bookings.store');
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
Route::get('/mpesa/status-check', [MpesaController::class, 'checkStatus'])->name('mpesa.status.check');
Route::get('/bookings/retry/{id}', [PagesController::class, 'retryBookingPayment'])->name('bookings.retry');
Route::post('/m_pesa/callback', [MpesaController::class, 'mpesaCallback'])->withoutMiddleware(['auth']);
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
Route::post('/api/holidays/${year}/${month}', [PagesController::class, 'getHolidays'])->name('getHolidays');
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
Route::get('/profile', [UserController::class, 'profile'])->name('profile.show');
Route::put('/profile', [UserController::class, 'update'])->name('profile.update');
Route::delete('/profile', [UserController::class, 'destroy'])->name('profile.destroy');
Route::post('/subscribe/{bundle}', [UserController::class, 'subscribe'])->name('subscribe.bundle');
Route::get('/subscriptions/retry/{id}', [UserController::class, 'retrySubscription'])->name('subscription.retry');
Route::post('/subscription/{id}/renew', [UserController::class, 'renew'])->name('subscription.renew');
Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
Route::put('/profile/password', [UserController::class, 'updatePassword'])->name('profile.password.update');
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
