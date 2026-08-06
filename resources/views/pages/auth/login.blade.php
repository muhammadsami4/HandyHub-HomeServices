<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Handy Hub</title>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstap/bootstap.css') }}">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        :root {
            --primary-color:#ff6b00;
            --secondary-color:#1a1a2e;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #eef2ff, #f8fafc);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* BACKGROUND SHAPES */
        .bg-shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            z-index: 0;
        }

        .shape-1 {
            width: 350px;
            height: 350px;
            background: rgba(13, 110, 253, 0.15);
            top: -100px;
            left: -100px;
        }

        .shape-2 {
            width: 300px;
            height: 300px;
            background: rgba(99, 102, 241, 0.15);
            bottom: -100px;
            right: -100px;
        }

        /* LOGIN CONTAINER */
        .login-container {
            width: 100%;
            max-width: 1100px;
            min-height: 650px;
            background: #fff;
            border-radius: 25px;
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1fr;
            box-shadow: 0 20px 60px rgba(0,0,0,0.08);
            position: relative;
            z-index: 10;
        }

        /* LEFT SIDE */
        .login-branding {
            --primary-color:#ff6b00;
            --secondary-color:#1a1a2e; color: white;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand-logo {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 30px;
        }

        .login-branding h2 {
            font-size: 42px;
            margin-bottom: 20px;
        }

        .login-branding p {
            font-size: 16px;
            opacity: 0.9;
            line-height: 1.8;
        }

        .brand-features {
            margin-top: 40px;
            list-style: none;
            padding: 0;
        }

        .brand-features li {
            margin-bottom: 18px;
            font-size: 15px;
        }

        .brand-features i {
            margin-right: 10px;
        }

        /* RIGHT SIDE */
        .login-form-area {
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-title {
            font-size: 36px;
            font-weight: 700;
            color: var(--dark-color);
        }

        .form-subtitle {
            color: #6b7280;
            margin-bottom: 30px;
        }

        /* ROLE BUTTONS */
        .role-toggle {
            display: flex;
            gap: 12px;
            margin-bottom: 30px;
        }

        .role-btn {
            flex: 1;
            padding: 14px;
            border: 2px solid #e5e7eb;
            background: white;
            border-radius: 12px;
            font-weight: 600;
            transition: 0.3s;
            cursor: pointer;
            font-size: 14px;
        }

        .role-btn.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .role-btn:hover {
            transform: translateY(-2px);
        }

        /* FORM */
        .form-control {
            height: 58px;
            border-radius: 12px;
            border: 1px solid #d1d5db;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: var(--primary-color);
        }

        /* LOGIN BUTTON */
        .btn-primary-custom {
            width: 100%;
            height: 55px;
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg, #0d6efd, #4f46e5);
            color: white;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
        }

        /* DIVIDER */
        .divider {
            text-align: center;
            margin: 25px 0;
            color: #9ca3af;
            position: relative;
        }

        .divider::before,
        .divider::after {
            content: '';
            position: absolute;
            width: 40%;
            height: 1px;
            background: #e5e7eb;
            top: 50%;
        }

        .divider::before {
            left: 0;
        }

        .divider::after {
            right: 0;
        }

        /* SOCIAL */
        .social-login {
            display: flex;
            gap: 15px;
        }

        .social-btn {
            flex: 1;
            padding: 14px;
            border: 1px solid #e5e7eb;
            background: white;
            border-radius: 12px;
            font-weight: 500;
            transition: 0.3s;
        }

        .social-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(249,115,22,0.35);
            opacity: .9;
        }

        /* REGISTER */
        .register-link {
            margin-top: 25px;
            text-align: center;
            color: #6b7280;
        }

        .register-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        /* RESPONSIVE */
        @media(max-width: 991px) {

            .login-container {
                grid-template-columns: 1fr;
            }

            .login-branding {
                display: none;
            }

            .login-form-area {
                padding: 40px;
            }

            .role-toggle {
                flex-direction: column;
            }
        }

    </style>

