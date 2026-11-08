<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Booking;
use App\Models\Bundle;
use App\Models\MpesaPayment;
use App\Models\Portfolio;
use App\Models\Services;
use App\Models\Software;
use App\Models\User;
use App\Models\UserBundle;

class DashboardController extends Controller
{
    public function index()
    {
        $safeCount = static function ($model) {
            try {
                return $model::query()->count();
            } catch (\Throwable $e) {
                return 0;
            }
        };

        $safeSum = static function ($model, $column) {
            try {
                return (float) $model::query()->sum($column);
            } catch (\Throwable $e) {
                return 0.0;
            }
        };

        $metrics = [
            'users' => $safeCount(User::class),
            'admins' => $safeCount(Admin::class),
            'services' => $safeCount(Services::class),
            'bookings' => $safeCount(Booking::class),
            'payments' => $safeCount(MpesaPayment::class),
            'bundles' => $safeCount(Bundle::class),
            'subscriptions' => $safeCount(UserBundle::class),
            'portfolios' => $safeCount(Portfolio::class),
            'software' => $safeCount(Software::class),
            'payment_total' => $safeSum(MpesaPayment::class, 'amount'),
        ];

        $recentBookings = collect();
        $recentPayments = collect();

        try {
            $recentBookings = Booking::query()->with('user')->latest()->limit(5)->get();
        } catch (\Throwable $e) {
            $recentBookings = collect();
        }

        try {
            $recentPayments = MpesaPayment::query()->with(['user', 'booking', 'bundle'])->latest()->limit(5)->get();
        } catch (\Throwable $e) {
            $recentPayments = collect();
        }

        return view('admin.dashboard.dashboard', [
            'metrics' => $metrics,
            'recentBookings' => $recentBookings,
            'recentPayments' => $recentPayments,
        ]);
    }
}
