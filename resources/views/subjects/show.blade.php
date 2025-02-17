@extends('layouts.Dash')

@section('content')
    <h1>Subject Details</h1>
    <p><strong>ID:</strong> {{ $subject->id }}</p>
    <p><strong>Name:</strong> {{ $subject->name }}</p>
    <p><strong>Code:</strong> {{ $subject->code }}</p>
    <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Back</a>
@endsection