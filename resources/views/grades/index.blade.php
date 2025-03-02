@extends('layouts.Dash')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-primary fw-bold">Grades</h1>

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
                                    <span class="badge {{ $enrollment->grades->isNotEmpty() ? ($enrollment->grades->first()->grade >= 3.0 ? 'bg-success' : 'bg-danger') : 'bg-secondary' }}">
                                        {{ $enrollment->grades->isNotEmpty() ? $enrollment->grades->first()->grade : 'N/A' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editGradeModal{{ $enrollment->id }}">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </button>

                                    @if ($enrollment->grades->isNotEmpty())
                                    <form action="{{ route('grades.destroy', $enrollment->grades->first()->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to remove this grade?');">
                                            <i class="bi bi-trash"></i> Remove
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>

                            <!-- Edit Grade Modal -->
                            <div class="modal fade" id="editGradeModal{{ $enrollment->id }}" tabindex="-1" aria-labelledby="editGradeModalLabel{{ $enrollment->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-warning text-dark">
                                            <h5 class="modal-title fw-bold" id="editGradeModalLabel{{ $enrollment->id }}">
                                                Edit Grade for {{ $enrollment->student->name }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('grades.update', $enrollment->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="grade" class="form-label">Grade</label>
                                                    <select name="grade" id="grade" class="form-select">
                                                        @php
                                                            $gradeOptions = [1.0, 1.25, 1.50, 1.75, 2.0, 2.25, 2.50, 2.75, 3.0, 3.25, 3.50, 3.75, 4.0, 4.25, 4.50, 4.75, 5.0];
                                                        @endphp
                                                        @foreach ($gradeOptions as $grade)
                                                            <option value="{{ $grade }}" {{ $enrollment->grades->isNotEmpty() && $enrollment->grades->first()->grade == $grade ? 'selected' : '' }}>
                                                                {{ $grade }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div> 
        </div>
    </div>
</div>
@endsection
