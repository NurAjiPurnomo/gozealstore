<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function products()
    {
        return view('dashboard.products.index');
    }
}
