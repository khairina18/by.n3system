<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Invoice;

class InvoicePaidMail extends Mailable
{
    use Queueable, SerializesModels;
    public $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invoice Paid Mail',
        );
    }
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.invoice-paid-mail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        return $this->subject('By.N3 Payment Invoice')
            ->markdown('emails.invoice_paid')
            ->with([
                'invoice' => $this->invoice,
                'student' => $this->invoice->student,
            ]);
    }
}
