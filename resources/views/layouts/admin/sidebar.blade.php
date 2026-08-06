<!-- Sidebar -->
<aside class="sidebar" id="sidebar">

@php

    $user = auth()->user();

    /*
    |--------------------------------------------------------------------------
    | PROFILE CHECKS
    |--------------------------------------------------------------------------
    */
    $seekerProfile = $user->seekerProfile ?? null;
    $providerProfile = $user->providerProfile ?? null;

    $seekerCompleted = $seekerProfile && $seekerProfile->profile_completion >= 85;
    $providerCompleted = $providerProfile && $providerProfile->profile_completion >= 85;

@endphp

<!-- HEADER -->
<div class="sidebar-header">

    <div class="brand">
        <i class="fas fa-tools me-2"></i>
        Handy Hub
    </div>

    <button class="sidebar-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

</div>

<!-- NAV -->
<ul class="nav-menu">

    {{-- DASHBOARD --}}
    <li class="nav-item">

        <a href="{{ url('dashboard') }}"
           class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">

            <i class="fas fa-th-large"></i>
            <span>Dashboard</span>

        </a>

    </li>

    {{-- ================= ADMIN ================= --}}
    @if ($user->isAdmin())

        <li class="nav-item">

            <a href="{{ route('admin.users') }}" class="nav-link">

                <i class="fas fa-users"></i>
                <span>Users</span>

            </a>

        </li>

        <li class="nav-item">

            <a href="{{ route('services.index') }}" class="nav-link">

                <i class="fas fa-tools"></i>
                <span>Services</span>

            </a>

        </li>

    @endif

    {{-- ================= SEEKER ================= --}}
    @if ($user->isSeeker())

        <li class="nav-item">

            <a href="{{ route('seeker.profile') }}" class="nav-link">

                <i class="fas fa-user"></i>
                <span>My Profile</span>

            </a>

        </li>

        <li class="nav-item">

            <a href="{{ route('seeker.services.create') }}" class="nav-link">

                <i class="fas fa-tools"></i>
                <span>Browse Services</span>

            </a>

        </li>

        <li class="nav-item">

            <a href="{{ route('seeker.requests') }}" class="nav-link">

                <i class="fas fa-clipboard-list"></i>
                <span>My Requests</span>

            </a>

        </li>

        {{-- FIND PROVIDERS — Seeker providers browse kare --}}
        <li class="nav-item">

            <a href="{{ route('seeker.providers') }}" class="nav-link">

                <i class="fas fa-search"></i>
                <span>Find Providers</span>

            </a>

        </li>

    @endif

    {{-- ================= PROVIDER ================= --}}
    @if ($user->isProvider())

        {{-- PROFILE --}}
        <li class="nav-item">

            <a href="{{ route('provider.profile') }}" class="nav-link">

                <i class="fas fa-user-check"></i>
                <span>Provider Profile</span>

            </a>

        </li>

        {{-- REQUESTS --}}
        <li class="nav-item">

            <a href="{{ route('provider.requests') }}" class="nav-link">

                <i class="fas fa-calendar-check"></i>
                <span>Service Requests</span>

            </a>

        </li>

        {{--  MY SERVICES — Provider apni services add kare --}}
        <li class="nav-item">

            <a href="{{ route('provider.services.index') }}" class="nav-link">

                <i class="fas fa-tools"></i>
                <span>My Services</span>

            </a>

        </li>

    @endif

</ul>

<!-- FOOTER -->
<div class="sidebar-footer">

    <div class="admin-mini">

        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}"
             alt="User">

        <div class="info">

            <div class="name">
                {{ $user->name }}
            </div>

            <div class="role">
                {{ ucfirst($user->role) }}
            </div>

        </div>

    </div>

</div>

</aside>