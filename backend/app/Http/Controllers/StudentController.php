<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class StudentController extends Controller
{
    public function index(Request $request)
    {
        // Get the page size from the query parameters, defaulting to 10 if not provided
        $perPage = $request->query('per_page', 10);

        // Fetch students with pagination
        $students = Student::paginate($perPage);

        return response()->json([
            'data' => $students->items(),
            'meta' => [
                'current_page' => $students->currentPage(),
                'last_page' => $students->lastPage(),
                'per_page' => $students->perPage(),
                'total' => $students->total(),
            ],
        ], 200);
    }

    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students',
            'phone' => 'nullable|string|max:20',
            'nationality' => 'nullable|string|max:50',
            'birthdate' => 'nullable|date',
            'address' => 'nullable|string',
        ];

        // Define custom error messages
        $customMessages = [
            'email.unique' => 'The provided email address is already registered. Please use a different email.',
        ];

        // Create the validator instance
        $validator = Validator::make($request->all(), $rules, $customMessages);

        // Check if validation fails
        if ($validator->fails()) {
            // Return the validation errors as a response
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors occurred',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // If validation passes, create the new student
            $student = Student::create($validator->validated());

            return response()->json([
                'message' => 'Student created successfully',
                'student' => $student,
            ], 201);

        } catch (\Exception $e) {
            // Handle any exception that occurs during creation
            return response()->json([
                'error' => 'Failed to create student',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json([
                'message' => 'Student not found',
            ], 404);
        }
    
        return response()->json($student, 200);
    }

    public function update(Request $request, $id)
    {
        // Define validation rules
        $rules = [
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:students,email,' . $id . ',student_id',  // Note the 'student_id'
            'phone' => 'nullable|string|max:20',
            'nationality' => 'nullable|string|max:50',
            'birthdate' => 'nullable|date',
            'address' => 'nullable|string',
        ];

        // Define custom error messages (optional)
        $messages = [
            'email.unique' => 'The provided email address is already registered with another student.',
        ];

        // Create the validator instance
        $validator = Validator::make($request->all(), $rules, $messages);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors occurred',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Find the student by student_id
            $student = Student::findOrFail($id);

            // Update the student's data
            $student->update($validator->validated());

            return response()->json([
                'message' => 'Student updated successfully',
                'student' => $student,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update student',
                'details' => $e->getMessage(),
            ], 500);
        }
    }


    public function destroy($id)
    {
        // Find the student by ID
        $student = Student::find($id);

        // Check if the student exists
        if (!$student) {
            return response()->json([
                'message' => 'Student not found',
            ], 404); // Return a 404 response if the student doesn't exist
        }

        // Delete the student
        $student->delete();

        return response()->json([
            'message' => 'Student deleted successfully',
        ], 200); // Return a 200 response for successful deletion
    }
}
