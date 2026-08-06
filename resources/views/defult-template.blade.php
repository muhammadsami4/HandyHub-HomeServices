@include('layouts.admin.head')

<body>

    <!-- Overlay -->
    <div class="overlay" id="overlay" onclick="closeMobileSidebar()"></div>

    @include('layouts.admin.sidebar')
    <!-- Main -->
    <div class="main-wrap" id="mainWrap">
        @include('layouts.admin.header')

        <!-- Content -->
        <main class="content">
            <h1 class="page-title">Dashboard</h1>
            <p class="breadcrumb-text">Home / Dashboard Overview</p>

            

        </main>
    </div>

    @include('layouts.admin.script')
