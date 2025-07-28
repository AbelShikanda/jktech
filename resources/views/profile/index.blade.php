@extends('layouts.app')

@section('content')
    @include('layouts.breadcrumb')

    <div class="container-fluid py-5 bg-light">
        <div class="container">
            <div class="row g-4 justify-content-center">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('tab'))
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const tab = "{{ session('tab') }}";
                            const trigger = document.querySelector(`[href="#${tab}"]`);
                            if (trigger) {
                                new bootstrap.Tab(trigger).show();
                            }
                        });
                    </script>
                @endif

                @if (session('success') && session('tab') === 'password')
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0 small">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Profile Overview -->
                <div class="col-lg-4">
                    <div class="bg-white rounded shadow-sm p-4 profile-overview">
                        <h5 class="mb-3">Welcome, {{ auth()->user()->name }}!</h5>
                        <p class="text-muted mb-2"><strong>Email:</strong> {{ auth()->user()->email }}</p>
                        <p class="text-muted mb-2"><strong>Phone:</strong> {{ auth()->user()->phone ?? 'N/A' }}</p>
                        <p class="text-muted mb-2"><strong>Location:</strong> {{ auth()->user()->location ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Profile Tabs -->
                <div class="col-lg-8">
                    <div class="bg-white rounded shadow-sm p-4 tab-box">
                        <div class="overflow-auto mb-4">
                            <ul class="nav nav-tabs flex-nowrap d-flex" role="tablist" style="min-width: 500px;">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab"
                                        href="#bookings">Bookings</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                        href="#transactions">Transactions</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                        href="#subscriptions">Subscriptions</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#edit">Edit</a></li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#password">Password</a>
                                </li>
                                <li class="nav-item"><a class="nav-link text-danger" data-bs-toggle="tab"
                                        href="#danger">Danger Zone</a></li>
                            </ul>
                        </div>

                        <div class="tab-content" style="height: 50vh; overflow-y: auto;">
                            <!-- Bookings -->
                            <div class="tab-pane fade show active" id="bookings">
                                <h6 class="mb-3">Your Booking History</h6>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookings as $booking)
                                            <tr>
                                                <td>{{ $booking->date->format('M d, Y') }}</td>
                                                <td>
                                                    @foreach ($booking->services as $service)
                                                        {{ $service->name }}
                                                        @if (!$loop->last)
                                                            ,
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>{{ $booking->start_time }}</td>
                                                <td>{{ $booking->end_time }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Transactions -->
                            <div class="tab-pane fade" id="transactions">
                                <h6 class="mb-3">Payment Transactions</h6>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Reference</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $txn)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($txn->transaction_date)->format('M d, Y') }}
                                                </td>
                                                <td>KES {{ number_format($txn->amount, 2) }}</td>
                                                <td>{{ $txn->mpesa_receipt_number }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Subscriptions -->
                            <div class="tab-pane fade" id="subscriptions">
                                <h6 class="mb-3">Your Subscriptions</h6>

                                <!-- Inner Tabs -->
                                <div class="overflow-auto mb-3">
                                    <ul class="nav nav-pills flex-nowrap d-flex" role="tablist" style="min-width: 350px;">
                                        <li class="nav-item me-2">
                                            <a class="nav-link active" data-bs-toggle="pill" href="#active-subs">Active</a>
                                        </li>
                                        <li class="nav-item me-2">
                                            <a class="nav-link" data-bs-toggle="pill" href="#inactive-subs">Recent</a>
                                        </li>
                                        <li class="nav-item me-2">
                                            <a class="nav-link" data-bs-toggle="pill" href="#available-subs">Available</a>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Inner Tab Content -->
                                <div class="tab-content">
                                    <!-- Active Subscriptions -->
                                    <div class="tab-pane fade show active" id="active-subs">
                                        <div class="sub-card-container">
                                            @forelse (auth()->user()->subscriptions->where('status', 'active') as $sub)
                                                <div class="card fixed-sub-card">
                                                    <div class="card-body">
                                                        <h6 class="card-title">{{ $sub->bundle->name }}</h6>
                                                        <small class="card-title">{{ $sub->bundle->description }}</small>
                                                        <p class="mb-1"><strong>Start Date:</strong>
                                                            {{ $sub->start_date->format('M d, Y') }}</p>
                                                        <p class="mb-1"><strong>End Date:</strong>
                                                            {{ $sub->end_date->format('M d, Y') }}</p>
                                                        <span class="badge bg-success">Active</span>
                                                    </div>
                                                </div>
                                            @empty
                                                <p class="text-muted">No active subscriptions.</p>
                                            @endforelse
                                        </div>
                                    </div>

                                    <!-- Inactive Subscriptions -->
                                    <div class="tab-pane fade" id="inactive-subs">
                                        <div class="sub-card-container">
                                            @forelse ($recentlyExpired as $expired)
                                                <div class="card fixed-sub-card">
                                                    <div class="card-body">
                                                        <h6 class="card-title">{{ $expired->bundle->name }}</h6>
                                                        <small
                                                            class="card-title">{{ $expired->bundle->description }}</small>
                                                        <p class="mb-1"><strong>End Date:</strong>
                                                            {{ $expired->end_date->format('M d, Y') }}</p>
                                                        <span class="badge bg-secondary">Expired</span>
                                                        <form action="{{ route('subscription.renew', $expired->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button
                                                                class="btn btn-sm btn-outline-primary mt-3">Renew</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @empty
                                                <p class="text-muted">No recently expired subscriptions.</p>
                                            @endforelse
                                        </div>
                                    </div>


                                    <!-- Available Plans -->
                                    <div class="tab-pane fade" id="available-subs">
                                        <div class="sub-card-container">
                                            @foreach ($bundles as $bundle)
                                                <div class="card fixed-sub-card">
                                                    <div class="card-body">
                                                        <h6 class="card-title">{{ $bundle->name }}</h6>
                                                        <small class="card-title">{{ $bundle->description }}</small>
                                                        <p class="mb-1"><strong>Price:</strong> KES
                                                            {{ number_format($bundle->price, 2) }}</p>

                                                        @if ($bundle->features)
                                                            <ul class="text-muted small">
                                                                @foreach ($bundle->features as $feature)
                                                                    <li>{{ $feature }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif

                                                        <form action="{{ route('subscribe.bundle', $bundle->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button class="btn btn-sm btn-success">Subscribe</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Profile -->
                            <div class="tab-pane fade" id="edit">
                                <div class="edit-profile-pane">
                                    <h6 class="mb-3">Edit Profile</h6>
                                    <form method="POST" action="{{ route('profile.update') }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="row mb-3">
                                            <div class="col-12 col-md-6">
                                                <input type="text" name="first_name" class="form-control"
                                                    placeholder="First Name"
                                                    value="{{ old('first_name', auth()->user()->first_name) }}">
                                            </div>
                                            <div class="col-12 col-md-6 mt-3 mt-md-0">
                                                <input type="text" name="last_name" class="form-control"
                                                    placeholder="Last Name"
                                                    value="{{ old('last_name', auth()->user()->last_name) }}">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Email" value="{{ old('email', auth()->user()->email) }}">
                                        </div>

                                        <div class="mb-3">
                                            <input type="text" name="phone" class="form-control"
                                                placeholder="Phone" value="{{ old('phone', auth()->user()->phone) }}">
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-12 col-md-6">
                                                <input type="text" name="town" class="form-control"
                                                    placeholder="Town" value="{{ old('town', auth()->user()->town) }}">
                                            </div>
                                            <div class="col-12 col-md-6 mt-3 mt-md-0">
                                                <input type="text" name="location" class="form-control"
                                                    placeholder="Location"
                                                    value="{{ old('location', auth()->user()->location) }}">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                                    </form>
                                </div>
                            </div>

                            <!-- Change Password -->
                            <div class="tab-pane fade" id="password">
                                <h6 class="mb-3">Change Password</h6>
                                <form method="POST" action="{{ route('profile.password.update') }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <input type="password" name="current_password"
                                            class="form-control @error('current_password') is-invalid @enderror"
                                            placeholder="Current Password" required>
                                        @error('current_password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <input type="password" name="new_password"
                                                class="form-control @error('new_password') is-invalid @enderror"
                                                placeholder="New Password" required>
                                            @error('new_password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mt-3 mt-md-0">
                                            <input type="password" name="new_password_confirmation"
                                                class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                                placeholder="Confirm New Password" required>
                                            @error('new_password_confirmation')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-warning w-100">Update Password</button>
                                </form>
                            </div>

                            <!-- Danger Zone -->
                            <!-- <div class="tab-pane fade" id="danger">
                                <h6 class="mb-3 text-danger">Delete Your Account</h6>
                                <p class="text-muted">This action is irreversible. All your data will be permanently
                                    deleted.</p>
                                <form method="POST" action="{{ route('profile.destroy') }}"
                                    onsubmit="return confirm('Are you sure you want to delete your account? This cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete My Account</button>
                                </form>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
