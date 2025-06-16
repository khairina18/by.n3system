<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AssignScheduleController;
use App\Http\Controllers\GroupScheduleController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\InvoiceController;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes (only call this once)
Auth::routes(['register' => false]);

// All protected routes (require authentication)
Route::middleware(['auth'])->group(function () {
    // Dashboard/Home route
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    //report route
    Route::get('/reports/students', [ReportController::class, 'studentReport'])->name('reports.students');
    Route::get('/reports/classes', [ReportController::class, 'classReport'])->name('reports.classes');
    Route::get('/reports/payments', [ReportController::class, 'paymentReport'])->name('reports.payments');
    Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
Route::get('/invoices/{invoice}/download', [InvoiceController::class, 'download'])->name('invoices.download');
    // Resource routes
    
    Route::resource('students', StudentController::class);
    Route::resource('staff', StaffController::class);
    Route::resource('classes', ClassController::class);
    Route::resource('group-schedules', GroupScheduleController::class);
    Route::resource('schedules', ScheduleController::class);
    Route::resource('payments', PaymentController::class);

    Route::get('/class/{id}/schedules', function($id) {
        $class = \App\Models\Classes::with('schedules.staff')->findOrFail($id);
        return $class->schedules;
    });

    Route::get('/payments/{id}/receipt', [PaymentController::class, 'receipt'])->name('payments.receipt');

    Route::prefix('assign_schedule')->group(function () {
        Route::get('/', [AssignScheduleController::class, 'index'])->name('assign_schedule.index');
        Route::get('/create', [AssignScheduleController::class, 'create'])->name('assign_schedule.create');
        Route::post('/store', [AssignScheduleController::class, 'store'])->name('assign_schedule.store');
    });


});