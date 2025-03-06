<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    // Display a listing of subjects
    public function index()
    {
        $subjects = Subject::all();
        return view('subjects.index', compact('subjects'));
    }

    // Show the form for creating a new subject
    public function create()
    {
        return view('subjects.create');
    }

    // Store a newly created subject in the database
    public function store(StoreSubjectRequest $request)
    {
        $existingSubject = Subject::where('code', $request->code)->first();

        if ($existingSubject) {
            return redirect()->back()->withInput()->with('error', 'Subject code already exists.');
        }

        Subject::create($request->validated());
        return redirect()->route('subjects.index')->with('success', 'Subject created successfully.');
    }


    // Display the specified subject
    public function show(Subject $subject)
    {
        return view('subjects.show', compact('subject'));
    }

    // Show the form for editing the specified subject
    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    // Update the specified subject in the database
    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        // Check if the new code is already taken by another subject
        $existingSubject = Subject::where('code', $request->code)->where('id', '!=', $subject->id)->first();

        if ($existingSubject) {
            return redirect()->back()->with('error', 'Subject code already exists.');
        }

        $subject->update($request->validated());
        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    }

    // Remove the specified subject from the database
    public function destroy(Subject $subject)
    {
        // Check if the subject has enrolled students
        if ($subject->students()->exists()) {
            return redirect()->route('subjects.index')->with('error', 'Cannot delete subject. There are enrolled students.');
        }

        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully.');
    }

}
