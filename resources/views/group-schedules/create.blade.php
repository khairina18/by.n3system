@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; height: 80vh;">
    <div class="card">
        <h2 style="text-align: center; margin-bottom: 20px;">Add Group Schedule</h2>

        @include('group-schedules.form')

        <div style="text-align: center; margin-top: 15px;">
            <a href="{{ route('group-schedules.index') }}" class="back-link">Back to Group Schedules</a>
        </div>
    </div>
</div>
@endsection
