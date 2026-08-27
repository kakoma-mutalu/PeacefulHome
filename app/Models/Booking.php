<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'booking_number','patient_id','service_id','customer_name','customer_email',
        'customer_phone','booking_date','booking_time','status','payment_status',
        'amount','notes'
    ];

    protected $casts = ['booking_date'=>'date','amount'=>'decimal:2'];

    public function patient(){ return $this->belongsTo(Patient::class); }
    public function service(){ return $this->belongsTo(Service::class); }
}
