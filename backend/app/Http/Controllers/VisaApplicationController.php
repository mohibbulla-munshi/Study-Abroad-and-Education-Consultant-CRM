<?php

namespace App\Http\Controllers;

use App\Models\VisaApplication;
use Illuminate\Http\Request;

class VisaApplicationController extends Controller
{
    public function index()
    {
        return VisaApplication::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'status' => 'required|string',
            'interview_date' => 'nullable|date',
        ]);

        $visaApplication = VisaApplication::create($request->all());
        return response()->json($visaApplication, 201);
    }

    public function show($id)
    {
        return VisaApplication::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'nullable|exists:students,id',
            'status' => 'nullable|string',
            'interview_date' => 'nullable|date',
        ]);

        $visaApplication = VisaApplication::findOrFail($id);
        $visaApplication->update($request->all());
        return response()->json($visaApplication, 200);
    }

    public function destroy($id)
    {
        VisaApplication::destroy($id);
        return response()->json(null, 204);
    }
}
