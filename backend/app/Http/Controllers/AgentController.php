<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgentController extends Controller
{
    // List all agents with pagination
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10); // Default to 10 agents per page
        $agents = Agent::paginate($perPage);
        return response()->json($agents, 200);
    }

    // Store a new agent
    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'agent_name' => 'required|string|max:100',
            'email' => 'nullable|email|max:100|unique:agents,email',
            'phone' => 'nullable|string|max:15',
        ];

        // Define custom error messages (if needed)
        $customMessages = [
            'agent_name.required' => 'Agent name is required',
            'email.unique' => 'This email is already in use by another agent',
        ];

        // Create a validator instance
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
            // Create the agent after validation
            $agent = Agent::create($validator->validated());

            return response()->json([
                'message' => 'Agent created successfully',
                'agent' => $agent,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to create agent',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    // Show a specific agent
    public function show($id)
    {
        try {
            $agent = Agent::findOrFail($id);
            return response()->json($agent, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Agent not found'], 404);
        }
    }

    // Update an existing agent
    public function update(Request $request, $id)
    {
        // Define validation rules for updating
        $rules = [
            'agent_name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:agents,email,' . $id . ',agent_id',
            'phone' => 'required|string|max:15',
        ];

        // Create a validator instance
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
            // Find the agent and update its details
            $agent = Agent::findOrFail($id);
            $agent->update($validator->validated());

            return response()->json([
                'message' => 'Agent updated successfully',
                'agent' => $agent,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update agent',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    // Delete an agent
    public function destroy($id)
    {
        $agent = Agent::find($id);
        if (!$agent) {
            return response()->json(['error' => 'Agent not found'], 404);
        }

        try {
            $agent->delete();
            return response()->json(['message' => 'Agent deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete agent', 'details' => $e->getMessage()], 500);
        }
    }
}
