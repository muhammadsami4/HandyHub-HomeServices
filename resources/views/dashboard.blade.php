@include('layouts.admin.head')

<style>
/* 
   ENHANCED DASHBOARD STYLES
 */

.page-title  { font-size: 1.85rem; font-weight: 800; color: #111827; }
.breadcrumb-text { color: #6b7280; font-size: 13.5px; }

/*  Stat Card  */
.stat-card {
    border: none !important;
    border-radius: 20px !important;
    padding: 28px 24px !important;
    position: relative;
    overflow: hidden;
    transition: transform .25s ease, box-shadow .25s ease;
    cursor: default;
}
.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15) !important;
}
.stat-card::after {
    content: '';
    position: absolute;
    top: -30px; right: -30px;
    width: 110px; height: 110px;
    border-radius: 50%;
    background: rgba(255,255,255,0.12);
}
.stat-card::before {
    content: '';
    position: absolute;
    bottom: -50px; right: 20px;
    width: 160px; height: 160px;
    border-radius: 50%;
    background: rgba(255,255,255,0.07);
}

.stat-card .s-icon {
    width: 52px; height: 52px;
    border-radius: 14px;
    background: rgba(255,255,255,0.22);
    display: flex; align-items: center; justify-content: center;
    font-size: 22px;
    color: #fff;
    margin-bottom: 16px;
    backdrop-filter: blur(4px);
}
.stat-card .s-label {
    font-size: 13px;
    font-weight: 600;
    color: rgba(255,255,255,0.8);
    letter-spacing: .5px;
    text-transform: uppercase;
    margin-bottom: 6px;
}
.stat-card .s-value {
    font-size: 2.4rem;
    font-weight: 800;
    color: #fff;
    line-height: 1;
    margin: 0;
}
.stat-card .s-sub {
    font-size: 12px;
    color: rgba(255,255,255,0.65);
    margin-top: 6px;
}

