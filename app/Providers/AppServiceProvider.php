<?php

namespace App\Providers;

use App\Models\Booking;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        View::composer('*', function ($view) {
            $bookings = [];

            if (Auth::check()) {
                $bookings = Booking::where('user_id', Auth::id())->latest()->get();
            }

            $view->with('bookings', $bookings);
        });
    }
}
