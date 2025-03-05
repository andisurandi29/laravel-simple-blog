<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'publish_date',
        'status',
        'user_id',
    ];

    protected $casts = [
        'publish_date' => 'datetime',
    ];

    public $timestamps = true; // Pastikan timestamps aktif

    /**
     * Relasi dengan User (Author)
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scope untuk mendapatkan post yang statusnya aktif
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'Active');
    }

    /**
     * Scope untuk mengurutkan berdasarkan `created_at` terbaru
     */
    public function scopeOrderByCreatedAtDesc(Builder $query): Builder
    {
        return $query->latest('created_at');
    }
}
