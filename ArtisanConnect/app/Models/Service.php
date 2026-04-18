<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'artisan_id',
        'title',
        'description',
        'price',
        'duration'
    ];
    public function artisan()
    {
        return $this->belongsTo(User::class, 'artisan_id');
    }
}
