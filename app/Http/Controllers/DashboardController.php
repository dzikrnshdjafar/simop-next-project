<?php

namespace App\Http\Controllers;

use App\Constants\Department;
use App\Models\Activity;
use App\Models\Documentation;
use App\Models\Pic;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all();
        $pics = Pic::all();
        $activities = Activity::where('status', 'Selesai')->get();
        $documentations = Documentation::all();

        $activityYears = Activity::selectRaw('YEAR(date) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
        $departments = Department::all();

        // dd($activityYears);

        return view('pages.dashboard.index', compact(['users', 'pics', 'activities', 'documentations', 'activityYears', 'departments']));
    }
}
