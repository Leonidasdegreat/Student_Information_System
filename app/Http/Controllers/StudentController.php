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
                  ->orWhere('role', 'like', "%{$search}%")
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
            'password' => 'required|string|min:6|confirmed',
            'name' => 'required|string',
            'address' => 'required|string',
            'role' => 'required|in:student,admin',
            'age' => 'required|integer',
        ]);

        // Create new student with auto-verified email
        Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'address' => $request->address,
            'role' => $request->role,
            'age' => $request->age,
            'email_verified_at' => now(), // Automatically verify email
        ]);

        return redirect()->route('students.index')->with('success', 'Student added and auto-verified.');
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
            'password' => 'nullable|string|min:6|confirmed',
            'address' => 'required',
            'role' => 'required|in:student,admin',
            'age' => 'required',
        ], [
            'email.unique' => 'The email has already been taken.'
        ]);

        // Prepare data for update
        $data = $request->except('password');
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        // Update the student
        $student->update($data);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    // Remove the specified student from the database
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
