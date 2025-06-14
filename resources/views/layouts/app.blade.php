<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.N3 Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
        <div class="sidebar">
            <h2>By.N3 Admin</h2>
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home')?'active':'' }}">Dashboard</a>
            <a href="{{ route('students.index') }}" class="{{ request()->routeIs('students.*')?'active':'' }}">Manage Students</a>
            <a href="{{ route('staff.index') }}" class="{{ request()->routeIs('staff.*')?'active':'' }}">Manage Staff</a>
            <a href="{{ route('classes.index') }}" class="{{ request()->routeIs('classes.*')?'active':'' }}">Manage Classes</a>
            
            <!-- Schedule Dropdown -->
            <div class="dropdown {{ request()->routeIs('group-schedules.*') || request()->routeIs('schedules.*') ? 'active' : '' }}" id="scheduleDropdown">
                <button class="dropdown-btn" onclick="toggleDropdown('scheduleDropdown')">Schedules ▼</button>
                <div class="dropdown-content">
                    <a href="{{ route('group-schedules.index') }}" class="{{ request()->routeIs('group-schedules.*') ? 'active' : '' }}">Group Schedule</a>
                    <a href="{{ route('schedules.index') }}" class="{{ request()->routeIs('schedules.*') ? 'active' : '' }}">One-To-One Schedule</a>
                </div>
            </div>
            
            
            <a href="{{ route('payments.index') }}" class="{{ request()->routeIs('payments.*')?'active':'' }}">Manage Payments</a>
            
            <!-- Report Dropdown -->
            <div class="dropdown {{ request()->routeIs('reports.*') ? 'active' : '' }}" id="reportDropdown">
                <button class="dropdown-btn" onclick="toggleDropdown('reportDropdown')">Reports ▼</button>
                <div class="dropdown-content">
                    <a href="{{ route('reports.students') }}" class="{{ request()->routeIs('reports.students') ? 'active' : '' }}">Student Report</a>
                    <a href="{{ route('reports.classes') }}" class="{{ request()->routeIs('reports.classes') ? 'active' : '' }}">Class Report</a>
                    <a href="{{ route('reports.payments') }}" class="{{ request()->routeIs('reports.payments') ? 'active' : '' }}">Payment Report</a>
                </div>
            </div>

            <!-- Logout -->
            <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
        
        <div class="main-content">
            @yield('content')
        </div>
    </div>    
    <script>
        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            dropdown.classList.toggle('active');
        }
    </script>

</body>
</html>
