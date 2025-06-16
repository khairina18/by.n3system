@component('mail::message')
# Your Tuition Invoice

**Student:** {{ $invoice->student->name }}  
**Subject:** {{ $invoice->student->subject }}  
**Class Type:** {{ $invoice->student->type }}  
**Schedule:** {{ $invoice->student->schedule }}  
**Amount Paid:** RM {{ $invoice->amount }}  
**Date:** {{ $invoice->created_at->format('d M Y') }}

Thanks,<br>
By.N3 Tuition Admin
@endcomponent
