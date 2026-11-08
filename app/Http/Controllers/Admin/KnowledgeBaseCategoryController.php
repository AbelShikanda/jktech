<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KnowledgeBaseCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KnowledgeBaseCategoryController extends Controller
{
    public function index()
    {
        $categories = KnowledgeBaseCategories::query()->orderBy('name')->get();

        return view('admin.knowledge_base_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.knowledge_base_categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
        ]);

        $data['slug'] = Str::slug($data['slug'] ?: $data['name']);
        KnowledgeBaseCategories::create($data);

        return redirect()->route('knowledge-base-categories.index')->with('success', 'Knowledge base category created.');
    }

    public function show($id)
    {
        $category = KnowledgeBaseCategories::findOrFail($id);
        return view('admin.knowledge_base_categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = KnowledgeBaseCategories::findOrFail($id);
        return view('admin.knowledge_base_categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = KnowledgeBaseCategories::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
        ]);

        $data['slug'] = Str::slug($data['slug'] ?: $data['name']);
        $category->update($data);

        return redirect()->route('knowledge-base-categories.index')->with('success', 'Knowledge base category updated.');
    }

    public function destroy($id)
    {
        KnowledgeBaseCategories::findOrFail($id)->delete();
        return redirect()->route('knowledge-base-categories.index')->with('success', 'Knowledge base category deleted.');
    }
}
