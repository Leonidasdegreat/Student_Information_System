@extends('layouts.Dash')

@section('content')
<div class="container">
    <h1 class="mb-4">Create Student</h1>
    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('students.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" id="address" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="age" class="form-label">Age</label>
                    <input type="number" name="age" id="age" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection