@extends('layouts.app')
@section('content')
<div style="display: flex; justify-content: center; align-items: center; height: 80vh;">
    <div style="background-color: #ffe6f0; padding: 30px; border-radius: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 400px;">
        <h2 style="text-align: center; margin-bottom: 20px;">Edit Schedule</h2>

        @include('schedules.form')

        <div style="text-align: center; margin-top: 15px;">
            <a href="{{ route('schedules.index') }}" style="text-decoration: underline; color: #333;">Back to Schedule</a>
        </div>
    </div>
</div>
@endsection
