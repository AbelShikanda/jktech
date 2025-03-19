<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = ServiceTypes::latest()->get();
        return view('admin.types.index', with([
            'types' => $types,
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $types = $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $types = ServiceTypes::create([
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
            ]);

            if (!$types) {
                DB::rollBack();
                return back()->with(['message', 'something went wrong while saving your data']);
            }

            DB::commit();
            return redirect()->route('types.index')->with(['message', 'type created successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $types = ServiceTypes::find($id);
        return view('admin.types.edit', with([
            'types' => $types,
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $types = $request->validate([
            'name' => '',
            'slug' => '',
        ]);

        try {
            DB::beginTransaction();

            $types = ServiceTypes::find($id);
            $types->update([
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
            ]);

            if (!$types) {
                DB::rollBack();
                return back()->with(['message', 'something went wrong while saving your data']);
            }

            DB::commit();
            return redirect()->route('types.index')->with(['message', 'type updated successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $type = ServiceTypes::find($id);
        $type->delete();
        return redirect()->route('types.index')->with(['message', 'type deleted successfully']);
    }
}
