<?php

namespace App\Http\Controllers\Admin;

use App\Exports\MpesaPaymentsExport;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Bundle;
use App\Models\MpesaPayment;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MpesaPaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = MpesaPayment::with(['user', 'bundle', 'booking'])->latest()->get();
        return view('admin.mpesaPayments.index', compact('payments'));
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
        $bookings = Booking::all();
        return view('admin.mpesaPayments.create', compact('users', 'bundles', 'bookings'));
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
            'booking_id' => 'nullable|exists:bookings,id',
            'user_id' => 'nullable|exists:users,id',
            'bundle_id' => 'nullable|exists:bundles,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'payment_for' => 'required|string',
            'amount' => 'required|numeric',
            'mpesa_receipt_number' => 'required|string',
            'transaction_date' => 'nullable|date',
            'phone_number' => 'nullable|string',
            'status' => 'required|string',
        ]);

        MpesaPayment::create($request->all());

        return redirect()->route('payments.index')->with('success', 'Payment recorded successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = MpesaPayment::with(['user', 'bundle', 'booking'])->findOrFail($id);
        return view('admin.mpesaPayments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment = MpesaPayment::findOrFail($id);
        $users = User::all();
        $bundles = Bundle::all();
        $bookings = Booking::all();
        return view('admin.mpesaPayments.edit', compact('payment', 'users', 'bundles', 'bookings'));
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
            'booking_id' => 'nullable|exists:bookings,id',
            'user_id' => 'nullable|exists:users,id',
            'bundle_id' => 'nullable|exists:bundles,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'payment_for' => 'required|string',
            'amount' => 'required|numeric',
            'mpesa_receipt_number' => 'required|string',
            'transaction_date' => 'nullable|date',
            'phone_number' => 'nullable|string',
            'status' => 'required|string',
        ]);

        $payment = MpesaPayment::findOrFail($id);
        $payment->update($request->all());

        return redirect()->route('payments.index')->with('success', 'Payment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = MpesaPayment::findOrFail($id);
        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully.');
    }

    public function export()
    {
        return Excel::download(new MpesaPaymentsExport, 'mpesa_payments.xlsx');
    }
}
