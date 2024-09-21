<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function index()
    {
        return University::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
        ]);

        $university = University::create($request->all());
        return response()->json($university, 201);
    }

    public function show($id)
    {
        return University::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
        ]);

        $university = University::findOrFail($id);
        $university->update($request->all());
        return response()->json($university, 200);
    }

    public function destroy($id)
    {
        University::destroy($id);
        return response()->json(null, 204);
    }
}
