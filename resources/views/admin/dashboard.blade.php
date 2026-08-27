@extends('layouts.admin')
@section('admin')
<div class="d-flex justify-content-between align-items-center mb-4"><div><h1 class="mb-1">Dashboard</h1><p class="text-muted mb-0">Good day, {{ auth()->user()->name }}.</p></div></div>
<div class="row g-3 mb-4">
@foreach([['Patients',$patients,'bi-people'],['Active patients',$activePatients,'bi-person-check'],['Appointments today',$appointmentsToday,'bi-calendar-day'],['Pending bookings',$pendingBookings,'bi-calendar-check'],['Outstanding','ZMW '.number_format($outstanding,2),'bi-cash-stack'],['Payments received','ZMW '.number_format($paid,2),'bi-wallet2']] as $s)
<div class="col-sm-6 col-xl-4"><div class="card p-4 stat"><div class="d-flex justify-content-between"><div><div class="text-muted small">{{ $s[0] }}</div><div class="fs-3 fw-bold">{{ $s[1] }}</div></div><i class="bi {{ $s[2] }} fs-2 text-green"></i></div></div></div>
@endforeach</div>
<div class="card p-4"><h5>Upcoming appointments</h5><div class="table-responsive"><table class="table align-middle"><thead><tr><th>Patient</th><th>Service</th><th>Date</th><th>Status</th></tr></thead><tbody>@forelse($upcoming as $a)<tr><td>{{ $a->patient->first_name }} {{ $a->patient->last_name }}</td><td>{{ $a->service->name }}</td><td>{{ $a->appointment_at->format('d M Y H:i') }}</td><td><span class="badge badge-soft">{{ ucfirst($a->status) }}</span></td></tr>@empty<tr><td colspan="4" class="text-muted">No upcoming appointments.</td></tr>@endforelse</tbody></table></div></div>
@endsection
