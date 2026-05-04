<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'engine_size',
        'mileage',
        'year',
        'price',
        'url',
        'image_url',
        'country',
    ];

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query
            ->when($filters['search'] ?? null, function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('brand', 'like', "%{$search}%")
                      ->orWhere('model', 'like', "%{$search}%")
                      ->orWhere('year', 'like', "%{$search}%")
                      ->orWhere('engine_size', 'like', "%{$search}%")
                      ->orWhere('price', 'like', "%{$search}%");
                });
            })
            ->when($filters['brand'] ?? null, fn($q, $v) => $q->where('brand', 'like', "%{$v}%"))
            ->when($filters['model'] ?? null, fn($q, $v) => $q->where('model', 'like', "%{$v}%"))
            ->when($filters['year_from'] ?? null, fn($q, $v) => $q->where('year', '>=', $v))
            ->when($filters['year_to'] ?? null, fn($q, $v) => $q->where('year', '<=', $v))
            ->when($filters['price_from'] ?? null, fn($q, $v) => $q->where('price', '>=', $v))
            ->when($filters['price_to'] ?? null, fn($q, $v) => $q->where('price', '<=', $v))
            ->when($filters['country'] ?? null, fn($q, $v) => $q->where('country', $v));
    }
}
