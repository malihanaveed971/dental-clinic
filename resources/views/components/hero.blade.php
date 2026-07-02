<form action="/appointment/request" method="POST">
    @csrf
    <input type="text" name="patient_name" placeholder="Full Name" required>
    
    <select name="dentist_id" required>
        <option value="">Select a Dentist</option>
        @foreach($dentists as $dentist)
            <option value="{{ $dentist->id }}">{{ $dentist->Dentist_Name }}</option>
        @endforeach
    </select>

    <input type="datetime-local" name="appointment_time" required>
    <button type="submit">Book Appointment</button>
</form>