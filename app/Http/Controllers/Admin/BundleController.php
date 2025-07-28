<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bundle;
use Illuminate\Http\Request;

class BundleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bundles = Bundle::latest()->get();
        return view('admin.bundles.index', compact('bundles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bundles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'duration_unit' => 'required|in:day,week,month,year',
            'duration' => 'required|integer|min:1',
            'is_active' => 'boolean',
            'is_recurring' => 'boolean',
            'trial_days' => 'nullable|integer|min:0',
            'type' => 'nullable|string',
            'features' => 'nullable|string',
        ]);

        $validated['features'] = array_map('trim', explode(',', $validated['features']));

        Bundle::create($validated);

        return redirect()->route('bundles.index')->with('success', 'Bundle created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Optional: implement this if needed
        $bundle = Bundle::findOrFail($id);
        return view('admin.bundles.show', compact('bundle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bundle = Bundle::findOrFail($id);
        return view('admin.bundles.edit', compact('bundle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bundle = Bundle::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'duration_unit' => 'required|in:day,week,month,year',
            'duration' => 'required|integer|min:1',
            'is_active' => 'boolean',
            'is_recurring' => 'boolean',
            'trial_days' => 'nullable|integer|min:0',
            'type' => 'nullable|string',
            'features' => 'nullable|string',
        ]);

        $validated['features'] = array_map('trim', explode(',', $validated['features']));

        $bundle->update($validated);

        return redirect()->route('bundles.index')->with('success', 'Bundle updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bundle = Bundle::findOrFail($id);
        $bundle->delete();

        return redirect()->route('bundles.index')->with('success', 'Bundle deleted successfully.');
    }
}
