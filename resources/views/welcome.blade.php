<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Handy Hub - Handyman Services</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/bootstap/bootstap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">

<style>
/* ═══════════════════════════════════════════════
   ANIMATED HERO BACKGROUND + GLASSMORPHISM FORM
═══════════════════════════════════════════════ */

/* ── Hero Override ── */
.hero-section {
    position: relative;
    overflow: hidden;
    background: linear-gradient(135deg, #0f0f1a 0%, #1a0a2e 40%, #0d1117 100%) !important;
    min-height: 100vh;
}

/* ── Animated Gradient Overlay ── */
.hero-section::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse at 20% 50%, rgba(249,115,22,0.12) 0%, transparent 60%),
        radial-gradient(ellipse at 80% 20%, rgba(234,88,12,0.08) 0%, transparent 50%),
        radial-gradient(ellipse at 60% 80%, rgba(124,58,237,0.08) 0%, transparent 50%);
    animation: bgPulse 8s ease-in-out infinite alternate;
    pointer-events: none;
    z-index: 0;
}

@keyframes bgPulse {
    0%   { opacity: 0.6; transform: scale(1); }
    100% { opacity: 1;   transform: scale(1.05); }
}

/* ── Canvas ── */
#particleCanvas {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    pointer-events: none;
    z-index: 1;
}

/* ── Floating Icons ── */
.floating-icon {
    position: absolute;
    color: rgba(249,115,22,0.08);
    font-size: clamp(28px, 5vw, 60px);
    animation: floatIcon linear infinite;
    pointer-events: none;
    z-index: 1;
}

@keyframes floatIcon {
    0%   { transform: translateY(110vh) rotate(0deg);   opacity: 0; }
    5%   { opacity: 1; }
    95%  { opacity: 0.6; }
    100% { transform: translateY(-120px) rotate(360deg); opacity: 0; }
}

/* ── Hero content on top ── */
.hero-section .container { position: relative; z-index: 2; }

