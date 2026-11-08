<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KnowledgeBaseCategories;
use App\Models\KnowledgeBases;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KnowledgeBaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin.content.manage,admin')->except(['index', 'show']);
    }

    public function index()
    {
        $items = KnowledgeBases::query()->with('knowledgeBaseCategories')->latest()->get();
        return view('admin.knowledge_bases.index', compact('items'));
    }

    public function create()
    {
        $categories = KnowledgeBaseCategories::query()->orderBy('name')->get();
        return view('admin.knowledge_bases.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'knowledgeBase_categories_id' => 'required|integer|exists:knowledge_base_categories,id',
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'body' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_image' => 'nullable|string|max:2048',
            'whatsapp' => 'nullable|boolean',
            'telegram' => 'nullable|boolean',
            'website' => 'nullable|boolean',
        ]);

        $data['sub_title'] = $data['sub_title'] ?? $data['title'];
        $data['slug'] = Str::slug($data['title'] . '-' . Str::random(5));
        $data['meta_image'] = $data['meta_image'] ?: 'https://placehold.co/1200x630?text=Knowledge+Base';
        foreach (['whatsapp', 'telegram', 'website'] as $flag) {
            $data[$flag] = $request->boolean($flag);
        }

        $item = KnowledgeBases::create($data);
        $item->knowledgeBaseCategories()->sync([$data['knowledgeBase_categories_id']]);

        return redirect()->route('knowledge-bases.index')->with('success', 'Knowledge base item created.');
    }

    public function show($id)
    {
        $item = KnowledgeBases::with('knowledgeBaseCategories', 'knowledgeBaseImage')->findOrFail($id);
        return view('admin.knowledge_bases.show', compact('item'));
    }

    public function edit($id)
    {
        $item = KnowledgeBases::with('knowledgeBaseCategories')->findOrFail($id);
        $categories = KnowledgeBaseCategories::query()->orderBy('name')->get();
        return view('admin.knowledge_bases.edit', compact('item', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $item = KnowledgeBases::findOrFail($id);
        $data = $request->validate([
            'knowledgeBase_categories_id' => 'required|integer|exists:knowledge_base_categories,id',
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'body' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_image' => 'nullable|string|max:2048',
            'whatsapp' => 'nullable|boolean',
            'telegram' => 'nullable|boolean',
            'website' => 'nullable|boolean',
        ]);

        $data['sub_title'] = $data['sub_title'] ?? $data['title'];
        if ($item->title !== $data['title']) {
            $data['slug'] = Str::slug($data['title'] . '-' . Str::random(5));
        }
        $data['meta_image'] = $data['meta_image'] ?: ($item->meta_image ?: 'https://placehold.co/1200x630?text=Knowledge+Base');
        foreach (['whatsapp', 'telegram', 'website'] as $flag) {
            $data[$flag] = $request->boolean($flag);
        }

        $item->update($data);
        $item->knowledgeBaseCategories()->sync([$data['knowledgeBase_categories_id']]);

        return redirect()->route('knowledge-bases.index')->with('success', 'Knowledge base item updated.');
    }

    public function destroy($id)
    {
        KnowledgeBases::findOrFail($id)->delete();
        return redirect()->route('knowledge-bases.index')->with('success', 'Knowledge base item deleted.');
    }
}
