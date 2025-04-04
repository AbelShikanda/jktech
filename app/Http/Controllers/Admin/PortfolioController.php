<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\ImageManager;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $work = Portfolio::latest()->get();
        return view('admin.portfolio.index', with([
            'work' => $work,
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.portfolio.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_one' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'image_two' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'image_three' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Initialize Intervention ImageManager
        $manager = new ImageManager(new Driver());

        // This array will hold all the saved paths
        $imagePaths = [];

        foreach (['image_one', 'image_two', 'image_three'] as $imageField) {
            if ($request->hasFile($imageField)) {
                $file = $request->file($imageField);
                $currentDate = now()->toDateString();
                $fileName = $imageField . '-' . $currentDate . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Read the image
                $image = $manager->read($file->getPathname());

                // Resize the image
                $croppedImage = $image->resize(1011, 570);

                // Save to storage
                $path = 'img/portfolio/' . $fileName;
                Storage::disk('public')->put($path, $croppedImage->encode(new JpegEncoder(quality: 90)));

                // Store path in array
                $imagePaths[$imageField] = $path;
            }
        }

        Portfolio::create([
            'url' => $request->url,
            'title' => $request->title,
            'description' => $request->description,
            'image_one' => $imagePaths['image_one'] ?? null,
            'image_two' => $imagePaths['image_two'] ?? null,
            'image_three' => $imagePaths['image_three'] ?? null,
        ]);

        return redirect()->route('portfolio.index')->with('success', 'Portfolio created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        return view('admin.portfolio.show', with([
            'portfolio' => $portfolio,
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $work = Portfolio::findOrFail($id);
        return view('admin.portfolio.edit', with([
            'work' => $work,
        ]));
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
        $request->validate([
            'url' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_one' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image_two' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image_three' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $work = Portfolio::findOrFail($id);

        $manager = new ImageManager(new Driver());

        $imagePaths = [];

        foreach (['image_one', 'image_two', 'image_three'] as $imageField) {
            if ($request->hasFile($imageField)) {
                $file = $request->file($imageField);
                $currentDate = now()->toDateString();
                $fileName = $imageField . '-' . $currentDate . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

                $image = $manager->read($file->getPathname());
                $croppedImage = $image->resize(1011, 570);

                $path = 'img/portfolio/' . $fileName;
                Storage::disk('public')->put($path, $croppedImage->encode(new JpegEncoder(quality: 90)));

                $imagePaths[$imageField] = $path;

                // Optional: delete old image from storage
                if ($work->$imageField) {
                    Storage::disk('public')->delete($work->$imageField);
                }
            }
        }

        $work->update([
            'url' => $request->url,
            'title' => $request->title,
            'description' => $request->description,
            'image_one' => $imagePaths['image_one'] ?? $work->image_one,
            'image_two' => $imagePaths['image_two'] ?? $work->image_two,
            'image_three' => $imagePaths['image_three'] ?? $work->image_three,
        ]);

        return redirect()->route('portfolio.index')->with('success', 'Portfolio updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $portfolio = Portfolio::findOrFail($id);

        // Delete images from storage if they exist
        foreach (['image_one', 'image_two', 'image_three'] as $imageField) {
            if ($portfolio->$imageField && Storage::disk('public')->exists($portfolio->$imageField)) {
                Storage::disk('public')->delete($portfolio->$imageField);
            }
        }

        // Delete the portfolio entry from DB
        $portfolio->delete();

        return redirect()->route('portfolio.index')->with('success', 'Portfolio deleted successfully!');
    }
}
