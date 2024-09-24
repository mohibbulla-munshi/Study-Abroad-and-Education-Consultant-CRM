<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    // List all leads with pagination
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10); // Default to 10 items per page
        $leads = Lead::paginate($perPage);
        return response()->json($leads, 200);
    }

    // Store a new lead
    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'name' => 'required|string|max:100',
            'email' => 'nullable|string|email|max:100',
            'phone' => 'nullable|string|max:15',
            'interested_country' => 'nullable|string|max:100',
            'interested_course' => 'nullable|string|max:100',
            'lead_status' => 'nullable|in:New,Contacted,Follow-up,Converted,Lost',
            'assigned_agent' => 'nullable|exists:agents,agent_id',
        ];

        // Define custom error messages
        $customMessages = [
            'name.required' => 'Lead name is required',
            'email.email' => 'The email must be a valid email address',
            'assigned_agent.exists' => 'The selected agent does not exist',
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
            // Create the lead after validation succeeds
            $lead = Lead::create($validator->validated());

            return response()->json([
                'message' => 'Lead created successfully',
                'lead' => $lead,
            ], 201);
        } catch (\Exception $e) {
            // Handle any exception that occurs during creation
            return response()->json([
                'error' => 'Failed to create lead',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    // Show a specific lead
    public function show($id)
    {
        try {
            $lead = Lead::findOrFail($id);
            return response()->json($lead, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Lead not found'], 404);
        }
    }

    // Update a lead
    public function update(Request $request, $id)
    {
        // Define validation rules
        $rules = [
            'name' => 'nullable|string|max:100',
            'email' => 'nullable|string|email|max:100',
            'phone' => 'nullable|string|max:15',
            'interested_country' => 'nullable|string|max:100',
            'interested_course' => 'nullable|string|max:100',
            'lead_status' => 'nullable|in:New,Contacted,Follow-up,Converted,Lost',
            'assigned_agent' => 'nullable|exists:agents,agent_id',
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
            // Find the lead and update its details
            $lead = Lead::findOrFail($id);
            $lead->update($validator->validated());

            return response()->json([
                'message' => 'Lead updated successfully',
                'lead' => $lead,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update lead',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    // Delete a lead
    public function destroy($id)
    {
        $lead = Lead::find($id);
        if (!$lead) {
            return response()->json(['error' => 'Lead not found'], 404);
        }

        try {
            $lead->delete();
            return response()->json(['message' => 'Lead deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete lead', 'details' => $e->getMessage()], 500);
        }
    }
}
