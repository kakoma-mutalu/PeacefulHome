<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['invoice_number','patient_id','booking_id','description','amount','status','due_date','paid_at'];
    protected $casts = ['amount'=>'decimal:2','due_date'=>'date','paid_at'=>'datetime'];
    public function patient(){ return $this->belongsTo(Patient::class); }
    public function booking(){ return $this->belongsTo(Booking::class); }
    public function payments(){ return $this->hasMany(Payment::class); }
}