/* ── Text colors on dark bg ── */
.hero-title { color: #fff !important; }
.hero-title span { color: #f97316 !important; }
.hero-section .lead { color: rgba(255,255,255,0.7) !important; }
.hero-section .text-muted { color: rgba(255,255,255,0.55) !important; }
.hero-section h4.fw-bold { color: #fff !important; }
.hero-section .border-start { border-color: rgba(255,255,255,0.2) !important; }

/* ── Glass Form ── */
.hero-card {
    background: rgba(255, 255, 255, 0.07) !important;
    backdrop-filter: blur(24px) saturate(150%) !important;
    -webkit-backdrop-filter: blur(24px) saturate(150%) !important;
    border: 1px solid rgba(255, 255, 255, 0.15) !important;
    border-radius: 24px !important;
    box-shadow:
        0 30px 60px rgba(0, 0, 0, 0.4),
        inset 0 1px 0 rgba(255,255,255,0.1) !important;
    padding: 36px !important;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hero-card:hover {
    transform: translateY(-4px) !important;
    box-shadow:
        0 40px 80px rgba(0, 0, 0, 0.5),
        inset 0 1px 0 rgba(255,255,255,0.15) !important;
}

.hero-card h4 { color: #fff !important; }

/* Glass form inputs */
.hero-card .form-select,
.hero-card .form-control {
    background: rgba(255,255,255,0.08) !important;
    border: 1px solid rgba(255,255,255,0.15) !important;
    color: #fff !important;
    border-radius: 12px !important;
    padding: 14px 18px !important;
    font-size: 15px !important;
    transition: all 0.3s ease;
}

.hero-card .form-select:focus,
.hero-card .form-control:focus {
    background: rgba(255,255,255,0.12) !important;
    border-color: rgba(249,115,22,0.6) !important;
    box-shadow: 0 0 0 3px rgba(249,115,22,0.15) !important;
    color: #fff !important;
    outline: none !important;
}

.hero-card .form-select option { background: #1a0a2e; color: #fff; }

.hero-card .form-control::placeholder { color: rgba(255,255,255,0.45) !important; }

/* Glass Find Providers button */
.hero-card .btn-primary-custom {
    background: linear-gradient(135deg, #f97316, #ea580c) !important;
    border: none !important;
    border-radius: 14px !important;
    padding: 14px !important;
    font-weight: 700 !important;
    font-size: 16px !important;
    box-shadow: 0 8px 24px rgba(249,115,22,0.4) !important;
    transition: all 0.3s ease !important;
    letter-spacing: 0.3px;
}

.hero-card .btn-primary-custom:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 12px 32px rgba(249,115,22,0.55) !important;
}

/* ── Glass top edge glow ── */
.hero-card::before {
    content: '';
    position: absolute;
    top: 0; left: 10%; right: 10%;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(249,115,22,0.5), transparent);
    border-radius: 50%;
}
.hero-card { position: relative; }

/* ── Stats ── */
.hero-section .stat-num { color: #fff !important; }

/* ── Navbar on dark bg ── */
.navbar {
    background: rgba(15,15,26,0.85) !important;
    backdrop-filter: blur(12px) !important;
    border-bottom: 1px solid rgba(255,255,255,0.06) !important;
}
</style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-tools me-2"></i>Handy Hub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#how-it-works">How it Works</a></li>
                    <li class="nav-item"><a class="nav-link" href="#testimonials">Testimonials</a></li>
                    <li class="nav-item ms-lg-3">
                        <a href="{{ route('auth.register') }}" class="btn btn-primary-custom">Become a Provider</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section d-flex align-items-center">

        <!-- Particle Canvas -->
        <canvas id="particleCanvas"></canvas>

        <!-- Floating Tool Icons -->
        <i class="fas fa-hammer floating-icon" style="left:5%;  animation-duration:18s; animation-delay:0s;   font-size:48px;"></i>
        <i class="fas fa-wrench floating-icon" style="left:15%; animation-duration:22s; animation-delay:3s;   font-size:36px;"></i>
        <i class="fas fa-bolt   floating-icon" style="left:75%; animation-duration:16s; animation-delay:1s;   font-size:40px;"></i>
        <i class="fas fa-faucet floating-icon" style="left:85%; animation-duration:20s; animation-delay:5s;   font-size:32px;"></i>
        <i class="fas fa-paint-roller floating-icon" style="left:60%; animation-duration:25s; animation-delay:8s; font-size:44px;"></i>
        <i class="fas fa-tools  floating-icon" style="left:90%; animation-duration:19s; animation-delay:2s;   font-size:38px;"></i>
        <i class="fas fa-broom  floating-icon" style="left:40%; animation-duration:23s; animation-delay:6s;   font-size:30px;"></i>
        <i class="fas fa-wind   floating-icon" style="left:28%; animation-duration:21s; animation-delay:10s;  font-size:34px;"></i>

        <div class="container">
            <div class="row align-items-center">

                <!-- Left: Content -->
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="reveal active">
                        <h1 class="hero-title">Expert Handyman <span>Services</span> At Your Doorstep</h1>
                        <p class="lead mb-4">Connect with verified professionals for all your home repair needs. From plumbing to electrical, we fix it all.</p>
                        <div class="d-flex gap-3 flex-wrap">
                            <a href="{{ route('seeker.services.create') }}" class="btn btn-primary-custom btn-lg">Book a Service</a>
                            <a href="#services" class="btn btn-lg rounded-pill px-4" style="border:2px solid rgba(255,255,255,0.3);color:#fff;">Explore Services</a>
                        </div>

                        <div class="mt-5 d-flex gap-4">
                            <div>
                                <h4 class="fw-bold mb-0 stat-num">15k+</h4>
                                <small class="text-muted">Services Done</small>
                            </div>
                            <div class="border-start ps-4">
                                <h4 class="fw-bold mb-0 stat-num">500+</h4>
                                <small class="text-muted">Experts</small>
                            </div>
                            <div class="border-start ps-4">
                                <h4 class="fw-bold mb-0 stat-num">4.9/5</h4>
                                <small class="text-muted">Rating</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Glass Form -->
                <div class="col-lg-6">
                    <div class="hero-card" id="booking">
                        <h4 class="mb-4 fw-bold">Book a Service Now</h4>
                        <form>
                            <div class="mb-3">
                                <select class="form-select form-select-lg">
                                    <option selected>Select a Service</option>
                                    <option>Plumbing</option>
                                    <option>Electrical</option>
                                    <option>Carpentry</option>
                                    <option>Painting</option>
                                    <option>AC Repair</option>
                                    <option>Cleaning</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control form-control-lg" placeholder="Your Location / Address">
                            </div>
                            <div class="mb-3">
                                <input type="date" class="form-control form-control-lg">
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" rows="3" placeholder="Describe the issue..."></textarea>
                            </div>
                            <a href="{{ route('seeker.services.create') }}" class="btn btn-primary-custom w-100 btn-lg">
                                <i class="fas fa-search me-2"></i>Find Providers
                            </a>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mb-5 reveal">
                <h6 class="text-uppercase text-primary fw-bold">Our Services</h6>
                <h2 class="fw-bold display-5">What We Offer</h2>
                <p class="text-muted">Comprehensive home maintenance solutions for Service Seekers</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4 reveal">
                    <div class="service-card">
                        <div class="service-icon"><i class="fas fa-faucet"></i></div>
                        <h4>Plumbing</h4>
                        <p class="text-muted">Leak repairs, pipe installations, drain cleaning, and bathroom fittings by certified plumbers.</p>
                    </div>
                </div>
                <div class="col-md-4 reveal">
                    <div class="service-card">
                        <div class="service-icon"><i class="fas fa-bolt"></i></div>
                        <h4>Electrical</h4>
                        <p class="text-muted">Wiring, fixture installation, panel upgrades, and emergency electrical repairs.</p>
                    </div>
                </div>
                <div class="col-md-4 reveal">
                    <div class="service-card">
                        <div class="service-icon"><i class="fas fa-paint-roller"></i></div>
                        <h4>Painting</h4>
                        <p class="text-muted">Interior and exterior painting, wall preparation, and decorative finishes.</p>
                    </div>
                </div>
                <div class="col-md-4 reveal">
                    <div class="service-card">
                        <div class="service-icon"><i class="fas fa-hammer"></i></div>
                        <h4>Carpentry</h4>
                        <p class="text-muted">Furniture repair, custom woodwork, door installations, and shelving.</p>
                    </div>
                </div>
                <div class="col-md-4 reveal">
                    <div class="service-card">
                        <div class="service-icon"><i class="fas fa-wind"></i></div>
                        <h4>AC & HVAC</h4>
                        <p class="text-muted">AC installation, servicing, gas refilling, and heating system maintenance.</p>
                    </div>
                </div>
                <div class="col-md-4 reveal">
                    <div class="service-card">
                        <div class="service-icon"><i class="fas fa-broom"></i></div>
                        <h4>Cleaning</h4>
                        <p class="text-muted">Deep cleaning, sofa shampooing, kitchen cleaning, and move-in/move-out services.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works — Enhanced -->
    <style>
    /* ── How It Works Enhanced Styles ── */
    .hiw-section {
        background: #f8f9ff;
        position: relative;
        overflow: hidden;
    }
    .hiw-section::before {
        content: '';
        position: absolute;
        top: -120px; right: -120px;
        width: 400px; height: 400px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(249,115,22,0.06) 0%, transparent 70%);
        pointer-events: none;
    }

    /* Section header badge */
    .hiw-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, rgba(249,115,22,0.12), rgba(234,88,12,0.08));
        border: 1px solid rgba(249,115,22,0.25);
        color: #ea580c;
        padding: 6px 18px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 16px;
    }

    /* Timeline steps */
    .timeline-steps { position: relative; padding-left: 0; }

    .timeline-step {
        display: flex;
        gap: 24px;
        align-items: flex-start;
        position: relative;
        margin-bottom: 0;
        padding-bottom: 36px;
    }
    .timeline-step:last-child { padding-bottom: 0; }

    /* Vertical connecting line */
    .timeline-step:not(:last-child)::after {
        content: '';
        position: absolute;
        left: 28px;
        top: 58px;
        width: 2px;
        height: calc(100% - 22px);
        background: linear-gradient(180deg, #f97316 0%, rgba(249,115,22,0.15) 100%);
    }

    /* Step circle */
    .step-circle {
        flex-shrink: 0;
        width: 58px;
        height: 58px;
        border-radius: 50%;
        background: linear-gradient(135deg, #f97316, #ea580c);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 20px rgba(249,115,22,0.35);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        z-index: 1;
    }
    .step-circle i { color: #fff; font-size: 20px; }

    .timeline-step:hover .step-circle {
        transform: scale(1.1);
        box-shadow: 0 12px 28px rgba(249,115,22,0.45);
    }

    /* Step content card */
    .step-content {
        background: #fff;
        border-radius: 16px;
        padding: 20px 24px;
        flex: 1;
        border: 1px solid rgba(0,0,0,0.06);
        box-shadow: 0 4px 16px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        position: relative;
    }
    .step-content::before {
        content: '';
        position: absolute;
        left: -8px; top: 18px;
        width: 16px; height: 16px;
        background: #fff;
        border-left: 1px solid rgba(0,0,0,0.06);
        border-bottom: 1px solid rgba(0,0,0,0.06);
        transform: rotate(45deg);
    }
    .timeline-step:hover .step-content {
        box-shadow: 0 8px 28px rgba(249,115,22,0.12);
        border-color: rgba(249,115,22,0.2);
        transform: translateX(4px);
    }

    .step-num-label {
        font-size: 11px;
        font-weight: 700;
        color: #f97316;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 4px;
    }
    .step-content h5 {
        font-size: 17px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 6px;
    }
    .step-content p {
        font-size: 14px;
        color: #6b7280;
        margin: 0;
        line-height: 1.6;
    }

    /* Image wrapper */
    .hiw-img-wrap {
        position: relative;
    }
    .hiw-img-wrap img {
        border-radius: 24px;
        width: 100%;
        object-fit: cover;
        box-shadow: 0 20px 50px rgba(0,0,0,0.15);
        transition: transform 0.4s ease;
    }
    .hiw-img-wrap:hover img { transform: scale(1.02); }

    /* Floating badge on image */
    .img-float-badge {
        position: absolute;
        bottom: 24px; left: -20px;
        background: #fff;
        border-radius: 16px;
        padding: 14px 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.12);
        display: flex; align-items: center; gap: 12px;
        animation: floatBadge 3s ease-in-out infinite;
    }
    @keyframes floatBadge {
        0%,100% { transform: translateY(0); }
        50%      { transform: translateY(-8px); }
    }
    .img-float-badge .badge-icon {
        width: 42px; height: 42px; border-radius: 12px;
        background: linear-gradient(135deg, #f97316, #ea580c);
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: 18px;
    }
    .img-float-badge .badge-text strong { display: block; font-size: 15px; color: #111827; }
    .img-float-badge .badge-text span   { font-size: 12px; color: #6b7280; }

    /* Divider */
    .hiw-divider {
        display: flex; align-items: center; gap: 20px; margin: 60px 0;
    }
    .hiw-divider::before, .hiw-divider::after {
        content: ''; flex: 1;
        height: 1px;
        background: linear-gradient(90deg, transparent, #e5e7eb, transparent);
    }
    .hiw-divider-icon {
        width: 48px; height: 48px; border-radius: 50%;
        background: linear-gradient(135deg, #f97316, #ea580c);
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: 18px;
        box-shadow: 0 6px 16px rgba(249,115,22,0.3);
    }
    </style>

    <section id="how-it-works" class="hiw-section py-5">
        <div class="container py-5">

            {{-- ── Section Header ── --}}
            <div class="text-center mb-5 reveal">
                <div class=""><i class=""></i> </div>
                <h2 class="fw-bold" style="font-size:2.2rem;">Simple Steps to Get Started</h2>
                <p class="text-muted mt-2">Whether you need help or want to offer services — we've made it easy</p>
            </div>

            {{-- ── FOR SEEKERS ── --}}
            <div class="row align-items-center mb-5 g-5">

                {{-- Steps (left) --}}
                <div class="col-lg-6 reveal">
                    <div class="hiw-badge mb-3"><i class="fas fa-user me-1"></i> For Service Seekers</div>
                    <h2 class="fw-bold mb-4" style="font-size:1.9rem;">Get Things Fixed in<br><span style="color:#f97316;">3 Easy Steps</span></h2>

                    <div class="timeline-steps">

                        <div class="timeline-step">
                            <div class="step-circle"><i class="fas fa-search"></i></div>
                            <div class="step-content">
                                <div class="step-num-label">Step 01</div>
                                <h5>Choose a Service</h5>
                                <p>Select from our wide range of home repair and maintenance services tailored for you.</p>
                            </div>
                        </div>

                        <div class="timeline-step">
                            <div class="step-circle"><i class="fas fa-calendar-check"></i></div>
                            <div class="step-content">
                                <div class="step-num-label">Step 02</div>
                                <h5>Book an Appointment</h5>
                                <p>Pick a date and time that works for you. We offer same-day & emergency services.</p>
                            </div>
                        </div>

                        <div class="timeline-step">
                            <div class="step-circle"><i class="fas fa-smile"></i></div>
                            <div class="step-content">
                                <div class="step-num-label">Step 03</div>
                                <h5>Relax & Enjoy</h5>
                                <p>A verified professional arrives and fixes the issue with 100% satisfaction guarantee.</p>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Image (right) --}}
                <div class="col-lg-6 reveal">
                    <div class="hiw-img-wrap">
                        <img src="https://images.unsplash.com/photo-1621905251918-48416bd8575a?auto=format&fit=crop&w=1000&q=80" alt="Handyman working">
                        <div class="">
                            <div class=""><i class=""></i></div>
                            <div class="">
                                <strong></strong>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ── DIVIDER ── --}}
            <div class="hiw-divider">
                <div class=""><i class=""></i></div>
            </div>

            {{-- ── FOR PROVIDERS ── --}}
            <div class="row align-items-center g-5 flex-row-reverse">

                {{-- Steps (right) --}}
                <div class="col-lg-6 reveal">
                    <div class="hiw-badge mb-3"><i class="fas fa-hard-hat me-1"></i> For Service Providers</div>
                    <h2 class="fw-bold mb-4" style="font-size:1.9rem;">Grow Your Business<br><span style="color:#f97316;">With Us</span></h2>

                    <div class="timeline-steps">

                        <div class="timeline-step">
                            <div class="step-circle"><i class="fas fa-user-plus"></i></div>
                            <div class="step-content">
                                <div class="step-num-label">Step 01</div>
                                <h5>Register Your Profile</h5>
                                <p>Sign up and create your professional profile showcasing your skills and experience.</p>
                            </div>
                        </div>

                        <div class="timeline-step">
                            <div class="step-circle"><i class="fas fa-badge-check"></i></div>
                            <div class="step-content">
                                <div class="step-num-label">Step 02</div>
                                <h5>Get Verified</h5>
                                <p>Complete our background check and skill verification — builds trust with clients.</p>
                            </div>
                        </div>

                        <div class="timeline-step">
                            <div class="step-circle"><i class="fas fa-money-bill-wave"></i></div>
                            <div class="step-content">
                                <div class="step-num-label">Step 03</div>
                                <h5>Start Earning</h5>
                                <p>Receive job requests in your area and get paid securely through our platform.</p>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Image (left) --}}
                <div class="col-lg-6 reveal">
                    <div class="hiw-img-wrap">
                        <img src="https://images.unsplash.com/photo-1504148455328-c376907d081c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Professional tools">
                        <div class="" style="left:auto;right:-20px;bottom:24px;">
                            <div class=""><i class=""></i></div>
                            <div class="">
                                <strong></strong>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 mb-4 mb-md-0 reveal">
                    <div class="stat-item">
                        <h2 class="counter" data-target="15000">0</h2>
                        <p>Jobs Completed</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4 mb-md-0 reveal">
                    <div class="stat-item">
                        <h2 class="counter" data-target="850">0</h2>
                        <p>Active Providers</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4 mb-md-0 reveal">
                    <div class="stat-item">
                        <h2 class="counter" data-target="98">0</h2>
                        <p>% Satisfaction</p>
                    </div>
                </div>
                <div class="col-md-3 reveal">
                    <div class="stat-item">
                        <h2 class="counter" data-target="24">0</h2>
                        <p>Hour Support</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="testimonials" class="py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mb-5 reveal">
                <h6 class="text-uppercase text-primary fw-bold">Testimonials</h6>
                <h2 class="fw-bold display-5">What People Say</h2>
            </div>
            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="testimonial-card text-center reveal">
                                    <i class="fas fa-quote-left quote-icon"></i>
                                    <p class="lead mb-4">"I needed an emergency plumber at midnight. Handy Hub connected me with a professional within 30 minutes. Absolutely lifesaving service!"</p>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img src="https://randomuser.me/api/portraits/women/44.jpg" class="rounded-circle me-3" width="60" alt="User">
                                        <div class="text-start">
                                            <h5 class="mb-0 fw-bold">Sarah Jenkins</h5>
                                            <small class="text-muted">Homeowner</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="testimonial-card text-center reveal">
                                    <i class="fas fa-quote-left quote-icon"></i>
                                    <p class="lead mb-4">"As a carpenter, this platform has doubled my monthly income. The verification process was smooth and I get quality leads daily."</p>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img src="https://randomuser.me/api/portraits/men/32.jpg" class="rounded-circle me-3" width="60" alt="User">
                                        <div class="text-start">
                                            <h5 class="mb-0 fw-bold">Mike Ross</h5>
                                            <small class="text-muted">Service Provider</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </section>

    <!-- Provider CTA -->
    <section id="provider" class="provider-section text-center">
        <div class="container reveal">
            <h2 class="display-4 fw-bold mb-4">Are You a Skilled Professional?</h2>
            <p class="lead mb-5 mx-auto" style="max-width: 700px;">Join our network of trusted service providers. Get access to thousands of customers in your area, set your own schedule, and grow your business.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('auth.register') }}" class="btn btn-primary-custom btn-lg px-5">Apply as Provider</a>
                <a href="#how-it-works" class="btn btn-outline-light btn-lg px-5 rounded-pill">Learn More</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h3 class="text-white mb-3"><i class="fas fa-tools me-2"></i>Handy Hub</h3>
                    <p>Your trusted partner for all home maintenance and repair needs. Quality service, guaranteed satisfaction.</p>
                    <div class="mt-4">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="text-white mb-3">Services</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#">Plumbing</a></li>
                        <li class="mb-2"><a href="#">Electrical</a></li>
                        <li class="mb-2"><a href="#">Carpentry</a></li>
                        <li class="mb-2"><a href="#">Cleaning</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="text-white mb-3">Company</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#">About Us</a></li>
                        <li class="mb-2"><a href="#">Careers</a></li>
                        <li class="mb-2"><a href="#">Blog</a></li>
                        <li class="mb-2"><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5 class="text-white mb-3">Contact Us</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2 text-primary"></i> 123 Service Street, NY 10001</li>
                        <li class="mb-2"><i class="fas fa-phone me-2 text-primary"></i> +1 (555) 123-4567</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2 text-primary"></i> support@handyhub.com</li>
                    </ul>
                </div>
            </div>
            <hr class="border-secondary mt-4">
            <div class="text-center pt-3">
                <p class="mb-0">&copy; 2026 Handy Hub. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/home.js') }}"></script>
    <script src="{{ asset('assets/bootstap/bootstap.js') }}"></script>

<script>
/* ═══════════════════════════════════
   PARTICLE SYSTEM
═══════════════════════════════════ */
(function () {
    const canvas = document.getElementById('particleCanvas');
    const ctx    = canvas.getContext('2d');

    function resize() {
        canvas.width  = canvas.offsetWidth;
        canvas.height = canvas.offsetHeight;
    }
    resize();
    window.addEventListener('resize', resize);

    const ORANGE = [249, 115, 22];
    const WHITE  = [255, 255, 255];

    class Particle {
        constructor() { this.reset(); }

        reset() {
            this.x     = Math.random() * canvas.width;
            this.y     = canvas.height + Math.random() * 200;
            this.r     = Math.random() * 3 + 1;
            this.speedY = -(Math.random() * 0.8 + 0.3);
            this.speedX =  (Math.random() - 0.5) * 0.4;
            this.alpha  = 0;
            this.maxAlpha = Math.random() * 0.5 + 0.15;
            this.color  = Math.random() > 0.5 ? ORANGE : WHITE;
            this.life   = 0;
            this.maxLife = Math.random() * 300 + 200;
        }

        update() {
            this.life++;
            this.x += this.speedX;
            this.y += this.speedY;

            const progress = this.life / this.maxLife;
            if (progress < 0.1)       this.alpha = (progress / 0.1) * this.maxAlpha;
            else if (progress > 0.8)  this.alpha = ((1 - progress) / 0.2) * this.maxAlpha;
            else                      this.alpha = this.maxAlpha;

            if (this.life >= this.maxLife || this.y < -20) this.reset();
        }

        draw() {
            const [r, g, b] = this.color;
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.r, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(${r},${g},${b},${this.alpha})`;
            ctx.fill();
        }
    }

    // Connection lines
    class Line {
        constructor() { this.reset(); }
        reset() {
            this.x1 = Math.random() * canvas.width;
            this.y1 = Math.random() * canvas.height;
            this.x2 = this.x1 + (Math.random() - 0.5) * 200;
            this.y2 = this.y1 + (Math.random() - 0.5) * 200;
            this.alpha = 0;
            this.life  = 0;
            this.maxLife = Math.random() * 200 + 100;
        }
        update() {
            this.life++;
            const p = this.life / this.maxLife;
            this.alpha = p < 0.3 ? (p / 0.3) * 0.06
                       : p > 0.7 ? ((1 - p) / 0.3) * 0.06
                       : 0.06;
            if (this.life >= this.maxLife) this.reset();
        }
        draw() {
            ctx.beginPath();
            ctx.moveTo(this.x1, this.y1);
            ctx.lineTo(this.x2, this.y2);
            ctx.strokeStyle = `rgba(249,115,22,${this.alpha})`;
            ctx.lineWidth = 0.5;
            ctx.stroke();
        }
    }

    const particles = Array.from({ length: 80 }, () => {
        const p = new Particle();
        p.y   = Math.random() * canvas.height; // start spread
        p.life = Math.floor(Math.random() * p.maxLife);
        return p;
    });

    const lines = Array.from({ length: 15 }, () => {
        const l = new Line();
        l.life = Math.floor(Math.random() * l.maxLife);
        return l;
    });

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        lines.forEach(l => { l.update(); l.draw(); });
        particles.forEach(p => { p.update(); p.draw(); });
        requestAnimationFrame(animate);
    }
    animate();
})();
</script>

</body>
</html>