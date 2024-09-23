<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    // List all courses with pagination
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10); // Default to 10 items per page
        $courses = Course::paginate($perPage);
        return response()->json($courses, 200);
    }

    // Store a new course
    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'course_name' => 'required|string|max:255|unique:courses,course_name',
            'university_id' => 'required|exists:universities,university_id',
            'duration' => 'nullable|string|max:50',
            'fees' => 'nullable|numeric|min:0',
            'description' => 'nullable|string|max:1000',
        ];

        // Define custom error messages
        $customMessages = [
            'course_name.required' => 'Course name is required',
            'course_name.unique' => 'This course name is already taken',
            'university_id.required' => 'University ID is required',
            'university_id.exists' => 'The selected university does not exist',
            'fees.numeric' => 'Fees must be a valid number',
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
            // Create the course after validation succeeds
            $course = Course::create($validator->validated());

            return response()->json([
                'message' => 'Course created successfully',
                'course' => $course,
            ], 201);

        } catch (\Exception $e) {
            // Handle any exception that occurs during creation
            return response()->json([
                'error' => 'Failed to create course',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    // Show a specific course
    public function show($id)
    {
        try {
            $course = Course::findOrFail($id);
            return response()->json($course, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Course not found'], 404);
        }
    }

    // Update a course
    public function update(Request $request, $id)
    {
        // Define validation rules
        $rules = [
            'course_name' => 'nullable|string|max:255|unique:courses,course_name,' . $id . ',course_id',
            'university_id' => 'nullable|exists:universities,university_id',
            'duration' => 'nullable|string|max:50',
            'fees' => 'nullable|numeric|min:0',
            'description' => 'nullable|string|max:1000',
        ];

        // Define custom error messages
        $customMessages = [
            'course_name.unique' => 'The provided course name is already in use by another course.',
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
            // Find the course and update its details
            $course = Course::findOrFail($id);
            $course->update($validator->validated());

            return response()->json([
                'message' => 'Course updated successfully',
                'course' => $course,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update course',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return response()->json(['error' => 'Course not found'], 404);
        }

        try {
            $course->delete();
            return response()->json(['message' => 'Course deleted successfully'], 200); // Change 204 to 200
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete course', 'details' => $e->getMessage()], 500);
        }
    }

}
