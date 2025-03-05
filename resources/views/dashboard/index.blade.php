@extends('layouts.Dash')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard</h1>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <!-- Total Students -->
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Students</h5>
                    <p class="card-text display-4">{{ $totalStudents }}</p>
                </div>
            </div>
        </div>

        <!-- Total Subjects -->
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Total Subjects</h5>
                    <p class="card-text display-4">{{ $totalSubjects }}</p>
                </div>
            </div>
        </div>

        <!-- Total Enrollments -->
        <div class="col-md-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Total Enrollments</h5>
                    <p class="card-text display-4">{{ $totalEnrollments }}</p>
                </div>
            </div>
        </div>

        <!-- Average Grade -->
        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Average Grade</h5>
                    <p class="card-text display-4">{{ number_format($averageGrade, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row mb-4">
        <!-- Students by Role Chart -->
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Students by Role</h5>
                    <canvas id="studentsByRoleChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Grade Distribution Chart -->
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Grade Distribution</h5>
                    <canvas id="gradesDistributionChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Data Tables -->
    <div class="row">
        <!-- Recent Students -->
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Recent Students</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentStudents as $student)
                                <tr>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->role }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Recent Enrollments -->
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Recent Enrollments</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Subject</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentEnrollments as $enrollment)
                                <tr>
                                    <td>{{ $enrollment->student->name }}</td>
                                    <td>{{ $enrollment->subject->name }}</td>
                                    <td>{{ $enrollment->enrollment_date }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Students by Role Chart
        const studentsByRoleCtx = document.getElementById('studentsByRoleChart').getContext('2d');
        new Chart(studentsByRoleCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($studentsByRole->pluck('role')) !!},
                datasets: [{
                    label: 'Number of Students',
                    data: {!! json_encode($studentsByRole->pluck('count')) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Grade Distribution Chart
        const gradesDistributionCtx = document.getElementById('gradesDistributionChart').getContext('2d');
        new Chart(gradesDistributionCtx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($gradeDistribution->pluck('grade_range')) !!},
                datasets: [{
                    label: 'Grades Distribution',
                    data: {!! json_encode($gradeDistribution->pluck('count')) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            }
        });
    });
</script>
@endsection