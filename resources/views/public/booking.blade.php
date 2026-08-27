@extends('layouts.app')
@section('content')
<div class="container py-5"><div class="row justify-content-center"><div class="col-lg-8"><div class="card p-4 p-md-5"><h1>Reserve an appointment</h1><p class="text-muted">Submit your preferred date and time. Staff can confirm availability from the administration dashboard.</p>
<form method="POST" action="{{ route('booking.store') }}">@csrf
<div class="row g-3">
<div class="col-md-6"><label class="form-label">Service</label><select name="service_id" class="form-select" required>@foreach($services as $s)<option value="{{ $s->id }}">{{ $s->name }} — ZMW {{ number_format($s->price,2) }}</option>@endforeach</select></div>
<div class="col-md-6"><label class="form-label">Full name</label><input name="customer_name" class="form-control" required></div>
<div class="col-md-6"><label class="form-label">Email</label><input name="customer_email" type="email" class="form-control" required></div>
<div class="col-md-6"><label class="form-label">Phone</label><input name="customer_phone" class="form-control" required></div>
<div class="col-md-6"><label class="form-label">Preferred date</label><input name="booking_date" type="date" min="{{ date('Y-m-d') }}" class="form-control" required></div>
<div class="col-md-6"><label class="form-label">Preferred time</label><input name="booking_time" type="time" class="form-control" required></div>
<div class="col-12"><label class="form-label">Notes</label><textarea name="notes" class="form-control" rows="4"></textarea></div>
<div class="col-12"><button class="btn btn-green btn-lg w-100">Submit reservation</button></div>
</div></form></div></div></div></div>
@endsection
