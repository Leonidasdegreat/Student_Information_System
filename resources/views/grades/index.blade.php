@extends('layouts.Dash')
@section('title', 'Grades Dashboard')

@section('content')
<div class="container mt-4">

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <!-- Filter by Subject -->
            <form action="{{ route('grades.index') }}" method="GET" class="mb-4">
                <div class="row g-2 align-items-center">
                    <div class="col-md-4">
                        <label for="subject_id" class="form-label fw-semibold">Filter by Subject:</label>
                        <select name="subject_id" id="subject_id" class="form-select" onchange="this.form.submit()">
                            <option value="">All Subjects</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ $selectedSubject == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>

            <!-- Enrolled Students Table -->
            <div class="table-responsive">
                @if($enrollments->isNotEmpty())
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Student</th>
                                <th>Subject</th>
                                <th>Grade</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($enrollments as $enrollment)
                                <tr>
                                    <td>{{ $enrollment->student->name }}</td>
                                    <td>{{ $enrollment->subject->name }}</td>
                                    <td>
                                        <span class="badge {{ $enrollment->grades->isNotEmpty() ? ($enrollment->grades->first()->grade >= 3.0 ? 'bg-dangers' : 'bg-success') : 'bg-secondary' }}">
                                            {{ $enrollment->grades->isNotEmpty() ? $enrollment->grades->first()->grade : 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editGradeModal{{ $enrollment->id }}">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </button>

                                        @if ($enrollment->grades->isNotEmpty())
                                        <!-- Delete Grade Button with Modal Trigger -->
                                        <button class="btn btn-danger btn-sm delete-grade-btn" 
                                                data-id="{{ $enrollment->grades->first()->id }}" 
                                                data-student="{{ $enrollment->student->name }}" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteGradeModal">
                                            <i class="bi bi-trash"></i> Remove
                                        </button>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Include Edit Grade Modal for Each Enrollment -->
                                @include('modals.editgrade', ['enrollment' => $enrollment])
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center text-muted">No enrollments found.</p>
                @endif
            </div> 
        </div>
    </div>
</div>

@include('modals.deletemodal')

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteGradeButtons = document.querySelectorAll(".delete-grade-btn");
        const gradeStudentName = document.getElementById("gradeStudentName");
        const deleteGradeForm = document.getElementById("deleteGradeForm");

        deleteGradeButtons.forEach(button => {
            button.addEventListener("click", function () {
                const gradeId = this.getAttribute("data-id");
                const studentName = this.getAttribute("data-student");

                gradeStudentName.textContent = studentName;
                deleteGradeForm.action = `/grades/${gradeId}`;
            });
        });
    });
</script>

@endsection
