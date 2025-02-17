@extends('layouts.Dash')

@section('content')
<div class="container">
    <h1 class="mb-4">Enrollments</h1>

    <!-- Add Enrollment Button (Triggers Modal) -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addEnrollmentModal">
        Add Enrollment
    </button>

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Student</th>
                        <th>Subject</th>
                        <th>Enrollment Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($enrollments as $enrollment)
                        <tr>
                            <td>{{ $enrollment->id }}</td>
                            <td>{{ $enrollment->student->name }}</td>
                            <td>{{ $enrollment->subject->name }}</td>
                            <td>{{ $enrollment->enrollment_date }}</td>
                            <td>
                                <!-- Edit Button (Triggers Modal) -->
                                <button class="btn btn-warning btn-sm edit-btn" 
                                    data-id="{{ $enrollment->id }}"
                                    data-student="{{ $enrollment->student->id }}"
                                    data-subject="{{ $enrollment->subject->id }}"
                                    data-enrollment_date="{{ $enrollment->enrollment_date }}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editEnrollmentModal">
                                    Edit
                                </button>

                                <!-- Delete Form -->
                                <form action="{{ route('enrollments.destroy', $enrollment->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this enrollment?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Enrollment Modal -->
<div class="modal fade" id="addEnrollmentModal" tabindex="-1" aria-labelledby="addEnrollmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEnrollmentModalLabel">Add Enrollment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('enrollments.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="student_id" class="form-label">Search Student</label>
                        <select class="form-select select2" id="student_id" name="student_id" required>
                            <option value="">Search and select a student...</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->id }} - {{ $student->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="subject_id" class="form-label">Search Subject</label>
                        <select class="form-select select2" id="subject_id" name="subject_id" required>
                            <option value="">Search and select a subject...</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->id }} - {{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="enrollment_date" class="form-label">Enrollment Date</label>
                        <input type="date" class="form-control" name="enrollment_date" required>
                    </div>

                    <button type="submit" class="btn btn-success">Add Enrollment</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Enrollment Modal -->
<div class="modal fade" id="editEnrollmentModal" tabindex="-1" aria-labelledby="editEnrollmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEnrollmentModalLabel">Edit Enrollment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editEnrollmentForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="edit_id">
                    
                    <div class="mb-3">
                        <label for="edit_student_id" class="form-label">Search Student</label>
                        <select class="form-select select2" name="student_id" id="edit_student_id" required>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->id }} - {{ $student->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_subject_id" class="form-label">Search Subject</label>
                        <select class="form-select select2" name="subject_id" id="edit_subject_id" required>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->id }} - {{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_enrollment_date" class="form-label">Enrollment Date</label>
                        <input type="date" class="form-control" name="enrollment_date" id="edit_enrollment_date" required>
                    </div>

                    <button type="submit" class="btn btn-warning">Update Enrollment</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Handling Edit Modal -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const editButtons = document.querySelectorAll(".edit-btn");

    editButtons.forEach(button => {
        button.addEventListener("click", function() {
            const id = this.getAttribute("data-id");
            const student_id = this.getAttribute("data-student");
            const subject_id = this.getAttribute("data-subject");
            const enrollment_date = this.getAttribute("data-enrollment_date");

            document.getElementById("edit_id").value = id;
            document.getElementById("edit_student_id").value = student_id;
            document.getElementById("edit_subject_id").value = subject_id;
            document.getElementById("edit_enrollment_date").value = enrollment_date;

            document.getElementById("editEnrollmentForm").setAttribute("action", `/enrollments/${id}`);
        });
    });
});

// Enable Select2 for better search
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Type to search...",
        allowClear: true
    });
});
</script>

<!-- Include Select2 CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

@endsection
