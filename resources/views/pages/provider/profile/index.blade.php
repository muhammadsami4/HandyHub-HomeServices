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

            <div class="container-fluid">

                <!-- PAGE HEADER -->
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">

                    <div>
                        <h1 class="page-title mb-1">Provider Profile</h1>

                        <p class="breadcrumb-text mb-0">
                            Dashboard / Provider Profile
                        </p>
                    </div>

                    <div>

                        @if($profile && $profile->is_verified)

                            <span class="badge bg-success px-4 py-2">
                                Verified Account
                            </span>

                        @else

                            <span class="badge bg-warning text-dark px-4 py-2">
                                Verification Pending
                            </span>

                        @endif

                    </div>

                </div>




                <!-- SUCCESS MESSAGE -->
                @if(session('success'))

                    <div class="alert alert-success alert-dismissible fade show">

                        {{ session('success') }}

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"></button>

                    </div>

                @endif




                <!-- VALIDATION ERRORS -->
                @if($errors->any())

                    <div class="alert alert-danger">

                        <ul class="mb-0">

                            @foreach($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif






                <!-- PROFILE CARD -->
                <div class="card border-0 shadow-sm rounded-4">

                    <div class="card-body p-4">

                        <form action="{{ route('provider.profile.store') }}"
                              method="POST"
                              enctype="multipart/form-data">

                            @csrf

                            <div class="row">



                                <!-- USER INFORMATION -->
                                <div class="col-12 mb-4">

                                    <h5 class="fw-bold border-bottom pb-2">
                                        User Information
                                    </h5>

                                </div>




                                <!-- NAME -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label small fw-semibold">
                                        Full Name
                                    </label>

                                    <input type="text"
                                           class="form-control form-control-sm"
                                           value="{{ auth()->user()->name }}"
                                           readonly>

                                </div>





                                <!-- EMAIL -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label small fw-semibold">
                                        Email Address
                                    </label>

                                    <input type="email"
                                           class="form-control form-control-sm"
                                           value="{{ auth()->user()->email }}"
                                           readonly>

                                </div>






                                <!-- ORGANIZATION INFORMATION -->
                                <div class="col-12 mb-4">

                                    <h5 class="fw-bold border-bottom pb-2">
                                        Organization Information
                                    </h5>

                                </div>





                                <!-- ORGANIZATION NAME -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label small fw-semibold">
                                        Organization Name
                                    </label>

                                    <input type="text"
                                           name="organization_name"
                                           class="form-control form-control-sm"
                                           value="{{ old('organization_name', $profile->organization_name ?? '') }}">

                                </div>






                                <!-- ORGANIZATION TYPE -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label small fw-semibold">
                                        Organization Type
                                    </label>

                                    <input type="text"
                                           name="organization_type"
                                           class="form-control form-control-sm"
                                           placeholder="NGO / Welfare / Trust"
                                           value="{{ old('organization_type', $profile->organization_type ?? '') }}">

                                </div>






                                <!-- PHONE -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label small fw-semibold">
                                        Phone Number
                                    </label>

                                    <input type="text"
                                           name="phone"
                                           class="form-control form-control-sm"
                                           value="{{ old('phone', $profile->phone ?? '') }}">

                                </div>






                                <!-- WEBSITE -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label small fw-semibold">
                                        Website
                                    </label>

                                    <input type="text"
                                           name="website"
                                           class="form-control form-control-sm"
                                           value="{{ old('website', $profile->website ?? '') }}">

                                </div>







                                <!-- ADDRESS INFORMATION -->
                                <div class="col-12 mb-4">

                                    <h5 class="fw-bold border-bottom pb-2">
                                        Address Information
                                    </h5>

                                </div>






                                <!-- PROVINCE -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label small fw-semibold">
                                        Province
                                    </label>

                                    <input type="text"
                                           name="province"
                                           class="form-control form-control-sm"
                                           value="{{ old('province', $profile->province ?? '') }}">

                                </div>






                                <!-- CITY -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label small fw-semibold">
                                        City
                                    </label>

                                    <input type="text"
                                           name="city"
                                           class="form-control form-control-sm"
                                           value="{{ old('city', $profile->city ?? '') }}">

                                </div>






                                <!-- ADDRESS -->
                                <div class="col-12 mb-4">

                                    <label class="form-label small fw-semibold">
                                        Full Address
                                    </label>

                                    <textarea name="address"
                                              rows="3"
                                              class="form-control form-control-sm">{{ old('address', $profile->address ?? '') }}</textarea>

                                </div>







                                <!-- BUSINESS DETAILS -->
                                <div class="col-12 mb-4">

                                    <h5 class="fw-bold border-bottom pb-2">
                                        Business Details
                                    </h5>

                                </div>






                                <!-- REGISTRATION NUMBER -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label small fw-semibold">
                                        Registration Number
                                    </label>

                                    <input type="text"
                                           name="registration_number"
                                           class="form-control form-control-sm"
                                           value="{{ old('registration_number', $profile->registration_number ?? '') }}">

                                </div>






                                <!-- EMPTY -->
                                <div class="col-md-6 mb-4"></div>






                                <!-- DESCRIPTION -->
                                <div class="col-12 mb-4">

                                    <label class="form-label small fw-semibold">
                                        Organization Description
                                    </label>

                                    <textarea name="description"
                                              rows="4"
                                              class="form-control form-control-sm">{{ old('description', $profile->description ?? '') }}</textarea>

                                </div>








                                <!-- DOCUMENTS -->
                                <div class="col-12 mb-4">

                                    <h5 class="fw-bold border-bottom pb-2">
                                        Verification Documents
                                    </h5>

                                </div>







                                <!-- REGISTRATION CERTIFICATE -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label small fw-semibold">
                                        Registration Certificate
                                    </label>

                                    <input type="file"
                                           name="registration_certificate"
                                           class="form-control form-control-sm">

                                    @if(!empty($profile->registration_certificate))

                                        @php
                                            $regExt = pathinfo($profile->registration_certificate, PATHINFO_EXTENSION);
                                        @endphp

                                        <div class="mt-2">

                                            @if(in_array(strtolower($regExt), ['jpg','jpeg','png']))

                                                <img src="{{ asset('assets/documents/' . $profile->registration_certificate) }}"
                                                     class="img-thumbnail"
                                                     width="140">

                                            @else

                                                <a href="{{ asset('assets/documents/' . $profile->registration_certificate) }}"
                                                   target="_blank"
                                                   class="btn btn-sm btn-primary">

                                                    Preview Document

                                                </a>

                                            @endif

                                        </div>

                                    @endif

                                </div>








                                <!-- TAX CERTIFICATE -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label small fw-semibold">
                                        Tax Certificate
                                    </label>

                                    <input type="file"
                                           name="tax_certificate"
                                           class="form-control form-control-sm">

                                    @if(!empty($profile->tax_certificate))

                                        @php
                                            $taxExt = pathinfo($profile->tax_certificate, PATHINFO_EXTENSION);
                                        @endphp

                                        <div class="mt-2">

                                            @if(in_array(strtolower($taxExt), ['jpg','jpeg','png']))

                                                <img src="{{ asset('assets/documents/' . $profile->tax_certificate) }}"
                                                     class="img-thumbnail"
                                                     width="140">

                                            @else

                                                <a href="{{ asset('assets/documents/' . $profile->tax_certificate) }}"
                                                   target="_blank"
                                                   class="btn btn-sm btn-primary">

                                                    Preview Document

                                                </a>

                                            @endif

                                        </div>

                                    @endif

                                </div>








                                <!-- ORGANIZATION LOGO -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label small fw-semibold">
                                        Organization Logo
                                    </label>

                                    <input type="file"
                                           name="organization_logo"
                                           class="form-control form-control-sm">

                                    @if(!empty($profile->organization_logo))

                                        <div class="mt-2">

                                            <img src="{{ asset('assets/documents/' . $profile->organization_logo) }}"
                                                 class="img-thumbnail"
                                                 width="140">

                                        </div>

                                    @endif

                                </div>








                                <!-- OWNER CNIC FRONT -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label small fw-semibold">
                                        Owner CNIC Front
                                    </label>

                                    <input type="file"
                                           name="owner_cnic_front"
                                           class="form-control form-control-sm">

                                    @if(!empty($profile->owner_cnic_front))

                                        <div class="mt-2">

                                            <img src="{{ asset('assets/documents/' . $profile->owner_cnic_front) }}"
                                                 class="img-thumbnail"
                                                 width="140">

                                        </div>

                                    @endif

                                </div>








                                <!-- OWNER CNIC BACK -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label small fw-semibold">
                                        Owner CNIC Back
                                    </label>

                                    <input type="file"
                                           name="owner_cnic_back"
                                           class="form-control form-control-sm">

                                    @if(!empty($profile->owner_cnic_back))

                                        <div class="mt-2">

                                            <img src="{{ asset('assets/documents/' . $profile->owner_cnic_back) }}"
                                                 class="img-thumbnail"
                                                 width="140">

                                        </div>

                                    @endif

                                </div>








                                <!-- POLICE CLEARANCE CERTIFICATE -->
<div class="col-md-6 mb-4">

    <label class="form-label small fw-semibold">
        Police Clearance Certificate
    </label>

    <input type="file"
           name="police_clearance"
           class="form-control form-control-sm">

    @if(!empty($profile->police_clearance))

        <div class="mt-2">

            <img src="{{ asset('assets/documents/' . $profile->police_clearance) }}"
                 class="img-thumbnail"
                 width="140">

        </div>

    @endif

</div>






                                


                                







                                <!-- SUBMIT BUTTON -->
                                <div class="col-12 mt-3">

                                    <button type="submit"
                                            class="btn btn-primary btn-sm px-4">

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