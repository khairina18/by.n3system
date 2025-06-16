<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\PaymentApiController;
use App\Http\Controllers\Api\PaymentIntentController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\API\SubjectController;

// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Stripe Payment Intent (Live Payment)
Route::post('/create-payment-intent', [PaymentIntentController::class, 'create']);

// Student registration after payment success
Route::post('/students', [StudentController::class, 'store']);

// Class & Fee info
Route::get('/form-options', [ClassController::class, 'getFormOptions']);
Route::get('/get-fee', [ClassController::class, 'getFee']);

// Schedule filter (used in app)
Route::get('/schedules', [ScheduleController::class, 'filter']);
Route::get('/all-schedules', [ScheduleController::class, 'index']); // optional for admin use

// Invoice history (parent)
Route::get('/invoices', [InvoiceController::class, 'parentInvoices']);

// Protected Routes – require token
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::get('/payments/{student_id}', [PaymentApiController::class, 'index']);
    Route::post('/payments/pay', [PaymentApiController::class, 'store']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});