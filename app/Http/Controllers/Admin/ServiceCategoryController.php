<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceCategoryController extends Controller
{
    public function index()
    {
        $serviceCategories = ServiceCategories::latest()->get();
        return view('admin.categories.index', compact('serviceCategories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
        ]);
        $data['slug'] = Str::slug($data['slug'] ?: $data['name']);
        ServiceCategories::create($data);

        return redirect()->route('service_categories.index')->with('success', 'Category created successfully.');
    }

    public function show(string $id)
    {
        $category = ServiceCategories::findOrFail($id);
        return view('admin.categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = ServiceCategories::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = ServiceCategories::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
        ]);
        $data['slug'] = Str::slug($data['slug'] ?: $data['name']);
        $category->update($data);

        return redirect()->route('service_categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        ServiceCategories::findOrFail($id)->delete();
        return redirect()->route('service_categories.index')->with('success', 'Category deleted successfully.');
    }
}
