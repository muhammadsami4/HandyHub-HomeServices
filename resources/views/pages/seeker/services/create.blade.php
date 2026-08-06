@include('layouts.admin.head')

<style>
    .service-card {
        border: none; border-radius: 18px; overflow: hidden;
        transition: all .3s ease; background: #fff; height: 100%;
    }
    .service-card:hover { transform: translateY(-8px); box-shadow: 0 15px 40px rgba(249,115,22,.15); }

    /* Service icon  unique color per card using nth-child */
    .service-icon {
        width: 80px; height: 80px; border-radius: 20px;
        display: flex; align-items: center; justify-content: center; margin-bottom: 20px;
    }
    .service-icon i { font-size: 32px; color: #fff; }

    .si-orange  { background: linear-gradient(135deg, #f97316, #ea580c); box-shadow: 0 6px 18px rgba(249,115,22,.35); }
    .si-blue    { background: linear-gradient(135deg, #0284c7, #0ea5e9); box-shadow: 0 6px 18px rgba(14,165,233,.35); }
    .si-green   { background: linear-gradient(135deg, #16a34a, #22c55e); box-shadow: 0 6px 18px rgba(34,197,94,.35); }
    .si-purple  { background: linear-gradient(135deg, #7c3aed, #a855f7); box-shadow: 0 6px 18px rgba(168,85,247,.35); }
    .si-teal    { background: linear-gradient(135deg, #0d9488, #14b8a6); box-shadow: 0 6px 18px rgba(20,184,166,.35); }
    .si-rose    { background: linear-gradient(135deg, #e11d48, #f43f5e); box-shadow: 0 6px 18px rgba(244,63,94,.35); }

    .service-title { font-size: 20px; font-weight: 700; color: #111827; margin-bottom: 10px; }
    .service-desc  { color: #6b7280; font-size: 14px; line-height: 1.7; min-height: 60px; }

    .apply-btn {
        background: linear-gradient(135deg, #f97316, #ea580c);
        color: #fff; border: none; border-radius: 12px;
        padding: 11px 26px; font-weight: 600; font-size: 14px;
        box-shadow: 0 4px 14px rgba(249,115,22,.3); transition: all .2s;
    }
    .apply-btn:hover { opacity: .88; transform: translateY(-1px); color: #fff; }

    .page-top {
        background: linear-gradient(135deg, #f97316, #ea580c);
        border-radius: 20px; padding: 35px; color: white; margin-bottom: 35px;
        box-shadow: 0 8px 24px rgba(249,115,22,.3);
    }
    .page-top h1 { font-size: 36px; font-weight: 800; margin-bottom: 8px; }
    .page-top p  { margin: 0; opacity: .85; }

    .modal-content { border: none; border-radius: 20px; overflow: hidden; }
    .modal-header  {
        background: linear-gradient(135deg, #f97316, #ea580c);
        color: white; border: none; padding: 20px 25px;
    }
    .modal-title { font-weight: 700; }
    .btn-close   { filter: brightness(0) invert(1); }
    .modal-body  { padding: 25px; }
    .modal-footer { border: none; padding: 20px 25px; }

    .form-label  { font-weight: 600; margin-bottom: 8px; color: #374151; }
    .form-control {
        border-radius: 12px; min-height: 48px;
        border: 1.5px solid #d1d5db; box-shadow: none;
    }
    .form-control:focus {
        border-color: #f97316;
        box-shadow: 0 0 0 3px rgba(249,115,22,.12);
    }
    textarea.form-control { min-height: 120px; }

    .btn-submit {
        background: linear-gradient(135deg, #16a34a, #22c55e);
        color: #fff; border: none; border-radius: 12px;
        padding: 11px 28px; font-weight: 700; font-size: 14px;
        box-shadow: 0 4px 14px rgba(34,197,94,.3); transition: all .2s;
    }
    .btn-submit:hover { opacity: .88; transform: translateY(-1px); color: #fff; }

    .btn-location {
        background: linear-gradient(135deg, #1f2937, #374151);
        color: #fff; border: none; border-radius: 12px;
        padding: 10px 20px; font-weight: 600; transition: all .2s;
    }
    .btn-location:hover { opacity: .88; color: #fff; }

    /* Upload box */
    .upload-box {
        border: 2px dashed #fed7aa; border-radius: 14px;
        padding: 20px; text-align: center; background: #fff7ed;
        cursor: pointer; transition: all .2s; position: relative;
    }
    .upload-box:hover { border-color: #f97316; background: #ffedd5; }
    .upload-box input[type="file"] {
        position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
    }
    .upload-box .upload-icon { font-size: 28px; color: #f97316; margin-bottom: 6px; }
    .upload-box .upload-text { font-size: 13px; color: #6b7280; margin: 0; }
    .upload-box .upload-hint { font-size: 11px; color: #9ca3af; margin-top: 4px; }

    #previewContainer img {
        width: 100%; max-height: 200px; object-fit: cover;
        border-radius: 12px; border: 2px solid #fed7aa; margin-top: 10px;
    }
</style>

<body>
<div class="overlay" id="overlay" onclick="closeMobileSidebar()"></div>
@include('layouts.admin.sidebar')
<div class="main-wrap" id="mainWrap">
@include('layouts.admin.header')
<main class="content">

    <div class="page-top">
        <h1>Available Services</h1>
        <p>Seeker / Services</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        @php $iconClasses = ['si-orange','si-blue','si-green','si-purple','si-teal','si-rose']; @endphp

        @foreach($services as $service)
            <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                <div class="card service-card shadow-sm">
                    <div class="card-body p-4">
                        <div class="service-icon {{ $iconClasses[$loop->index % 6] }}">
                            <i class="{{ $service->icon }}"></i>
                        </div>
                        <h3 class="service-title">{{ $service->name }}</h3>
                        <p class="service-desc">{{ $service->description }}</p>
                        <button class="apply-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#applyModal{{ $service->id }}">
                            <i class="fas fa-paper-plane me-2"></i>Apply Now
                        </button>
                    </div>
                </div>
            </div>

            {{-- APPLY MODAL --}}
            <div class="modal fade" id="applyModal{{ $service->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('seeker.services.request') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Apply For {{ $service->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="service_id" value="{{ $service->id }}">

                                <div class="mb-4">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control" placeholder="Describe your requirements..."></textarea>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Work Picture <span class="text-muted fw-normal small">(Optional)</span></label>
                                    <div class="upload-box">
                                        <input type="file" name="work_picture" accept="image/jpeg,image/png,image/jpg"
                                               onchange="previewImage(event, {{ $service->id }})">
                                        <div class="upload-icon"><i class="fas fa-image"></i></div>
                                        <p class="upload-text">Upload work picture or work place</p>
                                        <p class="upload-hint">JPG, JPEG, PNG  max 2MB</p>
                                    </div>
                                    <div id="previewContainer{{ $service->id }}"></div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Price Range</label>
                                    <input type="text" name="price_range" class="form-control" placeholder="Example: 2000 - 5000">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Current Location</label>
                                    <input type="text" name="location" id="location{{ $service->id }}" class="form-control" placeholder="Your live location">
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Latitude</label>
                                        <input type="text" name="latitude" id="latitude{{ $service->id }}" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Longitude</label>
                                        <input type="text" name="longitude" id="longitude{{ $service->id }}" class="form-control" readonly>
                                    </div>
                                </div>

                                <button type="button" class="btn-location" onclick="getLocation({{ $service->id }})">
                                    <i class="fas fa-map-marker-alt me-2"></i>Get Live Location
                                </button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn-submit">
                                    <i class="fas fa-check me-2"></i>Submit Request
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</main>
</div>

<script>
    function previewImage(event, serviceId) {
        const file = event.target.files[0];
        const container = document.getElementById('previewContainer' + serviceId);
        container.innerHTML = '';
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                const img = document.createElement('img');
                img.src = e.target.result;
                container.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    }
    function getLocation(serviceId) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                pos => showPosition(pos, serviceId), showError
            );
        } else alert("Geolocation not supported.");
    }
    function showPosition(position, serviceId) {
        const lat = position.coords.latitude;
        const lng = position.coords.longitude;
        document.getElementById("latitude" + serviceId).value = lat;
        document.getElementById("longitude" + serviceId).value = lng;
        document.getElementById("location" + serviceId).value = "https://maps.google.com/?q=" + lat + "," + lng;
    }
    function showError(error) { alert("Location error: " + error.message); }
</script>

@include('layouts.admin.script')
</body>