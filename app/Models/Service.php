<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name','slug','description','category','duration_minutes','price','is_active'];
    protected $casts = ['price'=>'decimal:2','is_active'=>'boolean'];
    public function appointments(){ return $this->hasMany(Appointment::class); }
    public function bookings(){ return $this->hasMany(Booking::class); }
}
