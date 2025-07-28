<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategories;
use App\Models\Services;
use App\Models\ServiceServiceCategories;
use App\Models\ServiceServiceTypes;
use App\Models\ServiceTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicesController extends Controller
{
    public function index()
    {
        $services = Services::with('serviceType', 'serviceImage')->orderBy('id', 'DESC')->get();

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $categories = ServiceCategories::all();
        $service_types = ServiceTypes::all();

        return view('admin.services.create', compact('categories', 'service_types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
            'meta_image' => 'nullable',
            'category' => 'required|exists:service_categories,id',
            'type' => 'required|exists:service_types,id',
            'description' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $type = ServiceTypes::findOrFail($request->type);
            $price = $type->price ?? 0;

            $service = Services::create([
                'categories_id' => $request->category,
                'type_id' => $request->type,
                'name' => $request->name,
                'description' => $request->description,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_keywords' => $request->meta_keywords,
                'meta_image' => $request->meta_image,
                'price' => $price,
                'whatsapp' => $request->has('whatsapp'),
                'telegram' => $request->has('telegram'),
                'website' => $request->has('website'),
                'promotion' => $request->has('promotion'),
            ]);

            ServiceServiceCategories::create([
                'services_id' => $service->id,
                'service_categories_id' => $request->category,
            ]);

            ServiceServiceTypes::create([
                'services_id' => $service->id,
                'service_types_id' => $request->type,
            ]);

            DB::commit();
            return redirect()->route('services.index')->with('success', 'Service stored successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $th->getMessage());
        }
    }

    public function show(string $id)
    {
        $service = Services::with('serviceType', 'Category', 'serviceImage')->findOrFail($id);

        return view('admin.services.show', compact('service'));
    }

    public function edit(string $id)
    {
        $service = Services::with('serviceType')->findOrFail($id);
        $categories = ServiceCategories::all();  // Assuming your model is Category
        $serviceTypes = ServiceTypes::all();  // This is where $serviceTypes comes from

        return view('admin.services.edit', compact('service', 'categories', 'serviceTypes'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
            'meta_image' => 'nullable',
            'category' => 'required|exists:service_categories,id',
            'type' => 'required|exists:service_types,id',
            'description' => 'required',
            'whatsapp' => 'nullable',
            'telegram' => 'nullable',
            'website' => 'nullable',
            'promotion' => 'nullable',
        ]);

        try {
            DB::beginTransaction();

            $service = Services::findOrFail($id);
            $type = ServiceTypes::findOrFail($request->type);
            $price = $type->price ?? 0;

            $service->update([
                'categories_id' => $request->category,
                'type_id' => $request->type,
                'name' => $request->name,
                'description' => $request->description,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_keywords' => $request->meta_keywords,
                'meta_image' => $request->meta_image,
                'price' => $price,
                'whatsapp' => $request->has('whatsapp'),
                'telegram' => $request->has('telegram'),
                'website' => $request->has('website'),
                'promotion' => $request->has('promotion'),
            ]);

            // Sync category and type relationships
            ServiceServiceCategories::where('services_id', $id)->delete();
            ServiceServiceCategories::create([
                'services_id' => $id,
                'service_categories_id' => $request->category,
            ]);

            ServiceServiceTypes::where('services_id', $id)->delete();
            ServiceServiceTypes::create([
                'services_id' => $id,
                'service_types_id' => $request->type,
            ]);

            DB::commit();
            return redirect()->route('services.index')->with('success', 'Service updated successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $th->getMessage());
        }
    }

    public function destroy(string $id)
    {
        $service = Services::findOrFail($id);
        $service->delete();

        return redirect()->route('services.index')->with('message', 'Service deleted successfully.');
    }
}
