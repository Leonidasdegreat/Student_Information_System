@extends('layouts.Dash')

@section('content')
<div class="container">
    <h1 class="mb-4">Create Enrollment</h1>
    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('enrollments.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="student_id" class="form-label">Student</label>
                    <select name="student_id" id="student_id" class="form-control" required>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="subject_id" class="form-label">Subject</label>
                    <select name="subject_id" id="subject_id" class="form-control" required>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="enrollment_date" class="form-label">Enrollment Date</label>
                    <input type="date" name="enrollment_date" id="enrollment_date" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection