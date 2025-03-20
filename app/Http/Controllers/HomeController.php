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

        $services = Services::with(['serviceType', 'Category'])
            ->latest()
            ->take(10)
            ->get();
        return view('home', with([
            'services' => $services,
        ]));
    }
}
