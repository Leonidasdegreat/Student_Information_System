@extends('layouts.student')
@section('title', 'Students Dashboard')
@section('content_student')

{{-- Include Bootstrap --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<div class="container mt-4">
    <h1 class="text-center mb-4">Student Dashboard</h1>

    {{-- Personal Information Section --}}
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body">
            <h4 class="mb-3">Personal Information</h4>
            <div class="row">
                @foreach (['Name' => $student->name, 'Email' => $student->email, 'Address' => $student->address, 'Age' => $student->age] as $label => $value)
                    <div class="col-md-6 mb-2">
                        <strong>{{ $label }}:</strong> {{ $value }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Enrollments & Grades Section --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h4 class="mb-3">Enrollments and Grades</h4>
            @if ($enrollments->isEmpty())
                <div class="alert alert-secondary">No enrollments found.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Enrollment Date</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($enrollments as $enrollment)
                                <tr>
                                    <td>{{ $enrollment->subject->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($enrollment->enrollment_date)->format('M d, Y') }}</td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            {{ optional($enrollment->grades->first())->grade ?? 'N/A' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
