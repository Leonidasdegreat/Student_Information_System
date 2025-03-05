@extends('layouts.Dash')
@section('title', 'Students Dashboard')
@section('content')
<div class="container">
    <h1 class="mb-4">Students</h1>
    
    <!-- Add Student Button -->
    <button class="btn btn-primary mb-3 px-4 py-2 fw-bold rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#addStudentModal">
    <span> &#65122;</span> Add Student
    </button>

    <!-- Search Form -->
    <div class="mb-3 position-relative">
        <input type="text" id="searchInput" class="form-control p-3 rounded shadow-sm" placeholder="🔍 Search for students...">
    </div>

    <!-- Error Message Display -->
    <div id="error-message" class="alert alert-danger text-center fw-bold rounded shadow-sm fade show d-none">
        ⚠️ The email address is already registered.
    </div>

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-striped table-bordered" id="studentsTable">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Role</th>
                        <th>Age</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->address }}</td>
                            <td>{{ $student->role }}</td>
                            <td>{{ $student->age }}</td>
                            <td>
                                <!-- Edit Button -->
                                <button class="btn btn-warning btn-sm edit-btn" 
                                        data-id="{{ $student->id }}" 
                                        data-name="{{ $student->name }}" 
                                        data-email="{{ $student->email }}" 
                                        data-address="{{ $student->address }}"
                                        data-role="{{ $student->role }}"
                                        data-age="{{ $student->age }}" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal">
                                    Edit
                                </button>

                                   
                                    <button class="btn btn-danger btn-sm delete-btn" 
                                            data-id="{{ $student->id }}" 
                                            data-name="{{ $student->name }}" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal">
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

<!-- Include the Modal Partial -->
@include('modals._modals')
@include('modals.deletemodal')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit-btn');
        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const studentId = this.getAttribute('data-id');
                const studentName = this.getAttribute('data-name');
                const studentEmail = this.getAttribute('data-email');
                const studentAddress = this.getAttribute('data-address');
                const studentRole = this.getAttribute('data-role');
                const studentAge = this.getAttribute('data-age');

                document.getElementById('edit-name').value = studentName;
                document.getElementById('edit-email').value = studentEmail;
                document.getElementById('edit-address').value = studentAddress;
                document.getElementById('edit-role').value = studentRole;
                document.getElementById('edit-age').value = studentAge;
                document.getElementById('editForm').action = `/students/${studentId}`;
            });
        });

        document.getElementById('searchInput').addEventListener('keyup', function () {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#studentsTable tbody tr');
            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });

        // Check for email error and show message
        @if ($errors->has('email'))
            const errorMessage = document.getElementById('error-message');
            errorMessage.style.display = 'block';
        @endif

        // Close error message when clicking anywhere on the screen or modal
        document.addEventListener('click', function (e) {
            const errorMessage = document.getElementById('error-message');
            if (!errorMessage.contains(e.target) && !document.getElementById('addStudentModal').contains(e.target)) {
                errorMessage.style.display = 'none';
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const studentId = this.getAttribute('data-id');
                const studentName = this.getAttribute('data-name');

                document.getElementById('delete-student-name').textContent = studentName;
                document.getElementById('deleteForm').action = `/students/${studentId}`;
            });
        });
    });
</script>

@endsection
