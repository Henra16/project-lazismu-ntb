<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class Report extends Model
{
    protected $fillable = [
        'title',
        'file_path',
        'description',
        'date',
    ];

    /**
     * Auto set year dari date
     */
    protected static function booted()
    {
        // set year otomatis + hapus file lama saat update
        static::saving(function ($report) {
            if ($report->date) {
                $report->year = Carbon::parse($report->date)->year;
            }

            // jika file diganti → hapus file lama
            if ($report->isDirty('file_path')) {
                $oldFile = $report->getOriginal('file_path');

                if ($oldFile && Storage::disk('public')->exists($oldFile)) {
                    Storage::disk('public')->delete($oldFile);
                }
            }
        });

        // hapus file saat data dihapus
        static::deleted(function ($report) {
            if ($report->file_path && Storage::disk('public')->exists($report->file_path)) {
                Storage::disk('public')->delete($report->file_path);
            }
        });
    }
}