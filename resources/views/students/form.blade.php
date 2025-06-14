<form method="POST" action="{{ isset($student) ? route('students.update', $student->id) : route('students.store') }}" style="width: 100%;">
    @csrf
    @if(isset($student))
        @method('PUT')
    @endif

    <div class="form-group" style="margin-bottom: 15px;">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name', $student->name ?? '') }}" required style="width: 100%; padding: 8px;">
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email', $student->email ?? '') }}" required style="width: 100%; padding: 8px;">
    </div>

    <div class="form-group" style="margin-bottom: 20px;">
        <label for="age">Age:</label>
        <select name="age" required style="width: 100%; padding: 8px;">
            <option value="">-- Select Age Level --</option>
            @foreach(['Standard 3', 'Standard 4', 'Standard 5', 'Standard 6', 'Form 1', 'Form 2', 'Form 3', 'Form 4', 'Form 5'] as $level)
                <option value="{{ $level }}" {{ old('age', $student->age ?? '') == $level ? 'selected' : '' }}>{{ $level }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" style="width: 100%; background-color: #4CAF50; color: white; padding: 10px; border: none; border-radius: 5px;">
        {{ isset($student) ? 'Update' : 'Add' }} Student
    </button>
</form>
