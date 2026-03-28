<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;

class DashboardController extends Controller
{
    public function index()
    {
        // Retrieve dashboard data
        $data = Dashboard::all();
        return view('dashboard.index', compact('data'));
    }

    public function show($id)
    {
        // Show a specific dashboard item
        $item = Dashboard::findOrFail($id);
        return view('dashboard.show', compact('item'));
    }

    public function create()
    {
        // Show the form to create a new dashboard item
        return view('dashboard.create');
    }

    public function store(Request $request)
    {
        // Validate and store the new dashboard item
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $dashboard = Dashboard::create($request->all());
        return redirect()->route('dashboard.index')->with('success', 'Dashboard item created successfully.');
    }

    public function edit($id)
    {
        // Show the form to edit an existing dashboard item
        $item = Dashboard::findOrFail($id);
        return view('dashboard.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        // Validate and update the dashboard item
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $dashboard = Dashboard::findOrFail($id);
        $dashboard->update($request->all());
        return redirect()->route('dashboard.index')->with('success', 'Dashboard item updated successfully.');
    }

    public function destroy($id)
    {
        // Delete a dashboard item
        $dashboard = Dashboard::findOrFail($id);
        $dashboard->delete();
        return redirect()->route('dashboard.index')->with('success', 'Dashboard item deleted successfully.');
    }
}