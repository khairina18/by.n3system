@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; height: 80vh;">
    <div style="background-color: #ffe6f0; padding: 30px; border-radius: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 400px;">
        <h2 style="text-align: center; margin-bottom: 20px;">Assign Schedule to Student</h2>

        <form action="{{ route('assign_schedule.store') }}" method="POST" style="width: 100%;">
            @csrf

            <div class="form-group">
                <label for="student_id">Select Student:</label>
                <select name="student_id" id="student_id" required onchange="filterClassCodes()" style="width: 100%; padding: 10px;">
                    <option value="">-- Choose --</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" data-age="{{ $student->age }}">
                            {{ $student->name }} (Age: {{ $student->age }})
                        </option>
                    @endforeach
                </select>
            </div>

            <br>

            <div class="form-group">
                <label for="class_code">Select Class Code:</label>
                <select name="class_code" id="class_code" required style="width: 100%; padding: 10px;">
                    <option value="">-- Choose class --</option>
                    @foreach($classCodes as $code => $details)
                        <option value="{{ $code }}" data-age="{{ $details['age'] }}">
                            {{ $code }} - {{ $details['subject'] }} ({{ $details['type_of_class'] }})
                        </option>
                    @endforeach
                </select>
            </div>

            <br>

            <button type="submit" class="btn btn-add" style="width: 100%;">Assign</button>
        </form>

        <div style="text-align: center; margin-top: 15px;">
            <a href="{{ route('assign_schedule.index') }}" style="text-decoration: underline; color: #333;">Back to Assign Schedules</a>
        </div>
    </div>
</div>

<script>
function filterClassCodes() {
    const studentAge = document.querySelector('#student_id option:checked').dataset.age;
    const options = document.querySelectorAll('#class_code option');

    options.forEach(opt => {
        if (!opt.dataset.age || opt.dataset.age === studentAge) {
            opt.style.display = 'block';
        } else {
            opt.style.display = 'none';
        }
    });
}
</script>
@endsection
