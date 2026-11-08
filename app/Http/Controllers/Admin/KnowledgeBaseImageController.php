<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KnowledgeBaseImages;
use App\Models\KnowledgeBases;
use Illuminate\Http\Request;

class KnowledgeBaseImageController extends Controller
{
    public function index()
    {
        $images = KnowledgeBaseImages::query()->with('knowledgeBases')->latest()->get();
        return view('admin.knowledge_base_images.index', compact('images'));
    }

    public function create()
    {
        $knowledgeBases = KnowledgeBases::query()->orderBy('title')->get();
        return view('admin.knowledge_base_images.create', compact('knowledgeBases'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'knowledgeBases_id' => 'required|integer|exists:knowledge_bases,id',
            'thumbnail' => 'nullable|string|max:2048',
            'full' => 'nullable|string|max:2048',
        ]);

        $id = $data['knowledgeBases_id'];
        $data['thumbnail'] = $data['thumbnail'] ?: "https://placehold.co/400x300?text=KB+{$id}";
        $data['full'] = $data['full'] ?: "https://placehold.co/1200x800?text=KB+{$id}";

        $image = KnowledgeBaseImages::create($data);
        $image->knowledgeBases()->sync([$id]);

        return redirect()->route('knowledge-base-images.index')->with('success', 'Knowledge base image created.');
    }

    public function show($id)
    {
        $image = KnowledgeBaseImages::with('knowledgeBases')->findOrFail($id);
        return view('admin.knowledge_base_images.show', compact('image'));
    }

    public function edit($id)
    {
        $image = KnowledgeBaseImages::findOrFail($id);
        $knowledgeBases = KnowledgeBases::query()->orderBy('title')->get();
        return view('admin.knowledge_base_images.edit', compact('image', 'knowledgeBases'));
    }

    public function update(Request $request, $id)
    {
        $image = KnowledgeBaseImages::findOrFail($id);
        $data = $request->validate([
            'knowledgeBases_id' => 'required|integer|exists:knowledge_bases,id',
            'thumbnail' => 'nullable|string|max:2048',
            'full' => 'nullable|string|max:2048',
        ]);

        $kbId = $data['knowledgeBases_id'];
        $data['thumbnail'] = $data['thumbnail'] ?: ($image->thumbnail ?: "https://placehold.co/400x300?text=KB+{$kbId}");
        $data['full'] = $data['full'] ?: ($image->full ?: "https://placehold.co/1200x800?text=KB+{$kbId}");

        $image->update($data);
        $image->knowledgeBases()->sync([$kbId]);

        return redirect()->route('knowledge-base-images.index')->with('success', 'Knowledge base image updated.');
    }

    public function destroy($id)
    {
        KnowledgeBaseImages::findOrFail($id)->delete();
        return redirect()->route('knowledge-base-images.index')->with('success', 'Knowledge base image deleted.');
    }
}
