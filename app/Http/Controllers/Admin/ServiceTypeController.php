<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceTypeController extends Controller
{
    public function index()
    {
        $types = ServiceTypes::latest()->get();
        return view('admin.types.index', compact('types'));
    }

    public function create()
    {
        return view('admin.types.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:service_types,slug,',
            'price' => 'required|numeric|min:0',
        ]);

        if (empty($validated['slug'])) {
            unset($validated['slug']);
        }

        try {
            DB::beginTransaction();

            $type = ServiceTypes::create($validated);

            // dd($type);

            DB::commit();
            return redirect()->route('types.index')->with('message', 'Type created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Failed to create type: ' . $th->getMessage());
        }
    }

    public function edit($id)
    {
        $type = ServiceTypes::findOrFail($id);
        return view('admin.types.edit', compact('type'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:service_types,slug,' . $id,
            'price' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $type = ServiceTypes::findOrFail($id);
            $type->update($validated);

            DB::commit();
            return redirect()->route('types.index')->with('message', 'Type updated successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Failed to update type: ' . $th->getMessage());
        }
    }

    public function destroy($id)
    {
        $type = ServiceTypes::findOrFail($id);
        $type->delete();

        return redirect()->route('types.index')->with('message', 'Type deleted successfully');
    }
}
