<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Booking;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home(){ return view('public.home', ['services'=>Service::where('is_active',true)->latest()->take(6)->get()]); }
    public function services(){ return view('public.services', ['services'=>Service::where('is_active',true)->orderBy('name')->get()]); }
    public function showService(Service $service){ abort_unless($service->is_active,404); return view('public.service', compact('service')); }

    public function booking()
    {
        return view('public.booking', ['services'=>Service::where('is_active',true)->orderBy('name')->get()]);
    }

    public function storeBooking(Request $request)
    {
        $data = $request->validate([
            'service_id'=>'required|exists:services,id',
            'customer_name'=>'required|string|max:120',
            'customer_email'=>'required|email|max:190',
            'customer_phone'=>'required|string|max:30',
            'booking_date'=>'required|date|after_or_equal:today',
            'booking_time'=>'required',
            'notes'=>'nullable|string|max:1000'
        ]);

        $service = Service::findOrFail($data['service_id']);
        $booking = Booking::create($data + [
            'booking_number'=>'RC-BK-'.date('Y').'-'.str_pad((string)(Booking::max('id')+1),6,'0',STR_PAD_LEFT),
            'amount'=>$service->price,
            'status'=>'pending',
            'payment_status'=>'unpaid'
        ]);

        return redirect()->route('booking.confirmation',$booking)->with('success','Reservation received. Payment can be recorded from the confirmation screen.');
    }

    public function confirmation(Booking $booking){ return view('public.confirmation', compact('booking')); }
}
