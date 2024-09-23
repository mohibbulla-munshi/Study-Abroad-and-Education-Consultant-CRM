<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UniversityController extends Controller
{
    // List all universities with pagination
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10); // Default to 10 items per page
        $universities = University::paginate($perPage);
        return response()->json($universities, 200);
    }

    // Store a new university
    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'university_name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:50',
            'website' => 'nullable|url|max:255',
        ];

        // Define custom error messages
        $customMessages = [
            'university_name.required' => 'University name is required',
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
            // Create the university after validation succeeds
            $university = University::create($validator->validated());

            return response()->json([
                'message' => 'University created successfully',
                'university' => $university,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to create university',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    // Show a specific university
    public function show($id)
    {
        try {
            $university = University::findOrFail($id);
            return response()->json($university, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'University not found'], 404);
        }
    }

    // Update a university
    public function update(Request $request, $id)
    {
        // Define validation rules
        $rules = [
            'university_name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:50',
            'website' => 'nullable|url|max:255',
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
            // Find the university and update its details
            $university = University::findOrFail($id);
            $university->update($validator->validated());

            return response()->json([
                'message' => 'University updated successfully',
                'university' => $university,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update university',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    // Delete a university
    public function destroy($id)
    {
        $university = University::find($id);
        if (!$university) {
            return response()->json(['error' => 'University not found'], 404);
        }

        try {
            $university->delete();
            return response()->json(['message' => 'University deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete university', 'details' => $e->getMessage()], 500);
        }
    }
}
