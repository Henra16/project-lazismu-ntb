<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'category',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        /**
         * CREATE: auto slug + auto publish date
         */
        static::creating(function ($news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->title);
            }

            if (empty($news->published_at)) {
                $news->published_at = now();
            }
        });

        /**
         * UPDATE: auto delete old image jika diganti
         */
        static::updating(function ($news) {
            if ($news->isDirty('image')) {
                $oldImage = $news->getOriginal('image');

                if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            // auto update slug jika title berubah (SEO friendly)
            if ($news->isDirty('title')) {
                $news->slug = Str::slug($news->title);
            }
        });

        /**
         * DELETE: hapus image dari storage
         */
        static::deleted(function ($news) {
            if ($news->image && Storage::disk('public')->exists($news->image)) {
                Storage::disk('public')->delete($news->image);
            }
        });
    }

    /**
     * Scope hanya berita yang sudah publish
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