</head>
<body>

    <!-- BACKGROUND -->
    <div class="bg-shape shape-1"></div>
    <div class="bg-shape shape-2"></div>

    <!-- LOGIN CONTAINER -->
    <div class="login-container">

        <!-- LEFT SIDE -->
        <div class="login-branding">

            <div class="brand-logo">
                <i class="fas fa-tools me-2"></i>
                Handy Hub
            </div>

            <h2>Welcome Back!</h2>

            <p>
                Access your dashboard to manage services,
                providers, bookings, and payments securely.
            </p>

            <ul class="brand-features">
                <li><i class="fas fa-check-circle"></i> Secure Login System</li>
                <li><i class="fas fa-check-circle"></i> Real-Time Notifications</li>
                <li><i class="fas fa-check-circle"></i> Booking Management</li>
                <li><i class="fas fa-check-circle"></i> Provider Control Panel</li>
            </ul>

        </div>

        <!-- RIGHT SIDE -->
        <div class="login-form-area">

            <h2 class="form-title">Sign In</h2>

            <p class="form-subtitle">
                Login to continue your account access
            </p>

            <!-- ROLE BUTTONS -->
            <div class="role-toggle">

                <!-- ADMIN -->
                <button type="button"
                        class="role-btn"
                        onclick="setRole(this, 'admin')">

                    <i class="fas fa-user-shield me-2"></i>
                    Admin

                </button>

                <!-- SEEKER -->
                <button type="button"
                        class="role-btn active"
                        onclick="setRole(this, 'seeker')">

                    <i class="fas fa-user me-2"></i>
                    Seeker

                </button>

                <!-- PROVIDER -->
                <button type="button"
                        class="role-btn"
                        onclick="setRole(this, 'provider')">

                    <i class="fas fa-hard-hat me-2"></i>
                    Provider

                </button>

            </div>

            <!-- SUCCESS MESSAGE -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- LOGIN FORM -->
            <form method="POST" action="{{ route('login.submit') }}">
                @csrf

                <!-- HIDDEN ROLE -->
                <input type="hidden"
                       name="role"
                       id="selectedRole"
                       value="seeker">

                <!-- EMAIL -->
                <div class="form-floating mb-3">

                    <input type="email"
                           class="form-control"
                           name="email"
                           id="email"
                           placeholder="name@example.com"
                           required>

                    <label for="email">
                        Email Address
                    </label>

                    @error('email')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

                <!-- PASSWORD -->
                <div class="form-floating mb-3 position-relative">

                    <input type="password"
                           class="form-control"
                           name="password"
                           id="password"
                           placeholder="Password"
                           required>

                    <label for="password">
                        Password
                    </label>

                    <!-- TOGGLE PASSWORD -->
                    <i class="fas fa-eye position-absolute"
                       id="togglePassword"
                       style="right: 20px; top: 22px; cursor: pointer; color: #9ca3af;">
                    </i>

                </div>

                <!-- REMEMBER -->
                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div class="form-check">

                        <input class="form-check-input"
                               type="checkbox"
                               name="remember"
                               id="remember">

                        <label class="form-check-label text-muted"
                               for="remember">

                            Remember Password

                        </label>

                    </div>

                    <a href="#"
                       class="text-decoration-none fw-semibold"
                       style="color: var(--primary-color);">

                        Forgot Password?

                    </a>

                </div>

                <!-- LOGIN BUTTON -->
                <button type="submit"
                        class="btn btn-primary-custom">

                    Login Account

                </button>

            </form>

            <!-- DIVIDER -->
            <div class="divider">
                or continue with
            </div>

            <!-- SOCIAL LOGIN -->
            <div class="social-login">

               <a href="{{ route('auth.google') }}"
   style="display:flex;align-items:center;justify-content:center;
          background:linear-gradient(135deg,#f97316,#ea580c);
          color:#fff;font-weight:600;font-size:15px;
          padding:14px;border-radius:12px;
          text-decoration:none;width:100%;">
    <i class="fab fa-google me-2"></i>
    Continue with Google
</a>

            </div>

            <!-- REGISTER -->
            <div class="register-link">

                Need an account?

                <a href="{{ route('auth.register') }}">
                    Register
                </a>

            </div>

        </div>
    </div>

    <!-- SCRIPT -->
    <script>

        // ROLE SWITCH
        function setRole(button, role)
        {
            document.querySelectorAll('.role-btn').forEach(btn => {
                btn.classList.remove('active');
            });

            button.classList.add('active');

            document.getElementById('selectedRole').value = role;
        }

        // PASSWORD TOGGLE
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        togglePassword.addEventListener('click', function ()
        {
            const type = password.getAttribute('type') === 'password'
                ? 'text'
                : 'password';

            password.setAttribute('type', type);

            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

    </script>

</body>
</html>