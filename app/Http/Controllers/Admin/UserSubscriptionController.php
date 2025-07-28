<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bundle;
use App\Models\User;
use App\Models\UserBundle;
use Illuminate\Http\Request;

class UserSubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptions = UserBundle::with(['user', 'bundle'])->latest()->get();
        return view('admin.subscriptions.index', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $bundles = Bundle::all();
        return view('admin.subscriptions.create', compact('users', 'bundles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'bundle_id' => 'required|exists:bundles,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:active,expired,cancelled',
        ]);

        $userId = $request->user_id;
        $bundleId = $request->bundle_id;
        $startDate = \Carbon\Carbon::parse($request->start_date);
        $endDate = \Carbon\Carbon::parse($request->end_date);
        $status = $request->status;

        $daysToAdd = $startDate->diffInDays($endDate);

        // 🔍 Check for existing active subscription to the same bundle
        $existing = UserBundle::where('user_id', $userId)
            ->where('bundle_id', $bundleId)
            ->whereIn('status', ['active', 'expired'])
            ->latest('end_date')
            ->first();

        if ($existing) {
            // 🛠 Extend the existing subscription
            $existingEnd = \Carbon\Carbon::parse($existing->end_date);
            $now = now();

            $newEnd = $existingEnd->greaterThan($now)
                ? $existingEnd->copy()->addDays($daysToAdd)
                : $now->copy()->addDays($daysToAdd);

            $existing->update([
                'end_date' => $newEnd,
                'status' => 'active',  // You may want to reset status if it was 'expired'
            ]);

            return redirect()->route('user-bundles.index')->with('success', 'Subscription extended successfully.');
        }

        // ➕ No existing subscription, create new
        UserBundle::create([
            'user_id' => $userId,
            'bundle_id' => $bundleId,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'status' => $status,
        ]);

        return redirect()->route('user-bundles.index')->with('success', 'Subscription created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subscription = UserBundle::with(['user', 'bundle'])->findOrFail($id);
        return view('admin.subscriptions.show', compact('subscription'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userSubscription = UserBundle::findOrFail($id);
        $users = User::all();
        $bundles = Bundle::all();
        return view('admin.subscriptions.edit', compact('userSubscription', 'users', 'bundles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'bundle_id' => 'required|exists:bundles,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:active,expired,cancelled',
        ]);

        $userSubscription = UserBundle::findOrFail($id);
        $userSubscription->update($request->all());

        return redirect()->route('user-bundles.index')->with('success', 'Subscription updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userSubscription = UserBundle::findOrFail($id);
        $userSubscription->delete();
        return redirect()->route('user-bundles.index')->with('success', 'Subscription deleted successfully.');
    }
}
