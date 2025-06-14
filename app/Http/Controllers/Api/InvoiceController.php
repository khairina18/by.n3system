<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function parentInvoices(Request $request)
{
    $email = $request->query('email');

    if (!$email) {
        return response()->json(['message' => 'Email is required'], 400);
    }

    $invoices = \App\Models\Invoice::with('student')
        ->whereHas('student', fn($q) => $q->where('parent_email', $email))
        ->latest()
        ->get();

    return response()->json($invoices);
}

}
