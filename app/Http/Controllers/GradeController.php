<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GradeController extends Controller
{
    // Display all enrolled students with grades, filter by subject
    public function index(Request $request)
    {
        $subjects = Subject::all();
        $selectedSubject = $request->input('subject_id');

        $enrollments = Enrollment::with('student', 'subject', 'grade')
            ->when($selectedSubject, function ($query) use ($selectedSubject) {
                return $query->where('subject_id', $selectedSubject);
            })
            ->get();

        return view('grades.index', compact('enrollments', 'subjects', 'selectedSubject'));
    }

    // Update a student's grade via modal
    public function update(Request $request, $enrollmentId)
    {
        $request->validate([
            'grade' => 'nullable|numeric|min:0|max:100',
        ]);

        $enrollment = Enrollment::findOrFail($enrollmentId);

        // Update or create the grade
        Grade::updateOrCreate(
            ['enrollment_id' => $enrollmentId],
            ['grade' => $request->input('grade')]
        );

        return redirect()->route('grades.index')->with('success', 'Grade updated successfully.');
    }
    public function destroy($id)
    {
        Log::info('Attempting to delete grade with ID: ' . $id);

        $grade = Grade::find($id);

        if (!$grade) {
            Log::warning('Grade not found for ID: ' . $id);
            return redirect()->route('grades.index')->with('error', 'Grade not found.');
        }

        $grade->delete();

        Log::info('Successfully deleted grade with ID: ' . $id);

        return redirect()->route('grades.index')->with('success', 'Grade removed successfully.');
    }

    
}
