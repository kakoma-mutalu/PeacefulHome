@extends('layouts.app')
@section('content')
<section class="hero py-5">
<div class="container py-4"><div class="row align-items-center g-5">
<div class="col-lg-7">
<span class="badge rounded-pill bg-light text-dark mb-3">A new beginning • A better life</span>
<h1 class="display-4 fw-bold">Recovery is possible. <span class="text-warning">We can help.</span></h1>
<p class="lead text-white-50">A modern rehabilitation management platform designed around compassionate care, structured recovery and a connected patient journey.</p>
<div class="d-flex gap-2 flex-wrap"><a class="btn btn-light btn-lg" href="{{ route('booking') }}">Book a consultation</a><a class="btn btn-outline-light btn-lg" href="{{ route('services') }}">Explore services</a></div>
</div>
<div class="col-lg-5"><div class="card p-4 text-dark"><div class="d-flex align-items-center gap-3"><span class="brand-mark"><i class="bi bi-house-heart"></i></span><div><h4 class="mb-0">Peaceful-Home</h4><small class="text-muted">Heal • Restore • Rebuild • Renew</small></div></div><hr><p class="mb-0">Private, structured and supportive rehabilitation services with appointments, reservations and patient support in one place.</p></div></div>
</div></div>
</section>
<div class="container py-5">
<div class="text-center mb-4"><h2>Our services</h2><p class="text-muted">Start with the support that fits your recovery journey.</p></div>
<div class="row g-4">@foreach($services as $service)<div class="col-md-6 col-lg-4"><div class="card h-100 p-4"><span class="badge badge-soft align-self-start mb-3">{{ $service->category }}</span><h5>{{ $service->name }}</h5><p class="text-muted">{{ $service->description }}</p><div class="mt-auto d-flex justify-content-between align-items-center"><strong>ZMW {{ number_format($service->price,2) }}</strong><a href="{{ route('services.show',$service) }}" class="btn btn-sm btn-green">View</a></div></div></div>@endforeach</div>
</div>
@endsection
