<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $serviceCategories = ServiceCategories::latest()->get();
        return view('admin.categories.index', with([
            'serviceCategories' => $serviceCategories,
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $category = ServiceCategories::create([
                'name' => $request->name,
                'slug' => $request->slug,
            ]);

            if (!$category) {
                DB::rollBack();

                return back()->with('error', 'Something went wrong while saving user data');
            }

            DB::commit();
            return redirect()->route('service_categories.index')->with('success', 'category stored successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // return view('admin.categories.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = ServiceCategories::where('id', $id)->first();
        return view('admin.categories.edit', with([
            'category' => $category
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = $request->validate([
            'name' => '',
            'slug' => '',
        ]);

        try {
            DB::beginTransaction();

            $category = ServiceCategories::find($id);
            if ($category) {
                $category->name = $request->name;
                $category->slug = $request->slug;

                $category->save();
            } else {
                dd('category not found');
            }

            if (!$category) {
                DB::rollBack();

                return back()->with('error', 'Something went wrong while saving user data');
            }

            DB::commit();
            return redirect()->route('service_categories.index')->with('success', 'category updated successfully');
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
        $category = ServiceCategories::find($id);
        $category->delete();
        return redirect()->route('service_categories.index')->with('message', 'category Deleted Successfully.');
    }
}
