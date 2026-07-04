<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index(Request $request)
    {
        // Load real invoices from the database
        $realInvoices = \App\Models\Invoice::with('appointment')
            ->orderByDesc('created_at')
            ->limit(20)
            ->get();

        $invoices = $realInvoices->map(function ($invoice) {
            return [
                'invoice_no' => $invoice->invoice_no,
                'date' => $invoice->created_at ? $invoice->created_at->format('Y-m-d') : '—',
                'amount' => $invoice->grand_total,
                'status' => $invoice->status,
            ];
        });

        $paidTotal = $realInvoices->where('status', 'Paid')->sum('grand_total');
        $unpaidTotal = $realInvoices->where('status', 'Unpaid')->sum('grand_total');

        return view('billing.index', [
            'invoices' => $invoices,
            'paidTotal' => $paidTotal,
            'unpaidTotal' => $unpaidTotal,
        ]);
    }

}


