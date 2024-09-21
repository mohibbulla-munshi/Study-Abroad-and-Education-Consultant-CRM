<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return Student::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students',
            'phone' => 'nullable|string|max:20',
            'nationality' => 'nullable|string|max:50',
            'birthdate' => 'nullable|date',
            'address' => 'nullable|string',
        ]);

        $student = Student::create($request->all());
        return response()->json($student, 201);
    }

    public function show($id)
    {
        return Student::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:students,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'nationality' => 'nullable|string|max:50',
            'birthdate' => 'nullable|date',
            'address' => 'nullable|string',
        ]);

        $student = Student::findOrFail($id);
        $student->update($request->all());
        return response()->json($student, 200);
    }

    public function destroy($id)
    {
        Student::destroy($id);
        return response()->json(null, 204);
    }
}
