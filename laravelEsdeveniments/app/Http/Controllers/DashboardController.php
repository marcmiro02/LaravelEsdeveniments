<?php

namespace App\Http\Controllers;

use App\Models\Esdeveniments;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $esdeveniments = Esdeveniments::all();
        return view('dashboard', compact('esdeveniments'));
    }
}