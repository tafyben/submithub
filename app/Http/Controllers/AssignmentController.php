<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    // Student: view their own assignments
    public function studentIndex()
    {
        $assignments = auth()->user()->assignmentsRequested()->latest()->get();
        return view('student.assignments.index', compact('assignments'));
    }

    // Admin: view all assignments
    public function adminIndex()
    {
        $assignments = Assignment::with('student')->latest()->get();
        return view('admin.assignments.index', compact('assignments'));
    }
    // Student: view their own assignments
    public function index()
    {
        if (Auth::user()->hasRole('student')) {
            $assignments = Auth::user()->assignmentsRequested()->latest()->get();
        } else {
            // Admin: view all pending assignments
            $assignments = Assignment::with('student')->latest()->get();
        }

        return view('student.assignments.index', compact('assignments'));
    }

    // Student: show form to request assignment
    public function create()
    {
        return view('student.assignments.create');
    }

    // Student: store assignment request
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'request_file' => 'nullable|file|max:10240', // 10MB
        ]);

        $filePath = $request->file('request_file')
            ? $request->file('request_file')->store('assignments')
            : null;

        Assignment::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'request_file_path' => $filePath,
            'status' => 'pending',
        ]);

        return redirect()->route('student.assignments.index')->with('success', 'Assignment request submitted!');
    }

    // Admin: show assignment details for processing
    public function show(Assignment $assignment)
    {
        $this->authorize('view', $assignment); // optional, for security

        return view('admin.assignments.show', compact('assignment'));
    }

    // Admin: update assignment (upload prepared file, feedback, mark completed)
    public function update(Request $request, Assignment $assignment)
    {
        $request->validate([
            'response_file' => 'nullable|file|max:10240',
            'feedback' => 'nullable|string',
            'status' => 'required|in:pending,submitted,completed',
        ]);

        if ($request->hasFile('response_file')) {
            $assignment->response_file_path = $request->file('response_file')->store('assignments');
        }

        $assignment->feedback = $request->feedback;
        $assignment->status = $request->status;
        $assignment->admin_id = Auth::id();

        if ($request->status === 'completed') {
            $assignment->submitted_at = now();
        }

        $assignment->save();

        return redirect()->route('student.assignments.index')->with('success', 'Assignment updated!');
    }


}
