<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Hospital;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $hpCount = Hospital::count();
        $ptCount = Patient::count();
        // $logs = ActivityLog::with('user')->latest()->take(10)->get();

        return view('dashboard', compact('hpCount', 'ptCount'));
    }
}
