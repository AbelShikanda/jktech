<?php

namespace App\Http\Controllers;

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

        // $blogs = BlogImages::with('blogs')
        //     ->orderBy('id', 'DESC')
        //     ->take(2)
        //     ->get();

        $services = Services::all();
        return view('bookings.index', with([
            'services' => $services,
        ]));
    }
}
