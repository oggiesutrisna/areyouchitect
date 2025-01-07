<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'icon',
        'price',
        'is_featured',
    ];

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
        ];
    }
}
