<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    // List all departments with pagination
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10); // Default to 10 items per page
        $departments = Department::paginate($perPage);
        return response()->json($departments, 200);
    }

    // Store a new department
    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'department_name' => 'required|string|max:255|unique:departments,department_name',
            'department_code' => 'required|string|max:10|unique:departments,department_code',
        ];

        // Define custom error messages
        $customMessages = [
            'department_name.required' => 'Department name is required',
            'department_name.unique' => 'This department name is already taken',
            'department_code.required' => 'Department code is required',
            'department_code.unique' => 'This department code is already in use',
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
            // Create the department after validation succeeds
            $department = Department::create($validator->validated());

            return response()->json([
                'message' => 'Department created successfully',
                'department' => $department,
            ], 201);

        } catch (\Exception $e) {
            // Handle any exception that occurs during creation
            return response()->json([
                'error' => 'Failed to create department',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    // Show a specific department
    public function show($id)
    {
        try {
            $department = Department::findOrFail($id);
            return response()->json($department, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Department not found'], 404);
        }
    }

    // Update a department
    public function update(Request $request, $id)
    {
        // Define validation rules
        $rules = [
            'department_name' => 'nullable|string|max:255|unique:departments,department_name,' . $id . ',department_id',
            'department_code' => 'nullable|string|max:10|unique:departments,department_code,' . $id . ',department_id',
        ];

        // Define custom error messages
        $customMessages = [
            'department_name.unique' => 'The provided department name is already in use by another department.',
            'department_code.unique' => 'The provided department code is already in use by another department.',
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
            // Find the department and update its details
            $department = Department::findOrFail($id);
            $department->update($validator->validated());

            return response()->json([
                'message' => 'Department updated successfully',
                'department' => $department,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update department',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    // Delete a specific department
    public function destroy($id)
    {
        $department = Department::find($id);
        if (!$department) {
            return response()->json(['error' => 'Department not found'], 404);
        }

        try {
            $department->delete();
            return response()->json(['message' => 'Department deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete department', 'details' => $e->getMessage()], 500);
        }
    }
}
