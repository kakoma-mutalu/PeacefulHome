<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Peaceful Home Rehabilitation Centre | Lusaka, Zambia' }}</title>
    <meta name="description" content="Peaceful Home Rehabilitation Centre in Meanwood Ndeke Phase 1, Lusaka, provides structured rehabilitation and recovery support in a safe, supportive environment.">
    <meta property="og:title" content="Peaceful Home Rehabilitation Centre">
    <meta property="og:description" content="A new beginning. A better life.">
    @vite(['resources/css/app.css']) 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="public-body">
    <div class="contact-strip">
        <div class="container d-flex justify-content-between flex-wrap gap-2">
            <span><i class="bi bi-geo-alt"></i> Meanwood Ndeke Phase 1, Lusaka</span>
            <span>
                <a href="tel:0572162529">Call 0572162529</a>
                <span class="mx-2">|</span>
                <a href="https://wa.me/260572162529" target="_blank" rel="noopener">WhatsApp us</a>
            </span>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg public-nav sticky-top">
        <div class="container">
            <a class="navbar-brand public-brand" href="{{ route('home') }}">
                <span class="brand-mark"><i class="bi bi-house-heart-fill"></i></span>
                <span>Peaceful Home<small>Rehabilitation Centre</small></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#publicNavigation" aria-controls="publicNavigation" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list"></i>
            </button>
            <div class="collapse navbar-collapse" id="publicNavigation">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('services') }}">Services</a></li>
                    <li><a href="{{ route('programmes') }}">Programmes</a></li>
                    <li><a href="{{ route('expect') }}">What to Expect</a></li>
                    <li><a href="{{ route('admissions') }}">Admissions</a></li>
                    <li><a href="{{ route('faqs') }}">FAQs</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                </ul>
                <a class="btn btn-green ms-lg-3 mt-3 mt-lg-0" href="{{ route('booking') }}">Start Your Recovery</a>
            </div>
        </div>
    </nav>

    @if (session('success'))
        <div class="container pt-3">
            <div class="alert alert-success">{{ session('success') }}</div>
        </div>
    @endif

    @if ($errors->any())
        <div class="container pt-3">
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @yield('content')

    <footer class="public-footer">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h3>Peaceful Home</h3>
                    <p class="footer-tagline">A New Beginning. A Better Life.</p>
                    <p>Private, professional rehabilitation and recovery support in Lusaka.</p>
                </div>
                <div class="col-6 col-lg-2">
                    <h5>Explore</h5>
                    <a href="{{ route('about') }}">About</a>
                    <a href="{{ route('services') }}">Services</a>
                    <a href="{{ route('programmes') }}">Programmes</a>
                    <a href="{{ route('admissions') }}">Admissions</a>
                </div>
                <div class="col-6 col-lg-3">
                    <h5>Support</h5>
                    <a href="{{ route('booking') }}">Reservations</a>
                    <a href="{{ route('faqs') }}">FAQs</a>
                    <a href="{{ route('privacy') }}">Privacy Policy</a>
                    <a href="{{ route('payment-policy') }}">Payment Policy</a>
                </div>
                <div class="col-lg-3">
                    <h5>Contact</h5>
                    <p>Meanwood Ndeke Phase 1<br>Lusaka, Zambia</p>
                    <a href="tel:0572162529">0572162529</a>
                    <a href="tel:0979155132">0979155132</a>
                    <a href="tel:0979136027">0979136027</a>
                </div>
            </div>
            <div class="footer-bottom">
                &copy; {{ date('Y') }} Peaceful Home Rehabilitation Centre
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
