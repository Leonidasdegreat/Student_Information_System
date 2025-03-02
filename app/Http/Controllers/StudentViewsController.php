<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Enrollment;
use App\Models\Grade;

class StudentViewsController extends Controller
{
    /**
     * Display the student dashboard.
     */
    public function index()
{
    // Get the authenticated student
    $student = Auth::guard('student')->user();

    // Fetch the student's enrollments with subjects and grades
    $enrollments = Enrollment::where('student_id', $student->id)
        ->with('subject', 'grades') // Use 'grades' instead of 'grade'
        ->get();

    // Pass the data to the view
    return view('studentviews.index', compact('student', 'enrollments'));
}
    
}