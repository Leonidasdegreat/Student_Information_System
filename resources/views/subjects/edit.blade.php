@extends('layouts.Dash')

@section('content')
    <h1>Edit Subject</h1>
    <form action="{{ route('subjects.update', $subject->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $subject->name }}" required>
        </div>
        <div class="form-group">
            <label for="code">Code</label>
            <input type="text" name="code" id="code" class="form-control" value="{{ $subject->code }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection