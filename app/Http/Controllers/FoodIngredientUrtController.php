<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FoodIngredientUrtController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index()
    {
        return view('manage');
    }
}
