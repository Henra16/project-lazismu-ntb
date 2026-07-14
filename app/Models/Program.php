<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Program extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'category',
        'image',
        'target_amount',
        'collected',
        'is_active',
    ];

    protected static function booted(): void
    {
        // Generate slug otomatis saat create
        static::creating(function ($program) {
            if (empty($program->slug)) {
                $program->slug = Str::slug($program->title);
            }
        });

        // Hapus gambar lama saat gambar diganti
        static::updating(function ($program) {

            if ($program->isDirty('image')) {

                $oldImage = $program->getOriginal('image');

                if (
                    !empty($oldImage) &&
                    Storage::disk('public')->exists($oldImage)
                ) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
        });

        // Hapus gambar saat program dihapus
        static::deleting(function ($program) {

            if (
                !empty($program->image) &&
                Storage::disk('public')->exists($program->image)
            ) {
                Storage::disk('public')->delete($program->image);
            }
        });
    }
}