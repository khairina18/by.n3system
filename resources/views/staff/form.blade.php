<form method="POST" action="{{ isset($staff) ? route('staff.update', $staff->id) : route('staff.store') }}" style="width: 100%;">
    @csrf
    @if(isset($student))
        @method('PUT')
    @endif

    <div class="form-group" style="margin-bottom: 15px;">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name', $staff->name ?? '') }}" required style="width: 100%; padding: 8px;">
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email', $staff->email ?? '') }}" required style="width: 100%; padding: 8px;">
    </div>

    <button type="submit" style="width: 100%; background-color: #4CAF50; color: white; padding: 10px; border: none; border-radius: 5px;">
        {{ isset($staff) ? 'Update' : 'Add' }} Staff
    </button>
</form>
