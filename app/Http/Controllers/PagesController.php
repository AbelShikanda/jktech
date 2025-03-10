<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function portfolio() {
        return view('pages.Portfolio');
    }

    public function portfolio_details() {
        return view('pages.portfolio_details');
    }
    
    public function tutorials() {
        return view('pages.tutorials');
    }
    
    public function tutorial_Details() {
        return view('pages.tutorial_Details');
    }
    
    public function education() {
        return view('pages.education');
    }
    
    public function education_Details() {
        return view('pages.education_Details');
    }
    
    public function contact() {
        return view('pages.contact');
    }
    
    public function contact_store() {
        return view('pages.contact_store');
    }
    
    public function comments() {
        return view('pages.comments');
    }
    
    public function get_booking() {
        return view('pages.get_booking');
    }
    
    public function add_booking() {
        return view('pages.add_booking');
    }
    
    public function update_booking() {
        return view('pages.update_booking');
    }
    
    public function reduce_booking() {
        return view('pages.reduce_booking');
    }
    
    public function delete_booking() {
        return view('pages.delete_booking');
    }
}
