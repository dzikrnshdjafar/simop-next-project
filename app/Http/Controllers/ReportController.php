<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function users(Request $request)
    {
        if ($request->ajax()) {
            $data = User::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.dashboard.reports.users');
    }

    public function users_pdf_preview(Request $request)
    {
        $users = User::all();

        $Pdf = Pdf::loadView('exports.users', compact('users'));

        return $Pdf->stream();
    }

    public function activities_pdf_preview(Request $request)
    {
        $user = auth()->user();
        $query = Activity::query();

        if ($user->isDepartmentHead()) {
            $query->whereHas('pic', function ($query) use ($user) {
                $query->where('department', $user->departmentHead->department);
            });
        }

        $activities = $query->get();

        $Pdf = Pdf::loadView('exports.activities', compact('activities'));

        return $Pdf->stream();
    }
}
