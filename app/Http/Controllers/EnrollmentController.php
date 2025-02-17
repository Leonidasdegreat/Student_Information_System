<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    // Display a listing of enrollments
    public function index()
{
    $enrollments = Enrollment::with(['student', 'subject'])->get(); // Load related data
    $students = Student::all(); // Fetch all students
    $subjects = Subject::all(); // Fetch all subjects

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
    public function store(Request $request)
{
    $request->validate([
        'student_id' => 'required|exists:students,id',
        'subject_id' => 'required|exists:subjects,id',
        'enrollment_date' => 'required|date',
    ]);

    Enrollment::create($request->all());

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
    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'enrollment_date' => 'required|date',
        ]);
    
        Enrollment::findOrFail($id)->update($request->all());
    
        return redirect()->route('enrollments.index')->with('success', 'Enrollment updated successfully.');
    }
    

    // Remove the specified enrollment from the database
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return redirect()->route('enrollments.index')->with('success', 'Enrollment deleted successfully.');
    }
}