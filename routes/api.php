<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\API\SubjectController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\PaymentApiController;
use App\Http\Controllers\Api\StripeController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\PaymentIntentController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->post('/bookings', [BookingController::class, 'store']);
Route::post('/bookings', [BookingController::class, 'store']);
Route::get('/subjects', [SubjectController::class, 'index']);
Route::get('/invoices', [InvoiceController::class, 'parentInvoices']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/students', [StudentController::class, 'store']);
Route::get('/my-classes', [StudentController::class, 'myClasses']);
//Route::post('/create-payment-intent', [StripeController::class, 'create']);
Route::get('/all-schedules', [ScheduleController::class, 'index']);
Route::get('/schedules', [ScheduleController::class, 'filter']);
Route::get('/form-options', [ClassController::class, 'getFormOptions']);
Route::get('/get-fee', [ClassController::class, 'getFee']);
Route::post('/create-payment-intent', [PaymentIntentController::class, 'create']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/payments/{student_id}', [PaymentApiController::class, 'index']);
    Route::post('/payments/pay', [PaymentApiController::class, 'store']);
});
