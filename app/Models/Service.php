<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name','slug','description','category','duration_minutes','duration_label','audience','involves','benefits','includes','price','is_active','is_programme'];
    protected $casts = ['price'=>'decimal:2','is_active'=>'boolean','is_programme'=>'boolean'];
    public function appointments(){ return $this->hasMany(Appointment::class); }
    public function bookings(){ return $this->hasMany(Booking::class); }
}
