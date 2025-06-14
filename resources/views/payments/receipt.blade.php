<!DOCTYPE html>
<html>
<head>
    <title>Payment Receipt</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .header { text-align: center; margin-bottom: 30px; }
        .box { border: 1px solid #ccc; padding: 20px; border-radius: 8px; width: 500px; margin: auto; }
        .label { font-weight: bold; }
        .row { margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Tuition Payment Receipt</h2>
    </div>

    <div class="box">
        <div class="row"><span class="label">Student:</span> {{ $payment->student->name }}</div>
        <div class="row"><span class="label">Month:</span> {{ $payment->month }}</div>
        <div class="row"><span class="label">Amount Paid:</span> RM {{ number_format($payment->amount, 2) }}</div>
        <div class="row"><span class="label">Status:</span> {{ $payment->status }}</div>
        <div class="row"><span class="label">Date Paid:</span> {{ $payment->date_paid }}</div>
        <div class="row" style="margin-top: 20px;">Thank you for your payment!</div>
    </div>
</body>
</html>
