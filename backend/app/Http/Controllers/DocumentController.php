<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller
{
    // List all documents with pagination
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10); // Default to 10 items per page
        $documents = Document::paginate($perPage);
        return response()->json($documents, 200);
    }

    // Store a new document
    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'student_id' => 'required|exists:students,student_id',
            'document_type' => 'required|in:Passport,Transcript,SOP,LOR,Visa Documents,Other',
            'document_url' => 'nullable|string|max:255',
            'uploaded_on' => 'nullable|date',
        ];

        // Define custom error messages
        $customMessages = [
            'student_id.required' => 'Student ID is required',
            'student_id.exists' => 'The selected student does not exist',
            'document_type.required' => 'Document type is required',
            'document_type.in' => 'The selected document type is invalid',
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
            // Create the document after validation succeeds
            $document = Document::create($validator->validated());

            return response()->json([
                'message' => 'Document created successfully',
                'document' => $document,
            ], 201);

        } catch (\Exception $e) {
            // Handle any exception that occurs during creation
            return response()->json([
                'error' => 'Failed to create document',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    // Show a specific document
    public function show($id)
    {
        try {
            $document = Document::findOrFail($id);
            return response()->json($document, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Document not found'], 404);
        }
    }

    // Update a document
    public function update(Request $request, $id)
    {
        // Define validation rules
        $rules = [
            'student_id' => 'nullable|exists:students,student_id',
            'document_type' => 'nullable|in:Passport,Transcript,SOP,LOR,Visa Documents,Other',
            'document_url' => 'nullable|string|max:255',
            'uploaded_on' => 'nullable|date',
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
            // Find the document and update its details
            $document = Document::findOrFail($id);
            $document->update($validator->validated());

            return response()->json([
                'message' => 'Document updated successfully',
                'document' => $document,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update document',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    // Delete a document
    public function destroy($id)
    {
        $document = Document::find($id);
        if (!$document) {
            return response()->json(['error' => 'Document not found'], 404);
        }

        try {
            $document->delete();
            return response()->json(['message' => 'Document deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete document', 'details' => $e->getMessage()], 500);
        }
    }
}
