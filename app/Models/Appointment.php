<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['patient_id','service_id','staff_id','appointment_at','status','notes'];
    protected $casts = ['appointment_at'=>'datetime'];

    public function patient(){ return $this->belongsTo(Patient::class); }
    public function service(){ return $this->belongsTo(Service::class); }
    public function staff(){ return $this->belongsTo(User::class,'staff_id'); }
}
