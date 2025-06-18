<form method="POST" action="{{ isset($schedule) ? route('schedules.update', $schedule->id) : route('schedules.store') }}" style="width: 100%;">
    @csrf
    @if(isset($schedule)) @method('PUT') @endif

    <div class="form-group"  style="margin-bottom: 15px;">
        <label for="day">Day:</label>
        <input type="day" id="day" name="day" value="{{ old('day', $schedule->day ?? '') }}" readonly required style="width: 100%; padding: 8px;">
    </div>
    <div class="form-group"  style="margin-bottom: 15px;">
        <label>Start Time:</label>
        <input type="time" id="time" name="time" value="{{ old('time', $schedule->time ?? '') }}" required>
    </div>
     <div class="form-group"  style="margin-bottom: 15px;">
        <label>End Time:</label>
        <input type="time" id="time" name="time" value="{{ old('time', $schedule->end_time ?? '') }}" required>
    </div>
    <div class="form-group"  style="margin-bottom: 15px;">
        <label> Class Code:</label>
       <select name="class_id" required>
            @foreach ($classes as $class)
                <option value="{{ $class->id }}">
                    {{ $class->code }} - {{ $class->subject }}
                </option>
            @endforeach
        </select>

    </div>
    <div class="form-group"  style="margin-bottom: 15px;">
        <label>Assign Tutor:</label>
        <select name="staff_id" required style="width: 100%; padding: 8px;">
            <option value="">-- Select Tutor --</option>
            @foreach($staff as $tutor)
                <option value="{{ $tutor->id }}" {{ isset($schedule) && $schedule->staff_id == $tutor->id ? 'selected' : '' }}>
                    {{ $tutor->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group" style="margin-bottom: 15px;">
    <label>
        <input type="checkbox" name="repeat_weekly" value="1">
        Repeat this schedule for the next 4 weeks
    </label>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dateInput = document.getElementById('date');
            const dayInput = document.getElementById('day');

            dateInput.addEventListener('change', function () {
                const date = new Date(this.value);
                const options = { weekday: 'long' };
                const dayName = new Intl.DateTimeFormat('en-US', options).format(date);
                dayInput.value = dayName;
            });
        });
    </script>

    <button type="submit" style="width: 100%; background-color: #4CAF50; color: white; padding: 10px; border: none; border-radius: 5px;">
        {{ isset($schedule) ? 'Update' : 'Add' }} Schedule
    </button>
</form>
