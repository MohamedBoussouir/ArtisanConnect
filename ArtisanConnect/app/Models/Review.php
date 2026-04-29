<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['user_id', 'artisan_id', 'comment', 'rating'];
    public function client()
    {
        
        return $this->belongsTo(User::class, 'user_id');
    }
}
