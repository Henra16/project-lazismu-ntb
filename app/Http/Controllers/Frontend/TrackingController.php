<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TrackingController extends Controller
{
    public function history()
    {
        $donations = Donation::with(['program', 'transaction'])
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('frontend.donasi.history', compact('donations'));
    }

    public function check()
    {
        return view('frontend.donasi.check');
    }

    public function search(Request $request)
    {
        $request->validate([
            'donation_uuid' => 'required|string|uuid',
        ], [
            'donation_uuid.uuid' => 'Format ID Donasi tidak valid.',
        ]);

        $donation = Donation::where('uuid', $request->donation_uuid)->first();

        if (! $donation) {
            return back()->withErrors(['donation_uuid' => 'Donasi tidak ditemukan.'])->withInput();
        }

        return redirect()->route('donasi.track', $donation->uuid);
    }

    public function track($uuid)
    {
        $donation = Donation::with(['program', 'transaction'])->where('uuid', $uuid)->firstOrFail();

        return view('frontend.donasi.invoice', compact('donation'));
    }

    public function cancel(Request $request, $uuid)
    {
        $donation = Donation::with('transaction')->where('uuid', $uuid)->firstOrFail();

        if ($donation->status !== 'pending') {
            return redirect()->route('donasi.track', $donation->uuid)
                ->with('warning', 'Transaksi hanya dapat dibatalkan ketika status masih pending.');
        }

        DB::beginTransaction();
        try {
            $donation->status = 'failed';
            $donation->save();

            if ($donation->transaction) {
                $transaction = $donation->transaction;
                $transaction->transaction_status = 'cancel';
                $transaction->raw_response = array_merge(
                    $transaction->raw_response ?? [],
                    [
                        'canceled_by' => 'customer',
                        'canceled_at' => now()->toDateTimeString(),
                    ]
                );
                $transaction->save();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error cancelling donation: '.$e->getMessage());
            return redirect()->route('donasi.track', $donation->uuid)
                ->with('error', 'Gagal membatalkan transaksi. Silakan coba lagi.');
        }

        return redirect()->route('donasi.track', $donation->uuid)
            ->with('success', 'Transaksi berhasil dibatalkan.');
    }
}
