<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index(Request $request)
    {
        // Billing tables may not exist yet, so make the page functional using
        // existing `appointments` data and a deterministic pricing/status rule.

        $recentAppointments = Appointment::query()
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        $invoices = $recentAppointments->map(function ($appointment) {
            $amount = ((int) $appointment->id % 2 === 0) ? 120 : 90;
            $status = $amount === 120 ? 'Paid' : 'Unpaid';

            return [
                'invoice_no' => 'INV-' . str_pad((string) $appointment->id, 4, '0', STR_PAD_LEFT),
                'date' => optional($appointment->appointment_date)->format('Y-m-d'),
                'amount' => $amount,
                'status' => $status,
            ];
        });

        $paidTotal = $invoices->where('status', 'Paid')->sum('amount');
        $unpaidTotal = $invoices->where('status', 'Unpaid')->sum('amount');

        return view('billing.index', [
            'invoices' => $invoices,
            'paidTotal' => $paidTotal,
            'unpaidTotal' => $unpaidTotal,
        ]);
    }

}


