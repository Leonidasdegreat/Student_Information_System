<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Display a listing of students
    public function index(Request $request)
    {
        $query = Student::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('id', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%")
                  ->orWhere('age', 'like', "%{$search}%");
        }

        $students = $query->get();

        if ($request->ajax()) {
            return response()->json($students);
        }

        return view('students.index', compact('students'));
    }

    // Show the form for creating a new student
    public function create()
    {
        return view('students.create');
    }

    // Store a newly created student in the database
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'email' => 'required|email|unique:students,email',
            'name' => 'required|string',
            'address' => 'required|string',
            'age' => 'required|integer',
        ]);

        // Create new student if validation passes
        Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'age' => $request->age,
        ]);

        return redirect()->route('students.index');
    }




    // Display the specified student
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    // Show the form for editing the specified student
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    // Update the specified student in the database
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'address' => 'required',
            'age' => 'required',
        ], [
            'email.unique' => 'The email has already been taken.' // Custom error message
        ]);

        // Update the student with the validated request data
        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    // Remove the specified student from the database
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
