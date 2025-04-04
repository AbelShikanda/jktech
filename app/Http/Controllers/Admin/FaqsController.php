<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faqs;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faqs::latest()->get();
        return view('admin.faqs.index', with([
            'faqs' => $faqs,
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faqs.create');
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
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'is_active' => '',
        ]);

        Faqs::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('faqs.index')->with('success', 'successfully created FAQ!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faqs  $faqs
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        $faq = Faqs::find($id);
        return view('admin.faqs.edit', with([
            'faq' => $faq,
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faqs  $faqs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'is_active' => '',
        ]);

        $faq = Faqs::findOrFail($id);

        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('faqs.index')->with('success', 'successfully updated FAQ!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faqs  $faqs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq = Faqs::findOrFail($id);
        $faq->delete();

        return redirect()->route('faqs.index')->with('success', 'successfully deleted FAQ!');
    }
}
