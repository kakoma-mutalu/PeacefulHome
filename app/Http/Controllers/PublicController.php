<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Booking;
use App\Models\Testimonial;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class PublicController extends Controller
{
    public function home(){ return view('public.home', ['services'=>$this->publicServices()->take(6)->get(), 'programmes'=>$this->programmeServices()->take(3)->get(), 'testimonials'=>Schema::hasTable('testimonials') ? Testimonial::where('is_active',true)->take(3)->get() : collect()]); }
    public function services(){ return view('public.services', ['services'=>$this->publicServices()->orderBy('name')->get()]); }
    public function programmes(){ return view('public.programmes', ['programmes'=>$this->programmeServices()->orderBy('price')->get()]); }
    public function showService(Service $service){ abort_unless($service->is_active,404); return view('public.service', compact('service')); }

    public function booking()
    {
        return view('public.booking', ['services'=>Service::where('is_active',true)->when(Schema::hasColumn('services', 'is_programme'), fn ($query) => $query->orderBy('is_programme','desc'))->orderBy('name')->get()]);
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
    public function page(string $page)
    {
        abort_unless(in_array($page, ['about','expect','admissions','faqs','contact','privacy','terms','payment-policy'], true), 404);
        return view('public.'.$page);
    }
    public function contact(Request $request)
    {
        $data=$request->validate(['full_name'=>'required|string|max:120','phone'=>'required|string|max:30','email'=>'nullable|email|max:190','subject'=>'required|string|max:160','message'=>'required|string|max:3000']);
        Enquiry::create($data);
        return back()->with('success','Thank you. Your enquiry has been received and Peaceful Home will be in touch.');
    }

    private function publicServices()
    {
        return Service::where('is_active', true)->when(Schema::hasColumn('services', 'is_programme'), fn ($query) => $query->where('is_programme', false));
    }

    private function programmeServices()
    {
        return Service::where('is_active', true)->when(Schema::hasColumn('services', 'is_programme'), fn ($query) => $query->where('is_programme', true), fn ($query) => $query->where('category', 'Programme'));
    }
}
