@extends('layouts.app')
@section('content')
<div class="container py-5"><div class="card p-5"><span class="text-green fw-bold">{{ $service->category }}</span><h1 class="mt-2">{{ $service->name }}</h1><p class="lead text-muted">{{ $service->description }}</p><div class="mb-4">Duration: <strong>{{ $service->duration_minutes }} minutes</strong> &nbsp; • &nbsp; Price: <strong>ZMW {{ number_format($service->price,2) }}</strong></div><a class="btn btn-green btn-lg" href="{{ route('booking',['service'=>$service->id]) }}">Reserve this service</a></div></div>
@endsection
