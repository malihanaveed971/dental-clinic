<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Invoice;
use App\Models\InvoiceLineItem;
use App\Models\Prescription;
use App\Models\Xray;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DentistPanelController extends Controller
{
    public function showPanel($appointmentId)
    {
        $appointment = Appointment::with('dentist')->findOrFail($appointmentId);

        // Ensure the appointment contains a patient name and can be used to generate billing.
        if (empty($appointment->patient_name)) {
            abort(422, 'This appointment is missing a patient name.');
        }


        $prescriptions = Prescription::query()
            ->where('appointment_id', $appointmentId)
            ->orderByDesc('created_at')
            ->get();

        $xrays = Xray::query()
            ->where('appointment_id', $appointmentId)
            ->orderByDesc('created_at')
            ->get();

        $invoice = Invoice::query()->where('appointment_id', $appointmentId)->first();

        return view('dentists.panel', compact('appointment', 'prescriptions', 'xrays', 'invoice'));
    }

    public function storePrescription(Request $request, $appointmentId)
    {
        $validated = $request->validate([
            'medication_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $quantity = (int) $validated['quantity'];
        $unitPrice = (float) $validated['unit_price'];
        $lineTotal = $quantity * $unitPrice;

        Prescription::create([
            'appointment_id' => $appointmentId,
            'medication_name' => $validated['medication_name'],
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'line_total' => $lineTotal,
        ]);

        return back()->with('success', 'Medication added.');
    }

    public function storeXray(Request $request, $appointmentId)
    {
        $validated = $request->validate([
            'xray_type' => 'required|string|max:255',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $unitPrice = (float) $validated['unit_price'];
        $lineTotal = $unitPrice; // one xray entry = one charge

        Xray::create([
            'appointment_id' => $appointmentId,
            'xray_type' => $validated['xray_type'],
            'unit_price' => $unitPrice,
            'line_total' => $lineTotal,
        ]);

        return back()->with('success', 'X-ray added.');
    }

    public function generateInvoice(Request $request, $appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);

        $medicationsTotal = Prescription::query()
            ->where('appointment_id', $appointmentId)
            ->sum('line_total');

        $xraysTotal = Xray::query()
            ->where('appointment_id', $appointmentId)
            ->sum('line_total');

        $grandTotal = (float) $medicationsTotal + (float) $xraysTotal;

        $invoiceNo = 'INV-' . strtoupper(Str::random(10));

        $invoice = Invoice::query()->create([
            'appointment_id' => $appointmentId,
            'patient_name' => $appointment->patient_name,
            'medications_total' => $medicationsTotal,
            'xrays_total' => $xraysTotal,
            'grand_total' => $grandTotal,
            'invoice_no' => $invoiceNo,
            'status' => 'Unpaid',
        ]);

        // Create line items for transparency
        Prescription::query()
            ->where('appointment_id', $appointmentId)
            ->get()
            ->each(function (Prescription $p) use ($invoice) {
                InvoiceLineItem::create([
                    'invoice_id' => $invoice->id,
                    'type' => 'Medication',
                    'description' => $p->medication_name,
                    'quantity' => $p->quantity,
                    'unit_price' => $p->unit_price,
                    'line_total' => $p->line_total,
                ]);
            });

        Xray::query()
            ->where('appointment_id', $appointmentId)
            ->get()
            ->each(function (Xray $x) use ($invoice) {
                InvoiceLineItem::create([
                    'invoice_id' => $invoice->id,
                    'type' => 'Xray',
                    'description' => $x->xray_type,
                    'quantity' => 1,
                    'unit_price' => $x->unit_price,
                    'line_total' => $x->line_total,
                ]);
            });

        return redirect()->route('dentist.panel', ['appointmentId' => $appointmentId])
            ->with('success', 'Invoice generated.');
    }
}

