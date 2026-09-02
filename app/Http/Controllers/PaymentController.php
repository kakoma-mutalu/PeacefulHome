<?php
namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\Payment;
use App\Services\AirtelMoneyService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function show(Booking $booking) { return view('public.payment', compact('booking')); }
    public function store(Request $request, Booking $booking, AirtelMoneyService $airtel)
    {
        $data = $request->validate(['payment_method'=>'required|in:airtel_money,pay_later','phone_number'=>'nullable|required_if:payment_method,airtel_money|string|max:30']);
        $payment = Payment::create([
            'booking_id'=>$booking->id, 'reference'=>'PH-PAY-'.strtoupper(Str::random(10)),
            'payment_reference'=>'PH-PAY-'.date('Y').'-'.str_pad((string)(Payment::max('id') + 1),6,'0',STR_PAD_LEFT),
            'provider'=>$data['payment_method'] === 'airtel_money' ? 'airtel_money' : 'offline', 'method'=>$data['payment_method'],
            'amount'=>$booking->amount, 'currency'=>'ZMW', 'phone_number'=>$data['phone_number'] ?? null,
            'status'=>'pending', 'initiated_at'=>now(), 'notes'=>'Created from public reservation flow.',
        ]);
        $message = $data['payment_method'] === 'airtel_money' ? $airtel->initiate($payment)['message'] : 'Your reservation is recorded as pending payment. Please contact Peaceful Home to arrange payment.';
        return redirect()->route('payments.status', [$booking, $payment])->with('success', $message);
    }
    public function status(Booking $booking, Payment $payment) { abort_unless($payment->booking_id === $booking->id, 404); return view('public.payment-status', compact('booking','payment')); }
}
