@include('layouts.admin.head')

<body>

    @include('layouts.admin.sidebar')

    <div class="main-wrap" id="mainWrap">

        @include('layouts.admin.header')

        <main class="content">

            <div class="container-fluid">

                {{-- HEADER --}}
                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>
                        <h2 class="page-title">User Details</h2>
                        <p class="breadcrumb-text">Admin / User / Profile Review</p>
                    </div>

                    <div>
                        @if ($user->role == 'seeker')

                            @if (optional($user->seekerProfile)->is_verified)
                                <span class="badge bg-success">Verified</span>
                            @else
                                <span class="badge bg-warning text-dark">Pending</span>
                            @endif
                        @else
                            @if (optional($user->providerProfile)->is_verified)
                                <span class="badge bg-success">Verified</span>
                            @else
                                <span class="badge bg-warning text-dark">Pending</span>
                            @endif

                        @endif
                    </div>

                </div>



                {{-- USER INFO CARD --}}
                <div class="card shadow-sm mb-4">

                    <div class="card-body">

                        <h5 class="border-bottom pb-2">Basic Information</h5>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Name</label>
                                <input class="form-control form-control-sm" value="{{ $user->name }}" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input class="form-control form-control-sm" value="{{ $user->email }}" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Role</label>
                                <input class="form-control form-control-sm" value="{{ ucfirst($user->role) }}" readonly>
                            </div>

                        </div>

                    </div>

                </div>



                {{-- PROFILE DATA --}}
                <div class="card shadow-sm mb-4">

                    <div class="card-body">

                        <h5 class="border-bottom pb-2">Profile Details</h5>

                        @php
                            $profile = $user->role == 'seeker' ? $user->seekerProfile : $user->providerProfile;
                        @endphp



                        @if (!$profile)

                            <div class="alert alert-warning">
                                No profile submitted yet.
                            </div>
                        @else
                            <div class="row">

                                {{-- BASIC INFO --}}
                                @foreach ($profile->getAttributes() as $key => $value)
                                    @if (!in_array($key, ['id', 'user_id', 'created_at', 'updated_at', 'is_verified', 'verified_at']))
                                        @if (!empty($value))
                                            <div class="col-md-6 mb-3">

                                                <label class="form-label text-capitalize">
                                                    {{ str_replace('_', ' ', $key) }}
                                                </label>

                                                <input class="form-control form-control-sm" value="{{ $value }}"
                                                    readonly>

                                            </div>
                                        @endif
                                    @endif
                                @endforeach

                            </div>

                        @endif

                    </div>

                </div>



                {{-- DOCUMENTS --}}
                @if ($profile)

                    <div class="card shadow-sm mb-4">

                        <div class="card-body">

                            <h5 class="border-bottom pb-2">Documents</h5>

                            <div class="row">

                                @php
                                    $docFields = [
                                        'cnic_front',
                                        'cnic_back',
                                        'income_proof',
                                        'profile_image',
                                        'registration_certificate',
                                        'tax_certificate',
                                        'organization_logo',
                                        'owner_cnic_front',
                                        'owner_cnic_back',
                        'police_clearance',  // ✅ added
                                    ];
                                @endphp



                                @foreach ($docFields as $field)
                                    @if (!empty($profile->$field))
                                        @php
                                            $file = $profile->$field;
                                            $path = asset('assets/documents/' . $file);
                                            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                        @endphp

                                        <div class="col-md-4 mb-4">

                                            <label class="form-label text-capitalize">
                                                {{ str_replace('_', ' ', $field) }}
                                            </label>

                                            @if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp']))
                                                <a href="{{ $path }}" target="_blank">
                                                    <img src="{{ $path }}" class="img-thumbnail"
                                                        style="max-height:180px;">
                                                </a>
                                            @else
                                                <a href="{{ $path }}" target="_blank"
                                                    class="btn btn-sm btn-primary">
                                                    View Document
                                                </a>
                                            @endif

                                        </div>
                                    @endif
                                @endforeach

                            </div>

                        </div>

                    </div>

                @endif



                {{-- ACTIONS --}}
                <div class="card shadow-sm">

                    <div class="card-body">

                        <h5 class="border-bottom pb-2">Actions</h5>

                        <div class="d-flex gap-2">

                            @if ($user->role == 'seeker')

                                @if (optional($user->seekerProfile)->is_verified)
                                    <form method="POST" action="{{ route('admin.users.unverify', $user->id) }}">
                                        @csrf
                                        <button class="btn btn-danger btn-sm">Unverify</button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('admin.users.verify', $user->id) }}">
                                        @csrf
                                        <button class="btn btn-success btn-sm">Verify</button>
                                    </form>
                                @endif
                            @else
                                @if (optional($user->providerProfile)->is_verified)
                                    <form method="POST" action="{{ route('admin.users.unverify', $user->id) }}">
                                        @csrf
                                        <button class="btn btn-danger btn-sm">Unverify</button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('admin.users.verify', $user->id) }}">
                                        @csrf
                                        <button class="btn btn-success btn-sm">Verify</button>
                                    </form>
                                @endif

                            @endif

                        </div>

                    </div>

                </div>



            </div>

        </main>

    </div>

    @include('layouts.admin.script')

</body>

</html>