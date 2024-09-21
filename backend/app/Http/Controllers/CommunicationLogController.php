<?php

namespace App\Http\Controllers;

use App\Models\CommunicationLog;
use Illuminate\Http\Request;

class CommunicationLogController extends Controller
{
    public function index()
    {
        return CommunicationLog::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'notes' => 'required|string',
            'date' => 'required|date',
        ]);

        $log = CommunicationLog::create($request->all());
        return response()->json($log, 201);
    }

    public function show($id)
    {
        return CommunicationLog::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'nullable|exists:students,id',
            'notes' => 'nullable|string',
            'date' => 'nullable|date',
        ]);

        $log = CommunicationLog::findOrFail($id);
        $log->update($request->all());
        return response()->json($log, 200);
    }

    public function destroy($id)
    {
        CommunicationLog::destroy($id);
        return response()->json(null, 204);
    }
}
