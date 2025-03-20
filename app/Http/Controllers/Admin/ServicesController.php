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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Services::with('serviceType', 'serviceImage')->orderBy('id', 'DESC')->get();
        return view('admin.services.index', with([
            'services' => $services,
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ServiceCategories::all();
        $service_types = ServiceTypes::all();
        return view('admin.services.create', with([
            'categories' => $categories,
            'service_types' => $service_types,
        ]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $service = $request->validate([
            'name' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
            'meta_image' => 'required',
            'category' => 'required',
            'type' => 'required',
            'description' => 'required',
        ]);

        // $price = Prices::where('type_id', $request->input('type'))->pluck('price')->first();

        try {
            DB::beginTransaction();

            $service = Services::create([
                'categories_id' => $request->category,
                'type_id' => $request->type,
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'meta_title' => $request->input('meta_title'),
                'meta_description' => $request->input('meta_description'),
                'meta_keywords' => $request->input('meta_keywords'),
                'meta_image' => $request->input('meta_image'),
                'price' => 0,
                'whatsapp' => 0,
                'telegram' => 0,
                'website' => 0,
                'promotion' => 0,
            ]);

            ServiceServiceCategories::create([
                'services_id' => $service->id,
                'service_categories_id' => $service->categories_id,
            ]);

            ServiceServiceTypes::create([
                'services_id' => $service->id,
                'service_types_id' => $service->type_id,
            ]);

            if (!$service) {
                DB::rollBack();

                return back()->with('error', 'Something went wrong while saving user data');
            }

            DB::commit();
            return redirect()->route('services.index')->with('success', 'service stored successfully');
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
        $service = Services::with(
            'serviceType',
            'Category',
            'serviceImage',
        )
            ->where('id', $id)
            ->orderBy('id', 'DESC')
            ->first();

        return view('admin.services.show', with([
            'service' => $service,
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $services = Services::find($id);

        $category = ServiceCategories::where('id', $services->categories_id)->first();
        $categories = ServiceCategories::all();

        $service_type = ServiceTypes::where('id', $services->type_id)->first();
        $service_types = ServiceTypes::all();

        return view('admin.services.edit', with([
            'category' => $category,
            'categories' => $categories,
            'service_type' => $service_type,
            'service_types' => $service_types,
            'services' => $services,
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $service = $request->validate([
            'name' => '',
            'meta_title' => '',
            'meta_description' => '',
            'meta_keywords' => '',
            'meta_image' => '',
            'category' => '',
            'type' => '',
            'description' => '',
            'whatsapp' => '',
            'telegram' => '',
            'website' => '',
            'promotion' => '',
        ]);

        try {
            DB::beginTransaction();

            $service = Services::find($id);
            if ($service) {
                $service->categories_id = $request->category;
                $service->type_id = $request->type;
                $service->name = $request->input('name');
                $service->description = $request->input('description');
                $service->meta_title = $request->input('meta_title');
                $service->meta_description = $request->input('meta_description');
                $service->meta_keywords = $request->input('meta_keywords');
                $service->meta_image = $request->input('meta_image');
                $service->whatsapp = !empty($request->whatsapp) ? 1 : 0;
                $service->telegram = !empty($request->telegram) ? 1 : 0;
                $service->website = !empty($request->website) ? 1 : 0;
                $service->promotion = !empty($request->promotion) ? 1 : 0;

                $service->save();
            } else {
                dd('service not found');
            }

            ServiceServiceCategories::where('services_id', $id)->delete();
            ServiceServiceCategories::create([
                'services_id' => $service->id,
                'service_categories_id' => $service->categories_id,
            ]);

            ServiceServiceTypes::where('services_id', $id)->delete();
            ServiceServiceTypes::create([
                'services_id' => $service->id,
                'service_types_id' => $request->input('type'),
            ]);

            if (!$service) {
                DB::rollBack();

                return back()->with('error', 'Something went wrong while saving user data');
            }

            DB::commit();
            return redirect()->route('services.index')->with('success', 'service updated successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Services::find($id);
        $service->delete();
        return redirect()->route('services.index')->with('message', 'service Deleted Successfully.');
    }
}
