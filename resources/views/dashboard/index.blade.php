@extends('layouts.Dash')

@section('content')
<div class="container">
    <!-- Statistics Cards -->
    <div class="row justify-content-end mb-4">
        <!-- Students Counts -->
        <div class="col-md-4 col-6">
            <a href="{{ route('students.index') }}" class="text-decoration-none">
                <div class="card text-white bg-info hoverable-card">
                    <div class="card-body">
                        <h5 class="card-title">Students</h5>
                        <p class="card-text display-4">{{ $totalStudents }}</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Subjects -->
        <div class="col-md-4 col-6">
            <a href="{{ route('subjects.index') }}" class="text-decoration-none">
                <div class="card text-white bg-info hoverable-card">
                    <div class="card-body">
                        <h5 class="card-title">Subjects</h5>
                        <p class="card-text display-4">{{ $totalSubjects }}</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Enrollments -->
        <div class="col-md-4 col-6">
            <a href="{{ route('enrollments.index') }}" class="text-decoration-none">
                <div class="card text-white bg-info hoverable-card">
                    <div class="card-body">
                        <h5 class="card-title">Enrollments</h5>
                        <p class="card-text display-4">{{ $totalEnrollments }}</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
    .hoverable-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hoverable-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
        cursor: pointer;
    }

    a {
        color: inherit;
    }
</style>

@endsection
