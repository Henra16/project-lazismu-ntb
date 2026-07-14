<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Campaign;
use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the landing page.
     */
    public function index()
    {
        // Fetch active programs
        $programs = Program::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();

        // Fetch latest news
        $news = News::published()
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        // Fetch dynamic transparency statistics
        $totalTerkumpul = Program::sum('collected');
        $programBerjalan = Program::where('is_active', true)->count();
        $danaTersalurkan = \App\Models\Disbursement::sum('amount');
        $donaturAktif = 1240 + \App\Models\Donation::where('status', 'paid')->distinct()->count('donor_email');

        // Fetch latest 3 reports for PDF download
        $reports = \App\Models\Report::orderBy('year', 'desc')->orderBy('created_at', 'desc')->limit(3)->get();

        return view('frontend.home.index', compact(
            'programs', 
            'news', 
            'totalTerkumpul', 
            'programBerjalan', 
            'danaTersalurkan', 
            'donaturAktif',
            'reports'
        ));
    }

    /**
     * Handle search request.
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return redirect()->route('home');
        }

        // Search in campaigns
        $programs = Campaign::where('status', 'active')
            ->where(function($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('frontend.search.index', compact('programs', 'query'));
    }
}
