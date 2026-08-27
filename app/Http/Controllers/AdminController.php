<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'patients'=>Patient::count(),
            'activePatients'=>Patient::where('status','active')->count(),
            'appointmentsToday'=>Appointment::whereDate('appointment_at',today())->count(),
            'pendingBookings'=>Booking::where('status','pending')->count(),
            'outstanding'=>Invoice::whereIn('status',['unpaid','partial'])->sum('amount'),
            'paid'=>Payment::where('status','paid')->sum('amount'),
            'upcoming'=>Appointment::with(['patient','service'])->where('appointment_at','>=',now())->orderBy('appointment_at')->take(8)->get()
        ]);
    }

    public function patients(Request $request)
    {
        $q=$request->string('q');
        $patients=Patient::when($q->isNotEmpty(),fn($x)=>$x->where(fn($w)=>$w->where('first_name','like',"%{$q}%")->orWhere('last_name','like',"%{$q}%")->orWhere('patient_number','like',"%{$q}%")))->latest()->paginate(12)->withQueryString();
        return view('admin.patients.index',compact('patients','q'));
    }

    public function createPatient(){ return view('admin.patients.create'); }

    public function storePatient(Request $request)
    {
        $data=$request->validate([
            'first_name'=>'required|max:80','last_name'=>'required|max:80','date_of_birth'=>'nullable|date',
            'gender'=>'nullable|in:Male,Female,Other','phone'=>'required|max:30','email'=>'nullable|email',
            'address'=>'nullable|max:500','emergency_contact_name'=>'nullable|max:120',
            'emergency_contact_phone'=>'nullable|max:30','status'=>'required|in:active,inactive,discharged',
            'notes'=>'nullable|max:2000'
        ]);
        $data['patient_number']='RC-PT-'.date('Y').'-'.str_pad((string)(Patient::withTrashed()->max('id')+1),6,'0',STR_PAD_LEFT);
        Patient::create($data);
        return redirect()->route('admin.patients')->with('success','Patient registered successfully.');
    }

    public function patient(Patient $patient){ return view('admin.patients.show',compact('patient')); }

    public function services()
    {
        return view('admin.services.index',['services'=>Service::latest()->get()]);
    }

    public function storeService(Request $request)
    {
        $data=$request->validate([
            'name'=>'required|max:150','description'=>'nullable|max:1000','category'=>'nullable|max:80',
            'duration_minutes'=>'required|integer|min:15|max:1440','price'=>'required|numeric|min:0'
        ]);
        $data['slug']=\Illuminate\Support\Str::slug($data['name']);
        $data['is_active']=true;
        Service::create($data);
        return back()->with('success','Service added.');
    }

    public function toggleService(Service $service)
    {
        $service->update(['is_active'=>!$service->is_active]);
        return back()->with('success','Service status updated.');
    }

    public function appointments()
    {
        return view('admin.appointments.index',[
            'appointments'=>Appointment::with(['patient','service','staff'])->orderBy('appointment_at')->paginate(20),
            'patients'=>Patient::where('status','active')->orderBy('last_name')->get(),
            'services'=>Service::where('is_active',true)->orderBy('name')->get(),
            'staff'=>User::whereIn('role',['SUPER ADMIN','MANAGER','CLINICAL','RECEPTION'])->orderBy('name')->get()
        ]);
    }

    public function storeAppointment(Request $request)
    {
        $data=$request->validate([
            'patient_id'=>'required|exists:patients,id','service_id'=>'required|exists:services,id',
            'staff_id'=>'nullable|exists:users,id','appointment_at'=>'required|date','notes'=>'nullable|max:1000'
        ]);
        $data['status']='scheduled';
        Appointment::create($data);
        return back()->with('success','Appointment scheduled.');
    }

    public function bookings()
    {
        return view('admin.bookings.index',['bookings'=>Booking::with('service')->latest()->paginate(20)]);
    }

    public function updateBooking(Request $request, Booking $booking)
    {
        $data=$request->validate(['status'=>'required|in:pending,confirmed,cancelled,completed','payment_status'=>'required|in:unpaid,paid,failed,refunded']);
        $booking->update($data);
        return back()->with('success','Booking updated.');
    }

    public function invoices()
    {
        return view('admin.invoices.index',['invoices'=>Invoice::with('patient')->latest()->paginate(20),'patients'=>Patient::where('status','active')->orderBy('last_name')->get()]);
    }

    public function storeInvoice(Request $request)
    {
        $data=$request->validate([
            'patient_id'=>'required|exists:patients,id','description'=>'required|max:255',
            'amount'=>'required|numeric|min:0.01','due_date'=>'required|date'
        ]);
        $data['invoice_number']='RC-INV-'.date('Y').'-'.str_pad((string)(Invoice::max('id')+1),6,'0',STR_PAD_LEFT);
        $data['status']='unpaid';
        Invoice::create($data);
        return back()->with('success','Invoice created.');
    }

    public function recordPayment(Request $request, Invoice $invoice)
    {
        $data=$request->validate(['amount'=>'required|numeric|min:0.01','method'=>'required|in:cash,bank,mobile_money,card','reference'=>'nullable|max:100','notes'=>'nullable|max:500']);
        $data += ['invoice_id'=>$invoice->id,'status'=>'paid','paid_at'=>now()];
        Payment::create($data);
        $paid=$invoice->payments()->where('status','paid')->sum('amount');
        $invoice->update(['status'=>$paid >= $invoice->amount ? 'paid':'partial','paid_at'=>$paid >= $invoice->amount ? now():null]);
        return back()->with('success','Payment recorded.');
    }
}
