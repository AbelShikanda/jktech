<?php

namespace App\Exports;

use App\Models\MpesaPayment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MpesaPaymentsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return MpesaPayment::with(['user', 'bundle', 'booking'])->latest()->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'User',
            'Bundle',
            'Payment For',
            'Amount',
            'Receipt',
            'Status',
            'Phone',
            'Transaction Date',
            'Created At'
        ];
    }

    public function map($payment): array
    {
        return [
            $payment->id,
            optional($payment->user)->first_name ?? 'N/A',
            optional($payment->bundle)->name ?? 'N/A',
            $payment->payment_for,
            $payment->amount,
            $payment->mpesa_receipt_number,
            $payment->status,
            $payment->phone_number,
            optional($payment->transaction_date)->format('Y-m-d H:i'),
            $payment->created_at->format('Y-m-d H:i')
        ];
    }
}
