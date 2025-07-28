<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Memes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\ImageManager;

class MemesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $memes = Memes::latest()->get();
        return view(
            'admin.memes.index',
            with([
                'memes' => $memes,
            ]),
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.memes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate inputs
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Initialize Intervention Image Manager
        $manager = new ImageManager(new Driver());

        // Default image path
        $imagePath = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $currentDate = now()->toDateString();
            $fileName = 'meme-' . $currentDate . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Read and resize image
            $image = $manager->read($file->getPathname());
            $resizedImage = $image->resize(1011, 570);  // Optional resize

            // Save to storage
            $path = 'img/memes/' . $fileName;
            Storage::disk('public')->put($path, $resizedImage->encode(new JpegEncoder(quality: 90)));

            $imagePath = $path;
        }

        // Create Meme record
        Memes::create([
            'heading' => $request->heading,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('memes.index')->with('success', 'Meme created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $memes = Memes::findOrFail($id);
        return view(
            'admin.memes.show',
            with([
                'memes' => $memes,
            ]),
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $memes = Memes::findOrFail($id);
        return view(
            'admin.memes.edit',
            with([
                'memes' => $memes,
            ]),
        );
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
        // Validate inputs
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Find the meme
        $meme = Memes::findOrFail($id);

        // Initialize Intervention Image Manager
        $manager = new ImageManager(new Driver());

        // Image path
        $imagePath = $meme->image;

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            $file = $request->file('image');
            $currentDate = now()->toDateString();
            $fileName = 'meme-' . $currentDate . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Read and resize image
            $image = $manager->read($file->getPathname());
            $resizedImage = $image->resize(1011, 570);

            // Save new image
            $path = 'img/memes/' . $fileName;
            Storage::disk('public')->put($path, $resizedImage->encode(new JpegEncoder(quality: 90)));

            $imagePath = $path;
        }

        // Update Meme record
        $meme->update([
            'heading' => $request->heading,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('memes.index')->with('success', 'Meme updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $meme = Memes::findOrFail($id);

        // Delete image from storage if it exists
        if ($meme->image && Storage::disk('public')->exists($meme->image)) {
            Storage::disk('public')->delete($meme->image);
        }

        // Delete the meme entry from the database
        $meme->delete();

        return redirect()->route('memes.index')->with('success', 'Meme deleted successfully!');
    }
}
