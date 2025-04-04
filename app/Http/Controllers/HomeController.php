<?php

namespace App\Http\Controllers;

use App\Models\Faqs;
use App\Models\Services;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $images = ProductImages::with('products')
        //     ->latest()
        //     ->take(6)
        //     ->get();

        $faqs = Faqs::where('is_active', 1)->get();
        return view('home', with([
            'faqs' => $faqs,
        ]));
    }
}
