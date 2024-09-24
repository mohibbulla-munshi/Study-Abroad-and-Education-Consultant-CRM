<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    // List all applications with pagination
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10); // Default to 10 items per page
        $applications = Application::paginate($perPage);
        return response()->json($applications, 200);
    }

    // Store a new application
    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'student_id' => 'required|exists:students,student_id',
            'course_id' => 'required|exists:courses,course_id',
            'application_status' => 'nullable|in:In Review,Documents Submitted,Accepted,Rejected,Withdrawn',
            'applied_on' => 'nullable|date',
            'decision_date' => 'nullable|date',
            'comments' => 'nullable|string|max:1000',
        ];

        // Define custom error messages
        $customMessages = [
            'student_id.required' => 'Student ID is required and must exist in the students table',
            'course_id.required' => 'Course ID is required and must exist in the courses table',
            'application_status.in' => 'Invalid application status',
        ];

        // Create validator instance
        $validator = Validator::make($request->all(), $rules, $customMessages);

        // Return validation errors if validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors occurred',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Create the application after validation succeeds
            $application = Application::create($validator->validated());

            return response()->json([
                'message' => 'Application created successfully',
                'application' => $application,
            ], 201);

        } catch (\Exception $e) {
            // Handle any exception that occurs during creation
            return response()->json([
                'error' => 'Failed to create application',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    // Show a specific application
    public function show($id)
    {
        try {
            $application = Application::findOrFail($id);
            return response()->json($application, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Application not found'], 404);
        }
    }

    // Update a specific application
    public function update(Request $request, $id)
    {
        // Define validation rules
        $rules = [
            'student_id' => 'required|exists:students,student_id',
            'course_id' => 'required|exists:courses,course_id',
            'application_status' => 'required|in:In Review,Documents Submitted,Accepted,Rejected,Withdrawn',
            'applied_on' => 'required|date',
            'decision_date' => 'required|date',
            'comments' => 'nullable|string|max:1000',
        ];

        // Create validator instance
        $validator = Validator::make($request->all(), $rules);

        // Return validation errors if validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors occurred',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Find the application and update its details
            $application = Application::findOrFail($id);
            $application->update($validator->validated());

            return response()->json([
                'message' => 'Application updated successfully',
                'application' => $application,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update application',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    // Delete an application
    public function destroy($id)
    {
        $application = Application::find($id);
        if (!$application) {
            return response()->json(['error' => 'Application not found'], 404);
        }

        try {
            $application->delete();
            return response()->json(['message' => 'Application deleted successfully'], 200); // Return 200 instead of 204
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete application', 'details' => $e->getMessage()], 500);
        }
    }
}
