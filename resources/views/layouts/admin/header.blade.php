<!-- Topbar -->
<header class="topbar">

    <!-- MOBILE TOGGLE -->
    <button class="mobile-toggle" onclick="openMobileSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <!-- SEARCH -->
    <div class="topbar-search">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Search bookings, users...">
    </div>

    <!-- RIGHT ACTIONS -->
    <div class="topbar-actions">

        <!-- NOTIFICATION -->
        <button class="icon-btn">
            <i class="fas fa-bell"></i>
            <span class="dot"></span>
        </button>

        <!-- MESSAGE -->
        <button class="icon-btn">
            <i class="fas fa-envelope"></i>
            <span class="dot"></span>
        </button>

        <!-- PROFILE DROPDOWN -->
        <div class="dropdown">

            <button
                class="profile-dd dropdown-toggle"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
            >

                <!-- PROFILE IMAGE -->
                <img
                    src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0D8ABC&color=fff"
                    alt="Profile"
                >

                <!-- USER INFO -->
                <div class="txt">

                    <!-- AUTH USER NAME -->
                    <div class="name">
                        {{ auth()->user()->name }}
                    </div>

                    <!-- AUTH USER ROLE -->
                    <div class="role">

                        @if(auth()->user()->role == 'admin')
                            Super Admin
                        @elseif(auth()->user()->role == 'provider')
                            Service Provider
                        @elseif(auth()->user()->role == 'seeker')
                            Service Seeker
                        @endif

                    </div>

                </div>

                <!-- ICON -->
                <i class="fas fa-chevron-down ms-2"
                   style="color:#94a3b8; font-size:0.7rem;">
                </i>

            </button>

            <!-- DROPDOWN MENU -->
            <ul class="dropdown-menu dropdown-menu-end border-0 shadow"
                style="border-radius:14px; padding:8px;">

                <!-- PROFILE -->
                <li>
                    <a class="dropdown-item py-2 px-3"
                       href="#"
                       style="border-radius:10px; font-size:0.88rem;">

                        <i class="fas fa-user me-2 text-muted"></i>
                        Profile
                    </a>
                </li>

                <!-- SETTINGS -->
                <li>
                    <a class="dropdown-item py-2 px-3"
                       href="#"
                       style="border-radius:10px; font-size:0.88rem;">

                        <i class="fas fa-cog me-2 text-muted"></i>
                        Settings
                    </a>
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <!-- LOGOUT -->
                <li>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button
                            type="submit"
                            class="dropdown-item py-2 px-3 text-danger"
                            style="border-radius:10px; font-size:0.88rem;"
                        >

                            <i class="fas fa-sign-out-alt me-2"></i>
                            Logout

                        </button>
                    </form>

                </li>

            </ul>
        </div>
    </div>
</header>