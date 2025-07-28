<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Software;
use Illuminate\Http\Request;

class SoftwareController extends Controller
{
    public function index()
    {
        $software = Software::with('releases')->latest()->get();
        return view('admin.software.index', compact('software'));
    }

    public function create()
    {
        return view('admin.software.create-edit');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'releases.*.os' => 'required|string',
            'releases.*.version' => 'required|string',
            'releases.*.download_url' => 'required|url',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('software_images', 'public');
        }

        $software = Software::create($data);

        foreach ($request->releases as $release) {
            $software->releases()->create($release);
        }

        return redirect()->route('software.index')->with('success', 'Software created successfully.');
    }

    public function show(Software $software)
    {
        $software->load('releases');
        return view('admin.software.show', compact('software'));
    }

    public function edit(Software $software)
    {
        $software->load('releases');
        return view('admin.software.create-edit', compact('software'));
    }

    public function update(Request $request, Software $software)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'releases.*.id' => 'nullable|exists:software_releases,id',
            'releases.*.os' => 'required|string',
            'releases.*.version' => 'required|string',
            'releases.*.download_url' => 'required|url',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('software_images', 'public');
        }

        $software->update($data);

        $software->releases()->delete();
        foreach ($request->releases as $release) {
            $software->releases()->create($release);
        }

        return redirect()->route('software.index')->with('success', 'Software updated successfully.');
    }

    public function destroy(Software $software)
    {
        $software->delete();
        return redirect()->route('software.index')->with('success', 'Software deleted.');
    }
}
