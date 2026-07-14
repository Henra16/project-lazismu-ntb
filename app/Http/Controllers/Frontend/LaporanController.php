<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $reports = Report::orderBy('year', 'desc')->orderBy('created_at', 'desc')->get();
        
        // Group reports by year for a beautiful UI grouping!
        $groupedReports = $reports->groupBy('year');

        return view('frontend.laporan.index', compact('reports', 'groupedReports'));
    }
}
