<?php

namespace App\Http\Controllers;

use App\Models\CommunicationLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommunicationLogController extends Controller
{
    // List all communication logs with pagination
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10); // Default to 10 items per page
        $logs = CommunicationLog::paginate($perPage);
        return response()->json($logs, 200);
    }

    // Store a new communication log
    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'student_id' => 'required|exists:students,student_id',
            'agent_id' => 'required|exists:agents,agent_id',
            'communication_type' => 'required|string|max:255',
            'communication_date' => 'required|date',
            'notes' => 'nullable|string',
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
            // Create the log after validation succeeds
            $log = CommunicationLog::create($validator->validated());

            return response()->json([
                'message' => 'Communication log created successfully',
                'log' => $log,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to create communication log',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    // Show a specific communication log
    public function show($id)
    {
        try {
            $log = CommunicationLog::findOrFail($id);
            return response()->json($log, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Communication log not found'], 404);
        }
    }

    // Update a communication log
    public function update(Request $request, $id)
    {
        // Define validation rules
        $rules = [
            'student_id' => 'nullable|exists:students,student_id',
            'agent_id' => 'nullable|exists:agents,agent_id',
            'communication_type' => 'nullable|string|max:255',
            'communication_date' => 'nullable|date',
            'notes' => 'nullable|string',
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
            // Find the log and update its details
            $log = CommunicationLog::findOrFail($id);
            $log->update($validator->validated());

            return response()->json([
                'message' => 'Communication log updated successfully',
                'log' => $log,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update communication log',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    // Delete a communication log
    public function destroy($id)
    {
        $log = CommunicationLog::find($id);
        if (!$log) {
            return response()->json(['error' => 'Communication log not found'], 404);
        }

        try {
            $log->delete();
            return response()->json(['message' => 'Communication log deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete communication log', 'details' => $e->getMessage()], 500);
        }
    }
}
