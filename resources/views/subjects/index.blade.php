@extends('layouts.Dash')

@section('content')
<div class="container">
    <h1 class="mb-4">Subjects</h1>
    
    <!-- Add Subject Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addSubjectModal">Add Subject</button>

    <!-- Search Form -->
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Search for subjects...">
    </div>

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-striped table-bordered" id="subjectsTable">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subjects as $subject)
                        <tr>
                            <td>{{ $subject->id }}</td>
                            <td>{{ $subject->name }}</td>
                            <td>{{ $subject->code }}</td>
                            <td>
                                <!-- Edit Button -->
                                <button class="btn btn-warning btn-sm edit-btn" 
                                        data-id="{{ $subject->id }}" 
                                        data-name="{{ $subject->name }}" 
                                        data-code="{{ $subject->code }}" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal">
                                    Edit
                                </button>

                                <!-- Delete Form -->
                                <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this subject?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Include Add Subject Modal -->
@include('modals.Add_subject_modal')

<!-- Include Edit Subject Modal -->
@include('modals.Edit_subject_modal')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit-btn');
        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const subjectId = this.getAttribute('data-id');
                const subjectName = this.getAttribute('data-name');
                const subjectCode = this.getAttribute('data-code');

                document.getElementById('edit-name').value = subjectName;
                document.getElementById('edit-code').value = subjectCode;
                document.getElementById('editForm').action = `/subjects/${subjectId}`;
            });
        });

        document.getElementById('searchInput').addEventListener('keyup', function () {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#subjectsTable tbody tr');
            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    });
</script>

@endsection
