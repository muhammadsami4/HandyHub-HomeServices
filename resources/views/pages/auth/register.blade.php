<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Handy Hub</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        :root{
            --primary-color:#ff6b00;
            --secondary-color:#1a1a2e;
        }

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{
            background:linear-gradient(135deg,#fff5eb 0%,#ffffff 100%);
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:40px 20px;
            overflow-x:hidden;
        }

        /* BACKGROUND SHAPE */
        .bg-shape{
            position:fixed;
            width:400px;
            height:400px;
            border-radius:50%;
            background:rgba(255,107,0,0.08);
            top:-100px;
            right:-100px;
            z-index:-1;
            filter:blur(20px);
        }

        /* CARD */
        .register-card{
            width:100%;
            max-width:1100px;
            background:#fff;
            border-radius:24px;
            overflow:hidden;
            display:grid;
            grid-template-columns:380px 1fr;
            box-shadow:0 25px 60px rgba(0,0,0,0.08);
        }

        /* SIDEBAR */
        .register-sidebar{
            background:linear-gradient(135deg,#1a1a2e,#111827);
            color:white;
            padding:60px 40px;
            position:relative;
        }

        .brand-logo{
            font-size:30px;
            font-weight:700;
            margin-bottom:40px;
        }

        .sidebar-title{
            font-size:2rem;
            font-weight:700;
            margin-bottom:20px;
        }

        .sidebar-text{
            opacity:0.85;
            line-height:1.8;
        }

        .sidebar-features{
            list-style:none;
            margin-top:40px;
            padding:0;
        }

        .sidebar-features li{
            margin-bottom:18px;
            font-size:15px;
        }

        .sidebar-features i{
            color:var(--primary-color);
            margin-right:10px;
        }

        /* FORM AREA */
        .register-form-area{
            padding:60px;
        }

        .form-header h2{
            font-weight:700;
            color:var(--secondary-color);
        }

        .form-header p{
            color:#777;
            margin-bottom:30px;
        }

        /* ROLE BUTTONS */
        .role-toggle{
            display:flex;
            gap:15px;
            margin-bottom:30px;
        }

        .role-btn{
            flex:1;
            border:2px solid #e5e7eb;
            padding:15px;
            border-radius:14px;
            background:white;
            font-weight:600;
            transition:0.3s;
            cursor:pointer;
        }

        .role-btn.active{
            background:var(--primary-color);
            color:white;
            border-color:var(--primary-color);
        }

        .role-btn:hover{
            transform:translateY(-2px);
        }

        /* FORM */
        .form-control{
            height:56px;
            border-radius:14px;
            border:2px solid #e5e7eb;
        }

        .form-control:focus{
            box-shadow:none;
            border-color:var(--primary-color);
        }

        .form-label{
            font-weight:500;
            margin-bottom:8px;
        }

        /* BUTTON */
        .btn-primary-custom{
            width:100%;
            height:56px;
            border:none;
            border-radius:14px;
            background:linear-gradient(135deg,#ff6b00,#ff8f3c);
            color:white;
            font-weight:600;
            transition:0.3s;
        }

        .btn-primary-custom:hover{
            transform:translateY(-2px);
            box-shadow:0 12px 25px rgba(255,107,0,0.25);
        }

        .login-link{
            margin-top:25px;
            text-align:center;
            color:#666;
        }

        .login-link a{
            color:var(--primary-color);
            text-decoration:none;
            font-weight:600;
        }

        @media(max-width:991px){

            .register-card{
                grid-template-columns:1fr;
            }

            .register-sidebar{
                display:none;
            }

            .register-form-area{
                padding:40px 25px;
            }

            .role-toggle{
                flex-direction:column;
            }
        }

    </style>

</head>
<body>

<div class="bg-shape"></div>

<div class="register-card">

    <!-- LEFT SIDE -->
    <div class="register-sidebar">

        <div class="brand-logo">
            <i class="fas fa-tools me-2"></i>
            Handy Hub
        </div>

        <div class="sidebar-title">
            Join Handy Hub
        </div>

        <p class="sidebar-text">
            Create your account and access a premium service marketplace
            for seekers and professional providers.
        </p>

        <ul class="sidebar-features">
            <li><i class="fas fa-check-circle"></i> Premium Dashboard</li>
            <li><i class="fas fa-check-circle"></i> Real-Time Service Requests</li>
            <li><i class="fas fa-check-circle"></i> Secure Booking System</li>
            <li><i class="fas fa-check-circle"></i> Fast Provider Matching</li>
        </ul>

    </div>

    <!-- RIGHT SIDE -->
    <div class="register-form-area">

        <!-- HEADER -->
        <div class="form-header">
            <h2>Create Account</h2>
            <p>Register as Seeker or Provider</p>
        </div>

        <!-- ROLE SELECTION -->
        <div class="role-toggle">

            <!-- SEEKER -->
            <button type="button"
                    class="role-btn active"
                    onclick="setRole(this, 'seeker')">

                <i class="fas fa-user me-2"></i>
                Service Seeker

            </button>

            <!-- PROVIDER -->
            <button type="button"
                    class="role-btn"
                    onclick="setRole(this, 'provider')">

                <i class="fas fa-hard-hat me-2"></i>
                Service Provider

            </button>

        </div>

        <!-- ERROR -->
        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- FORM -->
        <form method="POST" action="{{ route('register.store') }}">
            @csrf

            <!-- HIDDEN ROLE -->
            <input type="hidden"
                   name="role"
                   id="selectedRole"
                   value="seeker">

            <!-- NAME -->
            <div class="mb-3">
                <label class="form-label">
                    Full Name
                </label>

                <input type="text"
                       class="form-control"
                       name="name"
                       placeholder="Enter your full name"
                       required>
            </div>

            <!-- EMAIL -->
            <div class="mb-3">
                <label class="form-label">
                    Email Address
                </label>

                <input type="email"
                       class="form-control"
                       name="email"
                       placeholder="you@example.com"
                       required>
            </div>

           

            <!-- PASSWORD -->
            <div class="mb-3">
                <label class="form-label">
                    Password
                </label>

                <input type="password"
                       class="form-control"
                       name="password"
                       placeholder="Create secure password"
                       required>
            </div>

            <!-- CONFIRM PASSWORD -->
            <div class="mb-4">
                <label class="form-label">
                    Confirm Password
                </label>

                <input type="password"
                       class="form-control"
                       name="password_confirmation"
                       placeholder="Repeat password"
                       required>
            </div>

            <!-- TERMS -->
            <div class="form-check mb-4">

                <input class="form-check-input"
                       type="checkbox"
                       required>

                <label class="form-check-label">
                    I agree to the Terms & Conditions
                </label>

            </div>

            <!-- SUBMIT -->
            <button type="submit"
                    class="btn btn-primary-custom">

                Create Account

            </button>

        </form>

        <!-- LOGIN -->
        <div class="login-link">

            Already have an account?

            <a href="{{ route('login') }}">
                Sign In
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

</script>

</body>
</html>