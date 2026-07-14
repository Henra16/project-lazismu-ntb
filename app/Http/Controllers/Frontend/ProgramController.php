<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = \App\Models\Program::where('is_active', true)->orderBy('created_at', 'desc')->get();
        return view('frontend.program.index', compact('programs'));
    }
    public function show($slug)
    {
        $program = \App\Models\Program::where('slug', $slug)->first();

        // Mock program data if not found (since slug is hardcoded as 'zakat-maal' in the UI for now)
        if (!$program) {
            $program = new \App\Models\Program();
            $program->title = ucwords(str_replace('-', ' ', $slug));
            $program->id = 0; // dummy ID
            $program->slug = $slug;
            $program->target_amount = 50000000;
            // Dummy collected amount
            $program->collected = 10000000;
            $program->image = 'https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?w=800&q=80';
            $program->description = 'Bantu sesama dengan program ini melalui Lazismu NTB.';
        }

        if ($program->id > 0) {
            $program->distributed = \App\Models\Disbursement::where('program_id', $program->id)->sum('amount');
        } else {
            $program->distributed = 7500000;
        }

        $currentYear = Carbon::now()->year;

        $chartData = array_fill(1, 12, 0);

        if ($program->id > 0) {
            $donations = Donation::select(
                    DB::raw('MONTH(paid_at) as month'),
                    DB::raw('SUM(amount) as total')
                )
                ->where('program_id', $program->id)
                ->where('status', 'paid')
                ->whereYear('paid_at', $currentYear)
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            foreach ($donations as $donation) {
                if ($donation->month >= 1 && $donation->month <= 12) {
                    $chartData[$donation->month] = (float) $donation->total;
                }
            }
        } else {
            // Mock data for the chart if program is dummy
            $chartData = [
                1 => 1500000, 2 => 2000000, 3 => 1800000, 4 => 3000000, 
                5 => 5000000, 6 => 2500000, 7 => 1000000, 8 => 3500000, 
                9 => 4000000, 10 => 2000000, 11 => 1500000, 12 => 4500000
            ];
        }

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $values = array_values($chartData);

        if ($program->id > 0) {
            $programDonors = Donation::where('program_id', $program->id)
                ->where('status', 'paid')
                ->orderBy('paid_at', 'desc')
                ->get();
        } else {
            $programDonors = collect([]); // mock empty for dummy
        }

        return view('frontend.program.detail', compact('program', 'months', 'values', 'programDonors'));
    }
}
