<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    // List all courses with pagination and optional filters
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10); // Default to 10 items per page

        // Optional filtering by university or department
        $query = Course::query();
        if ($request->has('university_id')) {
            $query->where('university_id', $request->get('university_id'));
        }
        if ($request->has('department_id')) {
            $query->where('department_id', $request->get('department_id'));
        }

        $courses = $query->paginate($perPage);
        return response()->json($courses, 200);
    }

    // Store a new course
    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'course_name' => 'required|string|max:255|unique:courses,course_name',
            'course_code' => 'required|string|max:20|unique:courses,course_code',
            'university_id' => 'required|exists:universities,university_id',
            'department_id' => 'required|exists:departments,department_id',
            'duration' => 'nullable|string|max:50',
            'fees' => 'nullable|numeric|min:0',
            'credits' => 'nullable|integer|min:0',
            'level' => 'nullable|string|max:50',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string|max:1000',
        ];

        // Define custom error messages
        $customMessages = [
            'course_name.required' => 'Course name is required',
            'course_code.required' => 'Course code is required',
            'university_id.required' => 'University ID is required',
            'university_id.exists' => 'The selected university does not exist',
            'department_id.exists' => 'The selected department does not exist',
            'fees.numeric' => 'Fees must be a valid number',
            'end_date.after_or_equal' => 'End date must be after or equal to the start date',
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
            'course_code' => 'nullable|string|max:20|unique:courses,course_code,' . $id . ',course_id',
            'university_id' => 'nullable|exists:universities,university_id',
            'department_id' => 'nullable|exists:departments,department_id',
            'duration' => 'nullable|string|max:50',
            'fees' => 'nullable|numeric|min:0',
            'credits' => 'nullable|integer|min:0',
            'level' => 'nullable|string|max:50',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string|max:1000',
        ];

        // Define custom error messages
        $customMessages = [
            'course_name.unique' => 'The provided course name is already in use by another course.',
            'course_code.unique' => 'The provided course code is already in use by another course.',
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

    // Delete a course
    public function destroy($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return response()->json(['error' => 'Course not found'], 404);
        }

        try {
            $course->delete();
            return response()->json(['message' => 'Course deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete course', 'details' => $e->getMessage()], 500);
        }
    }
}
