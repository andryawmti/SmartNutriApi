<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Consultation;
use App\Menu;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count = [
            'user' => User::count(),
            'admin' => Admin::count(),
            'consultation' => Consultation::count(),
            'menu' => Menu::count()
        ];
        return view('partials.home', ['count' => $count]);
    }
}
