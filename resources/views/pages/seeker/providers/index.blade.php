@include('layouts.admin.head')

<style>
    .page-header {
        background: linear-gradient(135deg, #f97316, #ea580c);
        padding: 30px; border-radius: 18px; color: #fff; margin-bottom: 25px;
        box-shadow: 0 8px 24px rgba(249,115,22,.3);
    }
    .page-header h1 { font-size: 28px; font-weight: 800; margin-bottom: 4px; }

    .filter-box {
        background: #fff; border-radius: 14px; padding: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,.05); margin-bottom: 25px;
        border: 1px solid #f3f4f6;
    }
    .form-control, .form-select {
        border-radius: 10px; border: 1.5px solid #e5e7eb; padding: 10px 14px; transition: all .2s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #f97316; box-shadow: 0 0 0 3px rgba(249,115,22,.12);
    }
    .btn-filter {
        background: linear-gradient(135deg, #f97316, #ea580c);
        color: #fff; border: none; border-radius: 10px;
        padding: 10px 20px; font-weight: 600;
        box-shadow: 0 4px 12px rgba(249,115,22,.3); transition: all .2s;
    }
    .btn-filter:hover { opacity: .88; transform: translateY(-1px); }
    .btn-reset {
        background: #f3f4f6; color: #374151; border: none;
        border-radius: 10px; padding: 10px 20px; font-weight: 600;
    }

    /* Provider cards */
    .provider-card {
        background: #fff; border-radius: 18px;
        border: 1.5px solid #e5e7eb; padding: 22px;
        transition: all .25s; height: 100%;
    }
    .provider-card:hover {
        box-shadow: 0 12px 30px rgba(249,115,22,.12);
        border-color: #fed7aa; transform: translateY(-4px);
    }

    .provider-avatar {
        width: 56px; height: 56px; border-radius: 50%;
        background: linear-gradient(135deg, #f97316, #ea580c);
        color: #fff; font-size: 20px; font-weight: 700;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0; text-transform: uppercase;
        box-shadow: 0 4px 12px rgba(249,115,22,.3);
    }

    .verified-badge {
        background: #dcfce7; color: #166534; border: 1px solid #bbf7d0;
        padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600;
    }
    .category-badge {
        background: #fff7ed; color: #c2410c; border: 1px solid #fed7aa;
        padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600;
    }
    .exp-badge {
        background: #fef3c7; color: #92400e; border: 1px solid #fde68a;
        padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600;
    }

    .btn-request {
        background: linear-gradient(135deg, #f97316, #ea580c);
        color: #fff; border: none; border-radius: 10px;
        padding: 10px 20px; font-weight: 600; font-size: 13px;
        text-decoration: none; display: inline-block; transition: all .2s;
        box-shadow: 0 4px 14px rgba(249,115,22,.3); width: 100%; text-align: center;
    }
    .btn-request:hover { opacity: .88; color: #fff; transform: translateY(-1px); }

    .empty-state { text-align: center; padding: 60px; color: #9ca3af; }
</style>

<body>
<div class="overlay" id="overlay" onclick="closeMobileSidebar()"></div>
@include('layouts.admin.sidebar')
<div class="main-wrap" id="mainWrap">
@include('layouts.admin.header')
<main class="content">

    <div class="page-header">
        <h1>Find Providers</h1>
        <p style="opacity:.85;margin:0;">Find Service Provider According To Your Need</p>
    </div>

    <div class="filter-box">
        <form method="GET" action="{{ route('seeker.providers') }}">
            <div class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="form-label fw-semibold small">Category</label>
                    <select name="category" class="form-select">
                        <option value="">Choose Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <label class="form-label fw-semibold small">Search</label>
                    <input type="text" name="search" class="form-control"
                           placeholder="Service Title Or Description"
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn-filter w-100">
                        <i class="fas fa-search me-1"></i>Find
                    </button>
                </div>
            </div>
            @if(request('category') || request('search'))
                <div class="mt-2">
                    <a href="{{ route('seeker.providers') }}" class="btn-reset btn btn-sm">
                        Clear Filter
                    </a>
                </div>
            @endif
        </form>
    </div>

    <div class="mb-3">
        <span class="text-muted small fw-semibold">{{ $providers->count() }} provider available</span>
    </div>

    @if($providers->isEmpty())
        <div class="empty-state">
            <h5>No Provider Found</h5>
            <p>Try a different category or clear the search filter.</p>
        </div>
    @else
        <div class="row g-4">
            @foreach($providers as $prov)
                <div class="col-md-6 col-lg-4">
                    <div class="provider-card">

                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="provider-avatar">
                                {{ strtoupper(substr($prov->provider->name, 0, 2)) }}
                            </div>
                            <div>
                                <div class="fw-bold">{{ $prov->provider->name }}</div>
                                <div class="d-flex gap-1 flex-wrap mt-1">
                                    @if($prov->provider->providerProfile?->is_verified)
                                        <span class="verified-badge">Verified</span>
                                    @endif
                                    <span class="category-badge">{{ $prov->service->name }}</span>
                                </div>
                            </div>
                        </div>

                        <h6 class="fw-bold mb-1">{{ $prov->title }}</h6>
                        @if($prov->description)
                            <p class="text-muted small mb-2" style="line-height:1.5;">
                                {{ Str::limit($prov->description, 100) }}
                            </p>
                        @endif

                        @if($prov->experience)
                            <span class="exp-badge mb-3 d-inline-block">
                                Experience: {{ $prov->experience }}
                            </span>
                        @endif

                        <hr class="my-3">

                        @if($prov->provider->providerProfile?->organization_name)
                            <div class="small text-muted mb-3 fw-semibold">
                                <i class="fas fa-building me-1"></i>
                                {{ $prov->provider->providerProfile->organization_name }}
                            </div>
                        @endif

                        <a href="{{ route('seeker.services.create') }}" class="btn-request">
                            <i class="fas fa-paper-plane me-1"></i>Send Request
                        </a>

                    </div>
                </div>
            @endforeach
        </div>
    @endif

</main>
</div>
@include('layouts.admin.script')
</body>