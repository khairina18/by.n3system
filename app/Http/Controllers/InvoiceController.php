<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // if using dompdf

class InvoiceController extends Controller
{
    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }

    public function download(Invoice $invoice)
    {
        $pdf = Pdf::loadView('invoices.pdf', compact('invoice'));
        return $pdf->download('invoice-' . $invoice->id . '.pdf');
    }
}

