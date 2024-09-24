<?php

namespace App\Http\Controllers;

use App\Models\VisaApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VisaApplicationController extends Controller
{
    // List all visa applications with pagination
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10); // Default to 10 items per page
        $visaApplications = VisaApplication::paginate($perPage);
        return response()->json($visaApplications, 200);
    }

    // Store a new visa application
    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'student_id' => 'required|exists:students,student_id',
            'visa_type' => 'nullable|string|max:50',
            'visa_status' => 'required|in:Not Applied,Applied,Interview Scheduled,Approved,Rejected',
            'application_date' => 'nullable|date',
            'interview_date' => 'nullable|date',
            'decision_date' => 'nullable|date',
            'comments' => 'nullable|string',
        ];

        // Define custom error messages
        $customMessages = [
            'student_id.required' => 'Student ID is required',
            'student_id.exists' => 'The selected student does not exist',
            'visa_status.required' => 'Visa status is required',
        ];

        // Create validator instance
        $validator = Validator::make($request->all(), $rules, $customMessages);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors occurred',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Create the visa application after validation succeeds
            $visaApplication = VisaApplication::create($validator->validated());

            return response()->json([
                'message' => 'Visa application created successfully',
                'visaApplication' => $visaApplication,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to create visa application',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    // Show a specific visa application
    public function show($id)
    {
        try {
            $visaApplication = VisaApplication::findOrFail($id);
            return response()->json($visaApplication, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Visa application not found'], 404);
        }
    }

    // Update a visa application
    public function update(Request $request, $id)
    {
        // Define validation rules
        $rules = [
            'student_id' => 'required|exists:students,student_id',
            'visa_type' => 'required|string|max:50',
            'visa_status' => 'required|in:Not Applied,Applied,Interview Scheduled,Approved,Rejected',
            'application_date' => 'required|date',
            'interview_date' => 'required|date',
            'decision_date' => 'required|date',
            'comments' => 'nullable|string',
        ];

        // Create validator instance
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors occurred',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Find the visa application and update its details
            $visaApplication = VisaApplication::findOrFail($id);
            $visaApplication->update($validator->validated());

            return response()->json([
                'message' => 'Visa application updated successfully',
                'visaApplication' => $visaApplication,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update visa application',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    // Delete a visa application
    public function destroy($id)
    {
        $visaApplication = VisaApplication::find($id);
        if (!$visaApplication) {
            return response()->json(['error' => 'Visa application not found'], 404);
        }

        try {
            $visaApplication->delete();
            return response()->json(['message' => 'Visa application deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete visa application', 'details' => $e->getMessage()], 500);
        }
    }
}
