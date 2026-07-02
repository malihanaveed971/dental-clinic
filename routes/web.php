<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DentistController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\DentistPanelController;

// Public Routes
Route::get('/', [WelcomeController::class, 'index']);
Route::get('/dentists', [DentistController::class, 'index']);

// Dentist Control Panel landing (as requested)
Route::get('/dentist-panel', function () {
    return redirect()->to('/dentists/panel/1');
});

// Dentist Control Panel
Route::get('/dentists/panel/{appointmentId}', [DentistPanelController::class, 'showPanel'])->name('dentist.panel');
Route::post('/dentists/panel/{appointmentId}/prescription', [DentistPanelController::class, 'storePrescription'])->name('dentist.panel.prescription');
Route::post('/dentists/panel/{appointmentId}/xray', [DentistPanelController::class, 'storeXray'])->name('dentist.panel.xray');
Route::post('/dentists/panel/{appointmentId}/generate', [DentistPanelController::class, 'generateInvoice'])->name('dentist.panel.generate');

// Appointment Routes
Route::post('/appointment/request', [AppointmentController::class, 'requestAppointment']);
Route::get('/appointments', [AppointmentController::class, 'index']);

// Dashboard & Profile
Route::get('/patients', [PatientController::class, 'dashboard'])->name('patient.dashboard');

// Billing Routes
Route::get('/billing', [BillingController::class, 'index'])->name('patient.billing');

