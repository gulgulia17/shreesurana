<?php

namespace App\Http\Controllers;

use App\Models\Data;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Data $lead)
    {
        $leads = $lead->whereHas('users', function ($query) {
            $query->where('user_id', auth()->id());
        })->count();
        return view('home', compact('leads'));
    }
}
