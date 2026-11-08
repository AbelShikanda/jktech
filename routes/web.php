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
    return redirect()->route('admin.dashboard.index');
})->middleware('adminauth');

Route::group(['prefix' => '/admin'], function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'getLogin'])->name('getLogin');
        Route::post('/login', [AdminAuthController::class, 'postLogin'])->name('postLogin');
    });
    Route::post('/logout', [AdminAuthController::class, 'adminLogout'])->name('adminLogout')->middleware('adminauth');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index')->middleware('adminauth');
});

Route::middleware('adminauth')->prefix('admin')->group(function () {
    Route::resource('types', ServiceTypeController::class);
    Route::resource('service_categories', ServiceCategoryController::class);
    Route::resource('knowledge-base-categories', \App\Http\Controllers\Admin\KnowledgeBaseCategoryController::class);
    Route::resource('knowledge-bases', \App\Http\Controllers\Admin\KnowledgeBaseController::class);
    Route::resource('knowledge-base-images', \App\Http\Controllers\Admin\KnowledgeBaseImageController::class);
    Route::get('/services/image', [ServiceImagesController::class, 'index'])->name('service_Images.index');
    Route::get('/services/{id}/image/create', [ServiceImagesController::class, 'create'])->name('service_Images.create');
    Route::post('/service-images', [ServiceImagesController::class, 'store'])->name('service_Images.store');
    Route::get('/service-images/{id}/edit', [ServiceImagesController::class, 'edit'])->name('service_Images.edit');
    Route::put('/service-images/{id}', [ServiceImagesController::class, 'update'])->name('service_Images.update');
    Route::delete('/service-images/{id}', [ServiceImagesController::class, 'destroy'])->name('service_Images.destroy');

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

    Route::get('/payments/export', [MpesaPaymentsController::class, 'export'])->name('payments.export');
    Route::get('/appointments', [AppointmentsController::class, 'index'])->name('appointment.index');
    Route::get('/appointments/{id}', [AppointmentsController::class, 'show'])->name('appointment.show');
    Route::get('/appointments/{id}/edit', [AppointmentsController::class, 'edit'])->name('appointment.edit');
    Route::put('/appointments/{id}', [AppointmentsController::class, 'update'])->name('appointment.update');
});

Auth::routes(['verify' => false]);
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
Route::get('/tutorials/details', [PagesController::class, 'tutorial_Details'])->name('tutorials_details');
Route::get('/tutorials/datails', [PagesController::class, 'tutorial_Details'])->name('tutorials_datails');
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
Route::post('/api/holidays/{year}/{month}', [PagesController::class, 'getHolidays'])->name('getHolidays');
Route::get('/api/holidays/{year}/{month}', [PagesController::class, 'getHolidays']);
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
Route::middleware('auth:web')->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile.show');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::delete('/profile', [UserController::class, 'destroy'])->name('profile.destroy');
    Route::post('/subscribe/{bundle}', [UserController::class, 'subscribe'])->name('subscribe.bundle');
    Route::get('/subscriptions/retry/{id}', [UserController::class, 'retrySubscription'])->name('subscription.retry');
    Route::post('/subscription/{id}/renew', [UserController::class, 'renew'])->name('subscription.renew');
    Route::put('/profile/password', [UserController::class, 'updatePassword'])->name('profile.password.update');
});
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
