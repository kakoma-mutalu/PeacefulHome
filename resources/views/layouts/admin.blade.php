@extends('layouts.app')
@section('content')
<div class="d-flex">
<aside class="sidebar p-3 d-none d-lg-block">
<div class="text-white-50 small text-uppercase mb-2">Workspace</div>
<a class="d-block p-2 mb-1" href="{{ route('admin.dashboard') }}"><i class="bi bi-grid me-2"></i>Dashboard</a>
<a class="d-block p-2 mb-1" href="{{ route('admin.patients') }}"><i class="bi bi-people me-2"></i>Patients</a>
<a class="d-block p-2 mb-1" href="{{ route('admin.appointments') }}"><i class="bi bi-calendar3 me-2"></i>Appointments</a>
<a class="d-block p-2 mb-1" href="{{ route('admin.bookings') }}"><i class="bi bi-calendar-check me-2"></i>Reservations</a>
<a class="d-block p-2 mb-1" href="{{ route('admin.services') }}"><i class="bi bi-heart-pulse me-2"></i>Services</a>
<a class="d-block p-2 mb-1" href="{{ route('admin.invoices') }}"><i class="bi bi-receipt me-2"></i>Billing</a>
</aside>
<main class="main flex-grow-1 p-3 p-md-4">@yield('admin')</main>
</div>
@endsection
