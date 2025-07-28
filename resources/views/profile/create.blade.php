@extends('layouts.app')

@section('content')
    @include('layouts.breadcrumb')

    <div class="container-fluid py-5 bg-light">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <!-- Profile Overview -->
                <div class="col-lg-4">
                    <div class="bg-white rounded shadow-sm p-4 profile-overview">
                        <h5 class="mb-3">Welcome, John!</h5>
                        <p class="text-muted mb-2"><strong>Email:</strong> john@example.com</p>
                        <p class="text-muted mb-2"><strong>Phone:</strong> 0712345678</p>
                        <p class="text-muted mb-2"><strong>Location:</strong> Nairobi, Westlands</p>
                    </div>
                </div>

                <!-- Profile Tabs -->
                <div class="col-lg-8">
                    <div class="bg-white rounded shadow-sm p-4 tab-box">
                        <div class="overflow-auto mb-4">
                            <ul class="nav nav-tabs flex-nowrap d-flex" role="tablist" style="min-width: 500px;">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab"
                                        href="#bookings">Booking History</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                        href="#transactions">Transactions</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                        href="#subscriptions">Subscriptions</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#edit">Edit
                                        Profile</a></li>
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
                                            <th>Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>July 01, 2025</td>
                                            <td>Consultation</td>
                                            <td>10:00</td>
                                        </tr>
                                        <tr>
                                            <td>June 28, 2025</td>
                                            <td>Class</td>
                                            <td>14:00</td>
                                        </tr>
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
                                        <tr>
                                            <td>July 01, 2025</td>
                                            <td>KES 1,500.00</td>
                                            <td>MPESA123456</td>
                                        </tr>
                                        <tr>
                                            <td>June 28, 2025</td>
                                            <td>KES 2,000.00</td>
                                            <td>MPESA654321</td>
                                        </tr>
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
                                            <a class="nav-link" data-bs-toggle="pill" href="#inactive-subs">Recently
                                                Inactive</a>
                                        </li>
                                        <li class="nav-item me-2">
                                            <a class="nav-link" data-bs-toggle="pill" href="#available-subs">Available
                                                Plans</a>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Inner Tab Content -->
                                <div class="tab-content">
                                    <!-- Active Subscriptions -->
                                    <div class="tab-pane fade show active" id="active-subs">
                                        <div class="sub-card-container">
                                            <div class="card fixed-sub-card">
                                                <div class="card-body">
                                                    <h6 class="card-title">Weekly IT Class</h6>
                                                    <small class="card-title">Gain a full week of marketing access</small>
                                                    <p class="mb-1"><strong>Start Date:</strong> June 24, 2025</p>
                                                    <p class="mb-1"><strong>End Date:</strong> June 24, 2025</p>
                                                    <span class="badge bg-success">Active</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Inactive Subscriptions -->
                                    <div class="tab-pane fade" id="inactive-subs">
                                        <div class="sub-card-container">

                                            <div class="card fixed-sub-card">
                                                <div class="card-body">
                                                    <h6 class="card-title">Weekly Unlimited</h6>
                                                    <small class="card-title">Gain a full week of marketing access</small>
                                                    <p class="mb-1"><strong>End Date:</strong> May 10, 2025 <span
                                                            class="badge bg-secondary">Expired</span></p>

                                                    <div class="mt-3">
                                                        <button class="btn btn-sm btn-outline-primary">Renew</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card fixed-sub-card">
                                                <div class="card-body">
                                                    <h6 class="card-title">Monthly Unlimited</h6>
                                                    <small class="card-title">Gain a full month of marketing access</small>
                                                    <p class="mb-1"><strong>End Date:</strong> May 10, 2025 <span
                                                            class="badge bg-secondary">Expired</span></p>

                                                    <div class="mt-3">
                                                        <button class="btn btn-sm btn-outline-primary">Renew</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- Available Plans -->
                                    <div class="tab-pane fade" id="available-subs">
                                        <div class="sub-card-container">

                                            <div class="card fixed-sub-card">
                                                <div class="card-body">
                                                    <h6 class="card-title">Weekly Unlimited</h6>
                                                    <small class="card-title">Gain a full week of marketing access</small>
                                                    <p class="mb-1"><strong>Price:</strong> KES 100</p>
                                                    <button class="btn btn-sm btn-success">Subscribe</button>
                                                </div>
                                            </div>

                                            <div class="card fixed-sub-card">
                                                <div class="card-body">
                                                    <h6 class="card-title">Monthly Unlimited</h6>
                                                    <small class="card-title">Gain a full month of marketing access</small>
                                                    <p class="mb-1"><strong>Price:</strong> KES 400</p>
                                                    <button class="btn btn-sm btn-success">Subscribe</button>
                                                </div>
                                            </div>

                                            <div class="card fixed-sub-card">
                                                <div class="card-body">
                                                    <h6 class="card-title">Pro Developer</h6>
                                                    <small class="card-title">Web Developer Course for
                                                        Professionals</small>
                                                    <p class="mb-1"><strong>Price:</strong> KES 3,000</p>
                                                    <button class="btn btn-sm btn-success">Subscribe</button>
                                                </div>
                                            </div>

                                            <div class="card fixed-sub-card">
                                                <div class="card-body">
                                                    <h6 class="card-title">Beginer Developer</h6>
                                                    <small class="card-title">Web Developer Course for beginners</small>
                                                    <p class="mb-1"><strong>Price:</strong> KES 3,000</p>
                                                    <button class="btn btn-sm btn-success">Subscribe</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Edit Profile -->
                            <div class="tab-pane fade" id="edit">
                                <div class="edit-profile-pane">
                                    <h6 class="mb-3">Edit Profile</h6>
                                    <form>
                                        <div class="row mb-3">
                                            <div class="col-12 col-md-6">
                                                <input type="text" class="form-control" placeholder="First Name"
                                                    value="John">
                                            </div>
                                            <div class="col-12 col-md-6 mt-3 mt-md-0">
                                                <input type="text" class="form-control" placeholder="Last Name"
                                                    value="Doe">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <input type="email" class="form-control" placeholder="Email"
                                                value="john@example.com">
                                        </div>

                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="Phone"
                                                value="0712345678">
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-12 col-md-6">
                                                <input type="text" class="form-control" placeholder="Town"
                                                    value="Nairobi">
                                            </div>
                                            <div class="col-12 col-md-6 mt-3 mt-md-0">
                                                <input type="text" class="form-control" placeholder="Location"
                                                    value="Westlands">
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                                    </form>
                                </div>
                            </div>

                            <!-- Danger Zone -->
                            <div class="tab-pane fade" id="danger">
                                <h6 class="mb-3 text-danger">Delete Your Account</h6>
                                <p class="text-muted">This action is irreversible. All your data will be permanently
                                    deleted.</p>
                                <form
                                    onsubmit="return confirm('Are you sure you want to delete your account? This cannot be undone.');">
                                    <button type="submit" class="btn btn-danger">Delete My Account</button>
                                </form>
                            </div>
                        </div> <!-- tab content -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
