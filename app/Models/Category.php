<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'type',
    ];

    const TYPE_POST = 'post';

    const TYPE_SERVICE = 'service';

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'categorizable');
    }

    public function services()
    {
        return $this->morphedByMany(Service::class, 'categorizable');
    }

    public function scopeForPosts($query)
    {
        return $query->where('type', self::TYPE_POST);
    }

    public function scopeForServices($query)
    {
        return $query->where('type', self::TYPE_SERVICE);
    }
}
