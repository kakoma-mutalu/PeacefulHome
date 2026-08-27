<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['invoice_id','booking_id','reference','method','amount','status','paid_at','notes'];
    protected $casts = ['amount'=>'decimal:2','paid_at'=>'datetime'];
    public function invoice(){ return $this->belongsTo(Invoice::class); }
    public function booking(){ return $this->belongsTo(Booking::class); }
}
