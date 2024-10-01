<?php

namespace App\Http\Controllers;

use App\Models\CourseOfferUniversity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseOfferUniversityController extends Controller
{
    // List all course offers with pagination and optional filters
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10); // Default to 10 items per page
        $query = CourseOfferUniversity::query();

        // Optional filtering by university or course
        if ($request->has('university_id')) {
            $query->where('university_id', $request->get('university_id'));
        }
        if ($request->has('course_id')) {
            $query->where('course_id', $request->get('course_id'));
        }

        $courseOffers = $query->with(['university', 'course'])->paginate($perPage);
        return response()->json($courseOffers, 200);
    }

    // Store a new course offering
    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'university_id' => 'required|exists:universities,university_id',
            'course_id' => 'required|exists:courses,course_id',
            'is_available_for_international_students' => 'boolean',
        ];

        // Define custom error messages
        $customMessages = [
            'university_id.required' => 'University ID is required.',
            'course_id.required' => 'Course ID is required.',
            'university_id.exists' => 'The selected university does not exist.',
            'course_id.exists' => 'The selected course does not exist.',
        ];

        // Create validator instance
        $validator = Validator::make($request->all(), $rules, $customMessages);

        // Return validation errors if validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors occurred.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Create the course offering after validation succeeds
            $courseOffer = CourseOfferUniversity::create($validator->validated());

            return response()->json([
                'message' => 'Course offering created successfully.',
                'course_offer' => $courseOffer,
            ], 201);

        } catch (\Exception $e) {
            // Handle any exception that occurs during creation
            return response()->json([
                'error' => 'Failed to create course offering.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    // Show a specific course offering
    public function show($id)
    {
        try {
            $courseOffer = CourseOfferUniversity::with(['university', 'course'])->findOrFail($id);
            return response()->json($courseOffer, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Course offering not found.'], 404);
        }
    }

    // Update a course offering
    public function update(Request $request, $id)
    {
        // Define validation rules
        $rules = [
            'university_id' => 'sometimes|required|exists:universities,university_id',
            'course_id' => 'sometimes|required|exists:courses,course_id',
            'is_available_for_international_students' => 'boolean',
        ];

        // Create validator instance
        $validator = Validator::make($request->all(), $rules);

        // Return validation errors if validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors occurred.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Find the course offering and update its details
            $courseOffer = CourseOfferUniversity::findOrFail($id);
            $courseOffer->update($validator->validated());

            return response()->json([
                'message' => 'Course offering updated successfully.',
                'course_offer' => $courseOffer,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update course offering.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    // Delete a course offering
    public function destroy($id)
    {
        $courseOffer = CourseOfferUniversity::find($id);
        if (!$courseOffer) {
            return response()->json(['error' => 'Course offering not found.'], 404);
        }

        try {
            $courseOffer->delete();
            return response()->json(['message' => 'Course offering deleted successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete course offering.', 'details' => $e->getMessage()], 500);
        }
    }
}
