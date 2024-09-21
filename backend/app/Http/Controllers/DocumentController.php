<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        return Document::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'file_path' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $document = Document::create($request->all());
        return response()->json($document, 201);
    }

    public function show($id)
    {
        return Document::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'nullable|exists:students,id',
            'file_path' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $document = Document::findOrFail($id);
        $document->update($request->all());
        return response()->json($document, 200);
    }

    public function destroy($id)
    {
        Document::destroy($id);
        return response()->json(null, 204);
    }
}
