<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ $title ?? config('app.name') }}</title>
    @vite(['resources/css/app.css'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root{--navy:#0b2a5b;--navy2:#071d40;--green:#47752a;--green2:#6f9638;--bg:#f7f9f6;--ink:#263238}
        body{background:var(--bg);color:var(--ink);font-family:Inter,system-ui,-apple-system,Segoe UI,sans-serif}
        .navbar,.sidebar{background:var(--navy)!important}.brand{font-weight:800;letter-spacing:.3px}
        .brand-mark{display:inline-flex;width:38px;height:38px;border-radius:50%;align-items:center;justify-content:center;background:#fff;color:var(--green);font-size:20px}
        .hero{background:linear-gradient(135deg,var(--navy),#163d78);color:#fff;border-radius:0 0 28px 28px}
        .btn-green{background:var(--green);color:#fff;border:0}.btn-green:hover{background:#385d22;color:#fff}
        .text-green{color:var(--green)!important}.card{border:0;border-radius:18px;box-shadow:0 8px 30px rgba(11,42,91,.07)}
        .stat{border-left:4px solid var(--green)}.sidebar{min-height:calc(100vh - 56px);width:245px}.sidebar a{color:#dce8f6;text-decoration:none;border-radius:10px}
        .sidebar a:hover,.sidebar a.active{background:rgba(255,255,255,.12);color:#fff}.main{min-height:calc(100vh - 56px)}
        .table>:not(caption)>*>*{padding:.8rem}.badge-soft{background:#e8f0e3;color:var(--green)}
    </style>
</head>
<body>
<nav class="navbar navbar-dark px-3 py-2">
    <a class="navbar-brand brand d-flex align-items-center gap-2" href="{{ route('home') }}">
        <span class="brand-mark"><i class="bi bi-heart-pulse"></i></span> Peaceful Home
    </a>
    <div class="d-flex align-items-center gap-2">
        @auth
            <span class="text-white-50 small d-none d-md-inline">{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">@csrf<button class="btn btn-sm btn-outline-light">Logout</button></form>
        @else
            <a class="btn btn-sm btn-outline-light" href="{{ route('login') }}">Staff / Patient Login</a>
        @endauth
    </div>
</nav>
@if(session('success'))<div class="container mt-3"><div class="alert alert-success">{{ session('success') }}</div></div>@endif
@if(session('error'))<div class="container mt-3"><div class="alert alert-danger">{{ session('error') }}</div></div>@endif
@if($errors->any())<div class="container mt-3"><div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div></div>@endif
{{ $slot ?? '' }}
@yield('content')
</body>
</html>
