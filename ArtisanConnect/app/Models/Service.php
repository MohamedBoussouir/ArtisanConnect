<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'artisan_id',
        'category_id',
        'title',
        'description',
        'price',
        'duration'
    ];
    public function artisan()
    {
        return $this->belongsTo(User::class, 'artisan_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
