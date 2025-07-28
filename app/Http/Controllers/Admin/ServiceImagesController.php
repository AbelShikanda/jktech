<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceImages;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\ImageManager;

class ServiceImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Services::with('serviceImage')->get();
        return view(
            'admin.services.images.index',
            with([
                'services' => $services,
            ]),
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($serviceId)
    {
        $service = Services::findOrFail($serviceId);
        return view('admin.services.images.create', compact('service'));
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
            'service_id' => 'required|exists:services,id',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'full' => 'nullable',
        ]);

        $manager = new ImageManager(new Driver());

        $thumbnailPath = null;
        $fullImagePath = null;

        // Save thumbnail
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $fileName = 'thumbnail-' . now()->format('YmdHis') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

            $image = $manager->read($file->getPathname())->resize(100, 100);
            $thumbnailPath = 'img/serviceImages/' . $fileName;
            Storage::disk('public')->put($thumbnailPath, $image->encode(new JpegEncoder(quality: 90)));
        }

        ServiceImages::create([
            'services_id' => $request->service_id,
            'thumbnail' => $thumbnailPath,
            'full' => $request->full,
        ]);

        return redirect()->route('service_Images.index')->with('success', 'Image created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $images = ServiceImages::findOrFail($id);
        return view(
            'admin.services.images.show',
            with([
                'images' => $images,
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
        $image = ServiceImages::findOrFail($id);
        $service = $image->services;
        return view('admin.services.images.edit', compact('image', 'service'));
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
        $imageRecord = ServiceImages::findOrFail($id);

        $request->validate([
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'full' => 'nullable',
        ]);

        $manager = new ImageManager(new Driver());

        // Update thumbnail if uploaded
        if ($request->hasFile('thumbnail')) {
            // Delete old
            if ($imageRecord->thumbnail) {
                Storage::disk('public')->delete($imageRecord->thumbnail);
            }

            $file = $request->file('thumbnail');
            $fileName = 'thumbnail-' . now()->format('YmdHis') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

            $image = $manager->read($file->getPathname())->resize(300, 300);
            $path = 'img/serviceImages/' . $fileName;
            Storage::disk('public')->put($path, $image->encode(new JpegEncoder(quality: 90)));
            $imageRecord->thumbnail = $path;
        }

        $imageRecord->save();

        return redirect()->route('service_Images.index')->with('success', 'Image updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = ServiceImages::findOrFail($id);

        if ($image->thumbnail) {
            Storage::disk('public')->delete($image->thumbnail);
        }

        $image->delete();

        return redirect()->route('service_Images.index')->with('success', 'Image deleted successfully!');
    }
}
