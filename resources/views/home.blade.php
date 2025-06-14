@extends('layouts.app')

@section('content')
<h2>Welcome to the Admin Dashboard</h2>

    <div style="display: flex; gap: 20px; margin-bottom: 30px;">
        <div class="card" style="background-color:rgb(197, 244, 195);">
            <h3>Total Students</h3>
            <p style="font-size: 2rem; font-weight: bold;">{{ $totalStudents }}</p>
        </div>

        <div class="card" style="background-color: #f8bbd0;">
            <h3>Total Classes</h3>
            <p style="font-size: 2rem; font-weight: bold;">{{ $totalClasses }}</p>
        </div>
    </div>

    <!-- Filter -->
   <form method="GET" action="{{ route('home') }}" style="display: flex; gap: 20px; align-items: center; margin-bottom: 20px; flex-wrap: wrap;">
    <div>
        <label for="date"><strong>Filter by Date:</strong></label>
        <input type="date" name="date" id="date" value="{{ $selectedDate }}">
    </div>

    <div>
        <label for="session"><strong>Session Type:</strong></label>
        <select name="session" id="session">
            <option value="group" {{ request('session') == 'group' ? 'selected' : '' }}>Group</option>
            <option value="1to1" {{ request('session') == '1to1' ? 'selected' : '' }}>One-to-One</option>
        </select>
    </div>

    <div>
        <button type="submit" class="btn-filter">Filter</button>
    </div>
</form>

    <!-- Timetable -->
    <section>
        @if ($sessionType === 'group')
        <h2>Today's Group Session ({{ $today }})</h2>
        <table>
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Class Code</th>
                    <th>Subject</th>
                    <th>Tutor</th>
                </tr>
            </thead>
            <tbody>
                @forelse($groupSchedule as $session)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($session->time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($session->end_time)->format('h:i A') }}</td>
                        <td>{{ $session->class->code }}</td>
                        <td>{{ $session->class->subject }}</td>
                        <td>{{ $session->staff->name }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4">No group classes today</td></tr>
                @endforelse
            </tbody>
        </table>
    @else
        <h2>One-to-One Schedule for {{ \Carbon\Carbon::parse($selectedDate)->format('F j, Y') }}</h2>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Class</th>
                    <th>Tutor</th>
                </tr>
            </thead>
            <tbody>
                @forelse($timetable as $item)
                    <tr>
                        <td>{{ $item->date }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($item->end_time)->format('h:i A') }}</td>
                        <td>{{ $item->class->code }}</td>
                        <td>{{ $item->staff->name }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4">No one-to-one bookings</td></tr>
                @endforelse
            </tbody>
        </table>
    @endif
    </section>
@endsection
