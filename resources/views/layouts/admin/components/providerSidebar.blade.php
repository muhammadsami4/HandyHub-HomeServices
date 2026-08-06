@php

    $providerProfile = Auth::user()->providerProfile;

    $isProfileComplete =
        $providerProfile &&
        $providerProfile->profile_completion >= 90;

    $isVerified =
        $providerProfile &&
        $providerProfile->is_verified;

    $canAccess =
        $isProfileComplete && $isVerified;

@endphp

<li class="nav-item">
    <a href="{{ route('provider.profile') }}" class="nav-link">
        <i class="fas fa-user-check"></i>
        <span>Provider Profile</span>
    </a>
</li>