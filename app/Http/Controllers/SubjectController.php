<?php

namespace App\Http\Controllers;

use App\Models\Subject;
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:subjects',
        ]);

        Subject::create($request->all());
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
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:subjects,code,' . $subject->id,
        ]);

        $subject->update($request->all());
        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    }

    // Remove the specified subject from the database
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully.');
    }
    
}