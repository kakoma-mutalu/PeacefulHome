<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class PortalController extends Controller
{
    public function dashboard()
    {
        $patient=Auth::user()->patient;
        return view('portal.dashboard',[
            'patient'=>$patient,
            'appointments'=>$patient?->appointments()->with('service')->where('appointment_at','>=',now())->orderBy('appointment_at')->take(5)->get() ?? collect(),
            'bookings'=>$patient?->bookings()->with('service')->latest()->take(5)->get() ?? collect(),
            'invoices'=>$patient?->invoices()->latest()->take(5)->get() ?? collect(),
        ]);
    }
}
