@extends('layouts.Dash')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Enrollment</h1>
    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('enrollments.update', $enrollment->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="student_id" class="form-label">Student</label>
                    <select name="student_id" id="student_id" class="form-control" required>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}" {{ $enrollment->student_id == $student->id ? 'selected' : '' }}>{{ $student->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="subject_id" class="form-label">Subject</label>
                    <select name="subject_id" id="subject_id" class="form-control" required>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ $enrollment->subject_id == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="enrollment_date" class="form-label">Enrollment Date</label>
                    <input type="date" name="enrollment_date" id="enrollment_date" class="form-control" value="{{ $enrollment->enrollment_date }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection