<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['invoice_id','booking_id','reference','payment_reference','provider','provider_transaction_id','method','amount','currency','phone_number','status','initiated_at','completed_at','failure_reason','provider_response','paid_at','notes'];
    protected $casts = ['amount'=>'decimal:2','paid_at'=>'datetime','initiated_at'=>'datetime','completed_at'=>'datetime','provider_response'=>'array'];
    public function invoice(){ return $this->belongsTo(Invoice::class); }
    public function booking(){ return $this->belongsTo(Booking::class); }
}
