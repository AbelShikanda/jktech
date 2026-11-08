@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h5 page-title mb-4">Dashboard</h2>

                <div class="row">
                    @foreach ([
                        ['label' => 'Users', 'value' => $metrics['users'] ?? 0],
                        ['label' => 'Admins', 'value' => $metrics['admins'] ?? 0],
                        ['label' => 'Services', 'value' => $metrics['services'] ?? 0],
                        ['label' => 'Bookings', 'value' => $metrics['bookings'] ?? 0],
                        ['label' => 'Payments', 'value' => $metrics['payments'] ?? 0],
                        ['label' => 'Payment Total', 'value' => number_format((float) ($metrics['payment_total'] ?? 0), 2)],
                        ['label' => 'Bundles', 'value' => $metrics['bundles'] ?? 0],
                        ['label' => 'Subscriptions', 'value' => $metrics['subscriptions'] ?? 0],
                        ['label' => 'Portfolios', 'value' => $metrics['portfolios'] ?? 0],
                        ['label' => 'Software', 'value' => $metrics['software'] ?? 0],
                    ] as $metric)
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow h-100">
                                <div class="card-body">
                                    <p class="small text-uppercase text-muted mb-1">{{ $metric['label'] }}</p>
                                    <h3 class="mb-0">{{ $metric['value'] }}</h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow h-100">
                            <div class="card-header"><strong>Recent Bookings</strong></div>
                            <div class="card-body">
                                @if (($recentBookings ?? collect())->isEmpty())
                                    <p class="text-muted mb-0">No bookings yet. Seed data or create a booking to test this section.</p>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-sm mb-0">
                                            <thead><tr><th>ID</th><th>User</th><th>Date</th><th>Status</th></tr></thead>
                                            <tbody>
                                                @foreach ($recentBookings as $booking)
                                                    <tr>
                                                        <td>{{ $booking->id }}</td>
                                                        <td>{{ optional($booking->user)->email ?? 'N/A' }}</td>
                                                        <td>{{ optional($booking->date ?? $booking->created_at)->format('Y-m-d') ?? 'N/A' }}</td>
                                                        <td>{{ $booking->confirmed ? 'Confirmed' : 'Pending' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow h-100">
                            <div class="card-header"><strong>Recent Payments</strong></div>
                            <div class="card-body">
                                @if (($recentPayments ?? collect())->isEmpty())
                                    <p class="text-muted mb-0">No payments yet. Local payment simulation/seed data will appear here.</p>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-sm mb-0">
                                            <thead><tr><th>ID</th><th>For</th><th>Amount</th><th>Status</th></tr></thead>
                                            <tbody>
                                                @foreach ($recentPayments as $payment)
                                                    <tr>
                                                        <td>{{ $payment->id }}</td>
                                                        <td>{{ $payment->payment_for ?? 'N/A' }}</td>
                                                        <td>{{ number_format((float) ($payment->amount ?? 0), 2) }}</td>
                                                        <td>{{ $payment->status ?? 'N/A' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
