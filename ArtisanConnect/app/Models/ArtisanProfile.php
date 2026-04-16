<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArtisanProfile extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'bio',
        'is_available',
        'rating_cache',
        'views_count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function portfolios()
    {
        return $this->hasMany(Portfolio::class, 'artisan_id', 'user_id');
    }
}
