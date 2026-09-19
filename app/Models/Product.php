<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'sku',
        'brand',
        'price',
        'cost_price',
        'stock',
        'image',
        'description',
        'status',
        'is_active',
    ];

    protected $casts = [
        'category_id' => 'integer',
        'price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'stock' => 'integer',
        'status' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        return filter_var($this->image, FILTER_VALIDATE_URL) ? $this->image : asset($this->image);
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }
}
