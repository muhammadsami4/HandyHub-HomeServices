@include('layouts.admin.head')

<style>
    /*  Header  */
    .page-header {
        background: linear-gradient(135deg, #f97316, #ea580c);
        padding: 30px; border-radius: 18px; color: #fff; margin-bottom: 25px;
        box-shadow: 0 8px 24px rgba(249,115,22,.3);
    }
    .page-header h1 { font-size: 28px; font-weight: 800; margin-bottom: 4px; }

    .card-box {
        background: #fff; border-radius: 16px; padding: 25px;
        box-shadow: 0 4px 20px rgba(0,0,0,.06); margin-bottom: 25px;
        border: 1px solid #f3f4f6;
    }
    .card-box h5 { font-size: 16px; font-weight: 700; color: #111827; }

    .form-control, .form-select {
        border-radius: 10px; border: 1.5px solid #e5e7eb;
        padding: 10px 14px; font-size: 14px; transition: all .2s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #f97316;
        box-shadow: 0 0 0 3px rgba(249,115,22,.12);
    }

    /*  Add Button  */
    .btn-add {
        background: linear-gradient(135deg, #f97316, #ea580c);
        color: #fff; border: none; border-radius: 10px;
        padding: 11px 26px; font-weight: 600; font-size: 14px;
        transition: all .2s; box-shadow: 0 4px 14px rgba(249,115,22,.35);
    }
    .btn-add:hover { opacity: .88; transform: translateY(-1px); color: #fff; }

    /*  Service Card  */
    .service-card {
        background: #fff; border-radius: 14px;
        border: 1.5px solid #e5e7eb; padding: 20px; margin-bottom: 14px;
        transition: all .25s;
    }
    .service-card:hover {
        box-shadow: 0 8px 24px rgba(249,115,22,.1);
        border-color: #fed7aa; transform: translateX(3px);
    }

    /*  Badges  */
    .category-badge {
        background: linear-gradient(135deg, #fff7ed, #ffedd5);
        color: #c2410c; border: 1px solid #fed7aa;
        padding: 4px 12px; border-radius: 20px;
        font-size: 12px; font-weight: 600;
    }
    .exp-badge {
        background: linear-gradient(135deg, #f0fdf4, #dcfce7);
        color: #166534; border: 1px solid #bbf7d0;
        padding: 4px 12px; border-radius: 20px;
        font-size: 12px; font-weight: 600;
    }

    /*  Delete Button  */
    .btn-delete {
        background: linear-gradient(135deg, #fee2e2, #fecaca);
        color: #991b1b; border: 1px solid #fca5a5;
        border-radius: 8px; padding: 6px 14px;
        font-size: 13px; font-weight: 600; cursor: pointer; transition: all .2s;
    }
    .btn-delete:hover {
        background: linear-gradient(135deg, #dc2626, #b91c1c);
        color: #fff; border-color: #dc2626;
    }

    .empty-state { text-align: center; padding: 40px; color: #9ca3af; }
</style>

<body>
@include('layouts.admin.sidebar')
<div class="main-wrap" id="mainWrap">
@include('layouts.admin.header')
<main class="content">

    <div class="page-header">
        <h1>My Services</h1>
        <p style="opacity:.85;margin:0;">List your services so customers can find and contact you.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card-box">
        <h5 class="fw-bold mb-4">Add Service</h5>
        <form action="{{ route('provider.services.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Category <span class="text-danger">*</span></label>
                    <select name="service_id" class="form-select" required>
                        <option value="">Choose Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('service_id')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Experience</label>
                    <input type="text" name="experience" class="form-control" placeholder="e.g. Years/Months">
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Service Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" required placeholder="e.g. Home Wiring/AC Cleaning">
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Explain your work in detail"></textarea>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn-add">
                        <i class="fas fa-plus me-2"></i>Add Service
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="card-box">
        <h5 class="fw-bold mb-4">My Services ({{ $myServices->count() }})</h5>

        @forelse($myServices as $svc)
            <div class="service-card">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                    <div class="flex-grow-1">
                        <div class="d-flex gap-2 align-items-center mb-2 flex-wrap">
                            <span class="category-badge">
                                <i class="{{ $svc->service->icon ?? 'fas fa-tools' }} me-1"></i>
                                {{ $svc->service->name }}
                            </span>
                            @if($svc->experience)
                                <span class="exp-badge">{{ $svc->experience }}</span>
                            @endif
                        </div>
                        <h6 class="fw-bold mb-1">{{ $svc->title }}</h6>
                        @if($svc->description)
                            <p class="text-muted small mb-0">{{ $svc->description }}</p>
                        @endif
                    </div>
                    <form action="{{ route('provider.services.destroy', $svc->id) }}" method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this service?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">
                            <i class="fas fa-trash me-1"></i>Delete
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <h6>No Service Added Yet</h6>
                <p class="small">Complete the form above to add your first service.</p>
            </div>
        @endforelse
    </div>

</main>
</div>
@include('layouts.admin.script')
</body>