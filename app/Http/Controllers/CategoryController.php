<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.index');
    }

    public function mens()
    {
        return view('categories.mens');
    }

    public function womens()
    {
        return view('categories.womens');
    }

    public function accessories()
    {
        return view('categories.accessories');
    }

    public function shoes()
    {
        return view('categories.shoes');
    }
}
