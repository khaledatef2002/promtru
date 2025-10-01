<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\TopCustomer;

class MainController extends Controller
{
    function home() {
        $services = Service::get();
        $top_customers = TopCustomer::all();
        return view('front.home', compact('services', 'top_customers'));
    }
}
