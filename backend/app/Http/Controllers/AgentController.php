<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index()
    {
        return Agent::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:agents',
            'phone' => 'nullable|string|max:20',
        ]);

        $agent = Agent::create($request->all());
        return response()->json($agent, 201);
    }

    public function show($id)
    {
        return Agent::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:agents,email,' . $id,
            'phone' => 'nullable|string|max:20',
        ]);

        $agent = Agent::findOrFail($id);
        $agent->update($request->all());
        return response()->json($agent, 200);
    }

    public function destroy($id)
    {
        Agent::destroy($id);
        return response()->json(null, 204);
    }
}
