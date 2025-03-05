@extends('layouts.Dash')
@section('title', 'Enrollment View')
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

                                <!-- Delete Button (Triggers Modal) -->
                                <button class="btn btn-danger btn-sm delete-btn" 
                                    data-id="{{ $enrollment->id }}"
                                    data-student="{{ $enrollment->student->name }}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteEnrollmentModal">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('modals.addEnrollmentModal') <!-- Add Modal -->
@include('modals.editEnrollmentModal') <!-- Edit Modal -->
@include('modals.deletemodal')

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

    const deleteButtons = document.querySelectorAll(".delete-btn");
    deleteButtons.forEach(button => {
        button.addEventListener("click", function() {
            const enrollmentId = this.getAttribute("data-id");
            const studentName = this.getAttribute("data-student");
            document.getElementById("studentName").innerText = studentName;
            document.getElementById("deleteEnrollmentForm").setAttribute("action", `/enrollments/${enrollmentId}`);
        });
    });

    // Enable Select2 for better search
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Type to search...",
            allowClear: true
        });
    });
});
</script>


@endsection
