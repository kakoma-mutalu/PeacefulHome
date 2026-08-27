<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id','patient_number','first_name','last_name','date_of_birth',
        'gender','phone','email','address','emergency_contact_name',
        'emergency_contact_phone','status','notes'
    ];

    protected $casts = ['date_of_birth' => 'date'];

    public function user(){ return $this->belongsTo(User::class); }
    public function appointments(){ return $this->hasMany(Appointment::class); }
    public function bookings(){ return $this->hasMany(Booking::class); }
    public function invoices(){ return $this->hasMany(Invoice::class); }
}
