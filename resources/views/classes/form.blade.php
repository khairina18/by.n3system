<form method="POST" action="{{ isset($class) ? route('classes.update', $class->id) : route('classes.store') }}" style="width: 100%;">
    @csrf
    @if(isset($class))
        @method('PUT')
    @endif

    <div class="form-group">
    <label for="code">Class Code</label>
    <select name="code" id="code" required onchange="updateFieldsFromCode()" style="width: 100%; padding: 10px;">
        <option value="">-- Select Code --</option>
        @foreach ($classCodeOptions as $code => $details)
            <option value="{{ $code }}" {{ (old('code', $class->code ?? '') == $code) ? 'selected' : '' }}>
                {{ $code }}
            </option>
        @endforeach
    </select>
    </div>

    <div class="form-group">
    <label for="subject">Subject</label>
        <input type="text" id="subject" name="subject" value="{{ old('subject', $class->subject ?? '') }}" readonly>
    </div>

    <div class="form-group">
        <label for="age">Age Group</label>
        <input type="text" id="age" name="age" value="{{ old('age', $class->age ?? '') }}" readonly>
    </div>

    <div class="form-group">
        <label for="type_of_class">Type of Class</label>
        <input type="text" id="type_of_class" name="type_of_class" value="{{ old('type_of_class', $class->type_of_class ?? '') }}" readonly>
    </div>

    <div class="form-group">
        <label>Fee per Hour (RM):</label>
        <input type="number" name="fee_per_hour" step="0.01" 
            value="{{ old('fee_per_hour', $class->fee_per_hour ?? '') }}" 
            class="form-control" required>
    </div>

    <button type="submit" style="width: 100%; background-color: #4CAF50; color: white; padding: 10px; border: none; border-radius: 5px;">
        {{ isset($class) ? 'Update' : 'Add' }} Class
    </button>
</form>
    <script>
        const classCodeMap = @json($classCodeOptions);

        function updateFieldsFromCode() {
            const selectedCode = document.getElementById('code').value;
            if (classCodeMap[selectedCode]) {
                document.getElementById('subject').value = classCodeMap[selectedCode]['subject'];
                document.getElementById('age').value = classCodeMap[selectedCode]['age'];
                document.getElementById('type_of_class').value = classCodeMap[selectedCode]['type_of_class'];
                document.querySelector('[name="fee_per_hour"]').value = classCodeMap[selectedCode]['fee_per_hour'];
            } else {
                document.getElementById('subject').value = '';
                document.getElementById('age').value = '';
                document.getElementById('type_of_class').value = '';
                document.querySelector('[name="fee_per_hour"]').value = classCodeMap[selectedCode]['fee_per_hour'];
            }
        }
    </script>