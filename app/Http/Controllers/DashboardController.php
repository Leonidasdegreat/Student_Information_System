<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Enrollment;
use App\Models\Grade;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the total number of students
        $totalStudents = Student::count();

        // Fetch the total number of subjects
        $totalSubjects = Subject::count();

        // Fetch the total number of enrollments
        $totalEnrollments = Enrollment::count();

        // Fetch the average grade (using the Grade model)
        $averageGrade = Grade::avg('grade');

        // Fetch recent students (last 5 students)
        $recentStudents = Student::orderBy('created_at', 'desc')->take(5)->get();

        // Fetch recent enrollments (last 5 enrollments with student and subject details)
        $recentEnrollments = Enrollment::with(['student', 'subject'])
            ->orderBy('enrollment_date', 'desc')
            ->take(5)
            ->get();

        // Fetch students by role (assuming you have a role column in the students table)
        $studentsByRole = Student::select('role', \DB::raw('count(*) as count'))
            ->groupBy('role')
            ->get();

        // Fetch grade distribution (using the Grade model)
        $gradeDistribution = Grade::selectRaw('
        CASE
            WHEN grade = 1.0 THEN "A+"
            WHEN grade = 1.25 THEN "A"
            WHEN grade = 1.50 THEN "A-"
            WHEN grade = 1.75 THEN "B+"
            WHEN grade = 2.0 THEN "B"
            WHEN grade = 2.25 THEN "B-"
            WHEN grade = 2.50 THEN "C+"
            WHEN grade = 2.75 THEN "C"
            WHEN grade = 3.0 THEN "C-"
            WHEN grade = 3.25 THEN "D+"
            WHEN grade = 3.50 THEN "D"
            WHEN grade = 3.75 THEN "D-"
            WHEN grade >= 4.0 AND grade <= 5.0 THEN "F"
            ELSE "Unknown"
        END as grade_range, count(*) as count')
        ->groupBy('grade_range')
        ->orderByRaw('MIN(grade) ASC') // Ensures correct ordering from A+ to F
        ->get();


        // Pass all the variables to the view
        return view('dashboard.index', compact(
            'totalStudents',
            'totalSubjects',
            'totalEnrollments',
            'averageGrade',
            'recentStudents',
            'recentEnrollments',
            'studentsByRole',
            'gradeDistribution'
        ));
    }
}