/* Gradient themes */
.gc-indigo  { background: linear-gradient(135deg, #4f46e5, #7c3aed); box-shadow: 0 10px 30px rgba(79,70,229,.3); }
.gc-blue    { background: linear-gradient(135deg, #0284c7, #0ea5e9); box-shadow: 0 10px 30px rgba(14,165,233,.3); }
.gc-teal    { background: linear-gradient(135deg, #0d9488, #14b8a6); box-shadow: 0 10px 30px rgba(20,184,166,.3); }
.gc-orange  { background: linear-gradient(135deg, #f97316, #ea580c); box-shadow: 0 10px 30px rgba(249,115,22,.3); }
.gc-green   { background: linear-gradient(135deg, #16a34a, #22c55e); box-shadow: 0 10px 30px rgba(34,197,94,.3); }
.gc-amber   { background: linear-gradient(135deg, #d97706, #f59e0b); box-shadow: 0 10px 30px rgba(245,158,11,.3); }
.gc-rose    { background: linear-gradient(135deg, #e11d48, #f43f5e); box-shadow: 0 10px 30px rgba(244,63,94,.3); }
.gc-emerald { background: linear-gradient(135deg, #059669, #10b981); box-shadow: 0 10px 30px rgba(16,185,129,.3); }
.gc-slate   { background: linear-gradient(135deg, #475569, #64748b); box-shadow: 0 10px 30px rgba(100,116,139,.3); }
.gc-pink    { background: linear-gradient(135deg, #db2777, #ec4899); box-shadow: 0 10px 30px rgba(236,72,153,.3); }

/*  Section Header  */
.dash-section-title {
    font-size: 15px;
    font-weight: 700;
    color: #374151;
    text-transform: uppercase;
    letter-spacing: .8px;
    margin-bottom: 16px;
    padding-bottom: 8px;
    border-bottom: 2px solid #f3f4f6;
}

/*  Profile Card  */
.profile-card {
    background: #fff;
    border-radius: 20px;
    padding: 28px;
    box-shadow: 0 4px 20px rgba(0,0,0,.06);
    border: 1px solid #f3f4f6;
    height: 100%;
}
.profile-card h5 {
    font-size: 16px;
    font-weight: 700;
    color: #111827;
    margin-bottom: 16px;
}
.org-name {
    font-size: 15px;
    color: #374151;
    margin-top: 12px;
}
.org-name strong { color: #111827; }

/*  Quick Links Card  */
.quick-card {
    background: #fff;
    border-radius: 20px;
    padding: 28px;
    box-shadow: 0 4px 20px rgba(0,0,0,.06);
    border: 1px solid #f3f4f6;
    height: 100%;
}
.quick-card h5 {
    font-size: 16px;
    font-weight: 700;
    color: #111827;
    margin-bottom: 16px;
}
.btn-quick {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 13px 18px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: all .2s ease;
    margin-bottom: 10px;
    border: 2px solid #e5e7eb;
    color: #374151;
    background: #fff;
}
.btn-quick:hover {
    background: #f97316;
    color: #fff;
    border-color: #f97316;
    transform: translateX(4px);
}
.btn-quick i { font-size: 15px; }

/*  Greeting Banner  */
.greeting-banner {
    background: linear-gradient(135deg, #f97316 0%, #ea580c 50%, #c2410c 100%);
    border-radius: 20px;
    padding: 28px 32px;
    color: #fff;
    margin-bottom: 28px;
    position: relative;
    overflow: hidden;
}
.greeting-banner::before {
    content: '';
    position: absolute;
    top: -40px; right: -40px;
    width: 180px; height: 180px;
    border-radius: 50%;
    background: rgba(255,255,255,0.08);
}
.greeting-banner::after {
    content: '';
    position: absolute;
    bottom: -60px; right: 80px;
    width: 220px; height: 220px;
    border-radius: 50%;
    background: rgba(255,255,255,0.05);
}
.greeting-banner h2 { font-size: 1.6rem; font-weight: 800; margin: 0 0 4px; }
.greeting-banner p  { margin: 0; opacity: .8; font-size: 14px; }
.greeting-banner .banner-icon {
    font-size: 3rem;
    opacity: .25;
    position: absolute;
    right: 32px; top: 50%;
    transform: translateY(-50%);
}
</style>

<body>
<div class="overlay" id="overlay" onclick="closeMobileSidebar()"></div>
@include('layouts.admin.sidebar')
<div class="main-wrap" id="mainWrap">
@include('layouts.admin.header')
@include('layouts.admin.alert')

<main class="content">
<div class="container-fluid">

    {{--  ADMIN  --}}
    @if(Auth::user()->role == 'admin')

        {{-- Greeting --}}
        <div class="greeting-banner">
            <i class="fas fa-shield-alt banner-icon"></i>
            <h2>Welcome Back, {{ Auth::user()->name }}</h2>
            <p>Here's what's happening on HandyHub today.</p>
        </div>

        {{-- Users Row --}}
        <div class="dash-section-title"><i class=""></i>User Overview</div>
        <div class="row g-4 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="stat-card gc-indigo">
                    <div class=""><i class=""></i></div>
                    <div class="s-label">Total Users</div>
                    <div class="s-value">{{ $totalUsers }}</div>
                    <div class="s-sub">All registered users</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="stat-card gc-blue">
                    <div class=""><i class=""></i></div>
                    <div class="s-label">Admins</div>
                    <div class="s-value">{{ $adminUsers }}</div>
                    <div class="s-sub">Platform administrators</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="stat-card gc-teal">
                    <div class=""><i class=""></i></div>
                    <div class="s-label">Seekers</div>
                    <div class="s-value">{{ $seekerUsers }}</div>
                    <div class="s-sub">Service seekers</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="stat-card gc-orange">
                    <div class=""><i class=""></i></div>
                    <div class="s-label">Providers</div>
                    <div class="s-value">{{ $providerUsers }}</div>
                    <div class="s-sub">Service providers</div>
                </div>
            </div>
        </div>

        {{-- Verification Row --}}
        <div class="dash-section-title"><i class=""></i>Verification Status</div>
        <div class="row g-4 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="stat-card gc-green">
                    <div class=""><i class=""></i></div>
                    <div class="s-label">Seeker Verified</div>
                    <div class="s-value">{{ $seekerVerified }}</div>
                    <div class="s-sub">Verified seekers</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="stat-card gc-amber">
                    <div class=""><i class=""></i></div>
                    <div class="s-label">Seeker Pending</div>
                    <div class="s-value">{{ $seekerUnverified }}</div>
                    <div class="s-sub">Awaiting verification</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="stat-card gc-emerald">
                    <div class=""><i class=""></i></div>
                    <div class="s-label">Provider Verified</div>
                    <div class="s-value">{{ $providerVerified }}</div>
                    <div class="s-sub">Verified providers</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="stat-card gc-pink">
                    <div class=""><i class=""></i></div>
                    <div class="s-label">Provider Pending</div>
                    <div class="s-value">{{ $providerUnverified }}</div>
                    <div class="s-sub">Awaiting verification</div>
                </div>
            </div>
        </div>

        {{-- Quick Links --}}
        <div class="row g-4">
            <div class="col-md-6">
                <div class="quick-card">
                    <h5><i class=""></i>Quick Actions</h5>
                    <a href="{{ route('admin.users') }}" class="btn-quick">
                        <i class=""></i> Manage Users
                    </a>
                    <a href="{{ route('services.index') }}" class="btn-quick">
                        <i class=""></i> Manage Services
                    </a>
                </div>
            </div>
        </div>

    @endif

    {{--  PROVIDER  --}}
    @if(Auth::user()->role == 'provider')

        {{-- Greeting --}}
        <div class="greeting-banner">
            <i class="fas fa-hard-hat banner-icon"></i>
            <h2>Welcome, {{ Auth::user()->name }}</h2>
            <p>Manage your service requests and grow your business.</p>
        </div>

        {{-- Stats Row --}}
        <div class="dash-section-title"><i class=""></i>My Performance</div>
        <div class="row g-4 mb-4">
            <div class="col-xl-4 col-md-6">
                <div class="stat-card gc-green">
                    <div class=""><i class=""></i></div>
                    <div class="s-label">My Accepted</div>
                    <div class="s-value">{{ $myAccepted }}</div>
                    <div class="s-sub">Requests I accepted</div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="stat-card gc-slate">
                    <div class=""><i class=""></i></div>
                    <div class="s-label">My Rejected</div>
                    <div class="s-value">{{ $myRejected }}</div>
                    <div class="s-sub">Requests I rejected</div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="stat-card gc-amber">
                    <div class=""><i class=""></i></div>
                    <div class="s-label">Available</div>
                    <div class="s-value">{{ $pendingRequests }}</div>
                    <div class="s-sub">Pending requests to accept</div>
                </div>
            </div>
        </div>

        {{-- Profile + Quick Links --}}
        <div class="row g-4">
            <div class="col-md-6">
                <div class="profile-card">
                    <h5><i class=""></i>My Profile Status</h5>
                    @if($myProfile)
                        <div class="d-flex gap-2 flex-wrap">
                            <span class="badge px-3 py-2 rounded-pill"
                                  style="background:#dcfce7;color:#166534;font-size:13px;">
                                Profile Complete
                            </span>
                            @if($myProfile->is_verified)
                                <span class="badge px-3 py-2 rounded-pill"
                                      style="background:#dbeafe;color:#1e40af;font-size:13px;">
                                    Verified
                                </span>
                            @else
                                <span class="badge px-3 py-2 rounded-pill"
                                      style="background:#fef3c7;color:#92400e;font-size:13px;">
                                    Verification Pending
                                </span>
                            @endif
                        </div>
                        <p class="org-name mt-3 mb-0">
                            <i class=""></i>
                            Organization: <strong>{{ $myProfile->organization_name ?? 'N/A' }}</strong>
                        </p>
                        <p class="org-name mb-0">
                            <i class="fas fa-map-marker-alt me-2 text-muted"></i>
                            {{ $myProfile->city ?? '' }}{{ $myProfile->city && $myProfile->province ? ', ' : '' }}{{ $myProfile->province ?? '' }}
                        </p>
                    @else
                        <div class="alert alert-warning rounded-3 mb-0">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Profile incomplete 
                            <a href="{{ route('provider.profile') }}">Complete now</a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="quick-card">
                    <h5><i class=""></i>Quick Links</h5>
                    <a href="{{ route('provider.requests') }}" class="btn-quick">
                        <i class=""></i> View All Requests
                    </a>
                    <a href="{{ route('provider.services.index') }}" class="btn-quick">
                        <i class=""></i> My Services
                    </a>
                    <a href="{{ route('provider.profile') }}" class="btn-quick">
                        <i class=""></i> Edit Profile
                    </a>
                </div>
            </div>
        </div>

    @endif

    {{--  SEEKER  --}}
    @if(Auth::user()->role == 'seeker')

        {{-- Greeting --}}
        <div class="greeting-banner">
            <i class="fas fa-home banner-icon"></i>
            <h2>Welcome, {{ Auth::user()->name }}</h2>
            <p>Find the right professional for every home repair need.</p>
        </div>

        {{-- Stats Row --}}
        <div class="dash-section-title"><i class=""></i>My Requests Overview</div>
        <div class="row g-4 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="stat-card gc-indigo">
                    <div class=""><i class=""></i></div>
                    <div class="s-label">Total Requests</div>
                    <div class="s-value">{{ $myTotal }}</div>
                    <div class="s-sub">All submitted requests</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="stat-card gc-green">
                    <div class=""><i class=""></i></div>
                    <div class="s-label">Accepted</div>
                    <div class="s-value">{{ $myAccepted }}</div>
                    <div class="s-sub">Accepted by provider</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="stat-card gc-amber">
                    <div class=""><i class=""></i></div>
                    <div class="s-label">Pending</div>
                    <div class="s-value">{{ $myPending }}</div>
                    <div class="s-sub">Awaiting provider response</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="stat-card gc-rose">
                    <div class=""><i class=""></i></div>
                    <div class="s-label">Rejected</div>
                    <div class="s-value">{{ $myRejected }}</div>
                    <div class="s-sub">Not accepted</div>
                </div>
            </div>
        </div>

        {{-- Quick Links --}}
        <div class="row g-4">
            <div class="col-md-6">
                <div class="quick-card">
                    <h5><i class=""></i>Quick Links</h5>
                    <a href="{{ route('seeker.requests') }}" class="btn-quick">
                        <i class=""></i> My Requests
                    </a>
                    <a href="{{ route('seeker.services.create') }}" class="btn-quick">
                        <i class=""></i> New Request
                    </a>
                    <a href="{{ route('seeker.providers') }}" class="btn-quick">
                        <i class=""></i> Find Providers
                    </a>
                </div>
            </div>
        </div>

    @endif

</div>
</main>
</div>
@include('layouts.admin.script')
</body>