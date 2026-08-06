@include('layouts.admin.head')

<body>

    <div class="overlay" onclick="closeMobileSidebar()"></div>

    @include('layouts.admin.sidebar')

    <div class="main-wrap" id="mainWrap">

        @include('layouts.admin.header')

        <main class="content">

            <div class="container-fluid">

                {{-- HEADER --}}
                <div class="d-flex justify-content-between mb-4">

                    <div>
                        <h1 class="page-title">Seeker Profile</h1>
                        <p class="breadcrumb-text">Profile / KYC</p>
                    </div>

                    <div>
                        @if ($profile && $profile->profile_completed)
                            <span class="badge bg-success">Completed</span>
                        @else
                            <span class="badge bg-warning text-dark">Incomplete</span>
                        @endif
                    </div>

                </div>



                <div class="card border-0 shadow-sm rounded-4">

                    <div class="card-body p-4">

                        <form method="POST" action="{{ route('seeker.profile.store') }}" enctype="multipart/form-data">

                            @csrf

                            <div class="row">




                                {{-- USER INFO --}}
                                <div class="col-12 mb-3">
                                    <h5 class="border-bottom pb-2">User Information</h5>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Name</label>
                                    <input class="form-control form-control-sm" value="{{ auth()->user()->name }}"
                                        readonly>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input class="form-control form-control-sm" value="{{ auth()->user()->email }}"
                                        readonly>
                                </div>




                                {{-- BASIC INFO --}}
                                <div class="col-12 mb-3 mt-3">
                                    <h5 class="border-bottom pb-2">Basic Info</h5>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control form-control-sm"
                                        value="{{ old('phone', $profile->phone ?? '') }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Gender</label>
                                    <select name="gender" class="form-control form-control-sm">
                                        <option value="">Select</option>
                                        <option value="male" {{ ($profile->gender ?? '') == 'male' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="female" {{ ($profile->gender ?? '') == 'female' ? 'selected' : '' }}>
                                            Female</option>
                                        <option value="other" {{ ($profile->gender ?? '') == 'other' ? 'selected' : '' }}>
                                            Other</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Date of Birth</label>
                                    <input type="date" name="date_of_birth" class="form-control form-control-sm"
                                        value="{{ old('date_of_birth', $profile->date_of_birth ?? '') }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Bio</label>
                                    <textarea name="bio" class="form-control form-control-sm" placeholder="Short bio">{{ old('bio', $profile->bio ?? '') }}</textarea>
                                </div>




                                {{-- ADDRESS --}}
                                <div class="col-12 mb-3 mt-3">
                                    <h5 class="border-bottom pb-2">Address</h5>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Province</label>
                                    <input type="text" name="province" class="form-control form-control-sm"
                                        value="{{ old('province', $profile->province ?? '') }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>City</label>
                                    <input type="text" name="city" class="form-control form-control-sm"
                                        value="{{ old('city', $profile->city ?? '') }}">
                                </div>

                                <div class="col-12 mb-3">
                                    <label>Home Address</label>
                                    <textarea name="home_address" class="form-control form-control-sm" placeholder="Full address">{{ old('home_address', $profile->home_address ?? '') }}</textarea>
                                </div>




                                {{-- DOCUMENTS --}}
                                <div class="col-12 mb-3 mt-3">
                                    <h5 class="border-bottom pb-2">Documents</h5>
                                </div>




                                @php
                                    $docs = [
                                        'cnic_front' => 'CNIC Front',
                                        'cnic_back' => 'CNIC Back',
                                        'income_proof' => 'Income Proof',
                                        'profile_image' => 'Profile Image',
                                    ];
                                @endphp




                                @foreach ($docs as $field => $label)
                                    <div class="col-md-6 mb-4">

                                        <label class="form-label">{{ $label }}</label>

                                        <input type="file" name="{{ $field }}"
                                            class="form-control form-control-sm">

                                        @if (!empty($profile->$field))
                                            <div class="mt-2">

                                                @php
                                                    $file = $profile->$field;
                                                    $ext = pathinfo($file, PATHINFO_EXTENSION);
                                                @endphp

                                                {{-- IMAGE PREVIEW --}}
                                                @if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp']))
                                                    <img src="{{ asset('assets/documents/' . $file) }}" width="100"
                                                        class="img-thumbnail">
                                                @else
                                                    {{-- PDF / OTHER FILE --}}
                                                    <a href="{{ asset('assets/documents/' . $file) }}" target="_blank"
                                                        class="btn btn-sm btn-primary">
                                                        View File
                                                    </a>
                                                @endif

                                            </div>
                                        @endif

                                    </div>
                                @endforeach




                                {{-- SUBMIT --}}
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary btn-sm px-4">
                                        Save Profile
                                    </button>
                                </div>



                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </main>

    </div>

    @include('layouts.admin.script')

</body>

</html>
