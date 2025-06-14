<form method="POST" action="{{ isset($schedule) ? route('group-schedules.update', $schedule->id) : route('group-schedules.store') }}">
    @csrf
    @if(isset($schedule)) @method('PUT') @endif

    <div class="form-group" style="margin-bottom: 15px;">
        <label for="day">Day of Week:</label>
        <select name="day" id="day" required>
            @foreach (['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
                <option value="{{ $day }}" {{ old('day', $schedule->day ?? '') == $day ? 'selected' : '' }}>
                    {{ $day }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label>Start Time:</label>
        <input type="time" name="time" value="{{ old('time', $schedule->time ?? '') }}" required>
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label>End Time:</label>
        <input type="time" name="end_time" value="{{ old('end_time', $schedule->end_time ?? '') }}" required>
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label>Class:</label>
        <select name="class_id" required>
            @foreach ($classes as $class)
                <option value="{{ $class->id }}" {{ old('class_id', $schedule->class_id ?? '') == $class->id ? 'selected' : '' }}>
                    {{ $class->code }} - {{ $class->subject }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label>Tutor:</label>
        <select name="staff_id" required>
            <option value="">-- Select Tutor --</option>
            @foreach ($staff as $tutor)
                <option value="{{ $tutor->id }}" {{ old('staff_id', $schedule->staff_id ?? '') == $tutor->id ? 'selected' : '' }}>
                    {{ $tutor->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-add" style="width: 100%;">{{ isset($schedule) ? 'Update' : 'Add' }} Group Schedule</button>
</form>
