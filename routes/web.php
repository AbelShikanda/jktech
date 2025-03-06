<?php

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
