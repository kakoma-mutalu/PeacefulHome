@extends('layouts.app')
@section('content')
<div class="container py-5"><div class="mb-4"><h1>Services & Programmes</h1><p class="text-muted">Configure these offerings from the administration dashboard.</p></div>
<div class="row g-4">@foreach($services as $service)<div class="col-md-6 col-lg-4"><div class="card p-4 h-100"><h5>{{ $service->name }}</h5><div class="small text-green mb-2">{{ $service->category }} • {{ $service->duration_minutes }} min</div><p class="text-muted">{{ $service->description }}</p><div class="mt-auto"><strong>ZMW {{ number_format($service->price,2) }}</strong><a class="btn btn-green btn-sm float-end" href="{{ route('services.show',$service) }}">Details</a></div></div></div>@endforeach</div></div>
@endsection
