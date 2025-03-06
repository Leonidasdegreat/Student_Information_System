<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Subject;
use App\Http\Requests\StoreEnrollmentRequest;
use App\Http\Requests\UpdateEnrollmentRequest;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    // Display a listing of enrollments
    public function index()
    {
        $enrollments = Enrollment::with(['student', 'subject'])->get();
        $students = Student::all();
        $subjects = Subject::all();

        return view('enrollments.index', compact('enrollments', 'students', 'subjects'));
    }

    // Show the form for creating a new enrollment
    public function create()
    {
        $students = Student::all();
        $subjects = Subject::all();
        return view('enrollments.create', compact('students', 'subjects'));
    }

    // Store a newly created enrollment in the database
    public function store(StoreEnrollmentRequest $request)
    {
        Enrollment::create($request->validated());

        return redirect()->route('enrollments.index')->with('success', 'Enrollment added successfully.');
    }

    // Display the specified enrollment
    public function show(Enrollment $enrollment)
    {
        return view('enrollments.show', compact('enrollment'));
    }

    // Show the form for editing the specified enrollment
    public function edit(Enrollment $enrollment)
    {
        $students = Student::all();
        $subjects = Subject::all();
        return view('enrollments.edit', compact('enrollment', 'students', 'subjects'));
    }

    // Update the specified enrollment in the database
    public function update(UpdateEnrollmentRequest $request, Enrollment $enrollment)
    {
        $enrollment->update($request->validated());

        return redirect()->route('enrollments.index')->with('success', 'Enrollment updated successfully.');
    }

    // Remove the specified enrollment from the database
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return redirect()->route('enrollments.index')->with('success', 'Enrollment deleted successfully.');
    }
}
