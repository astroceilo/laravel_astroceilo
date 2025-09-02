<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index()
    {
        $hpCount = Hospital::count();
        $ptCount = Patient::count();
        $logs = Activity::with('user')->latest()->take(10)->paginate(10);

        return view('dashboard', compact('hpCount', 'ptCount', 'logs'));
    }
}
