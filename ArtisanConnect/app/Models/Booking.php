<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'service_id',
        'artisan_id',
        'appointment_date',
        'appointment_time',
        'duration_hours',
        'issue_description',
        'status',
        'duration_hours'
    ];
    public function service()
    {
        return $this->belongsTo(Service::class);
    }


    public function client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function artisan()
    {
        return $this->belongsTo(User::class, 'artisan_id');
    }
}
