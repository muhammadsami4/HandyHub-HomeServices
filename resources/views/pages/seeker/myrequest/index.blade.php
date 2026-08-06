@include('layouts.admin.head')

<style>
    .page-header {
        background: linear-gradient(135deg, #f97316, #ea580c);
        padding: 30px; border-radius: 18px; color: #fff; margin-bottom: 25px;
        box-shadow: 0 8px 24px rgba(249,115,22,.3);
    }
    .page-header h1 { font-size: 28px; font-weight: 800; margin-bottom: 4px; }

    .table-card {
        background: #fff; border-radius: 16px; padding: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,.06); border: 1px solid #f3f4f6;
    }

    .status-badge { padding: 5px 14px; border-radius: 20px; font-size: 12px; font-weight: 700; }
    .pending  { background: #fef3c7; color: #92400e; }
    .accepted { background: #dcfce7; color: #166534; }
    .rejected { background: #fee2e2; color: #991b1b; }

    .modal-header {
        background: linear-gradient(135deg, #f97316, #ea580c) !important;
        color: #fff;
    }

    /* Buttons */
    .btn-details {
        background: linear-gradient(135deg, #0284c7, #0ea5e9);
        color: #fff; border: none; border-radius: 8px;
        padding: 5px 14px; font-size: 13px; font-weight: 600;
        box-shadow: 0 3px 10px rgba(14,165,233,.25); transition: all .2s; cursor: pointer;
    }
    .btn-details:hover { opacity: .88; transform: translateY(-1px); color: #fff; }

    .btn-chat {
        background: linear-gradient(135deg, #0d9488, #14b8a6);
        color: #fff; border: none; border-radius: 8px;
        padding: 5px 14px; font-size: 13px; font-weight: 600;
        text-decoration: none; display: inline-flex; align-items: center; gap: 5px;
        box-shadow: 0 3px 10px rgba(20,184,166,.25); transition: all .2s;
    }
    .btn-chat:hover { opacity: .88; color: #fff; transform: translateY(-1px); }

    .unread-badge {
        background: #ef4444; color: #fff; border-radius: 50%;
        width: 18px; height: 18px; font-size: 10px;
        display: inline-flex; align-items: center; justify-content: center;
    }

    .modal-work-pic {
        width: 100%; max-height: 260px; object-fit: cover;
        border-radius: 12px; border: 2px solid #e5e7eb;
    }

    .table tbody tr:hover { background: #fff7ed; }
    .table thead th { background: #1f2937; color: #fff; font-weight: 600; }
</style>

<body>
<div class="overlay" id="overlay" onclick="closeMobileSidebar()"></div>
@include('layouts.admin.sidebar')
<div class="main-wrap" id="mainWrap">
@include('layouts.admin.header')
<main class="content">

    <div class="page-header">
        <h1>My Service Requests</h1>
        <p style="opacity:.85;margin:0;">Track all your submitted service requests</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-card">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Service</th>
                    <th>Price Range</th>
                    <th>Status</th>
                    <th>Location</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $request)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <i class="{{ $request->service->icon }}"></i>
                            <span class="fw-semibold">{{ $request->service->name }}</span>
                        </td>
                        <td>{{ $request->price_range ?? 'N/A' }}</td>
                        <td>
                            @if($request->status == 'accepted')
                                <span class="status-badge accepted">Accepted</span>
                            @elseif($request->status == 'rejected')
                                <span class="status-badge rejected">Rejected</span>
                            @else
                                <span class="status-badge pending">Pending</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ $request->location }}" target="_blank"
                               style="color:#f97316;font-weight:600;text-decoration:none;">
                                <i class="fas fa-map-marker-alt me-1"></i>View Map
                            </a>
                        </td>
                        <td>
                            <div class="d-flex gap-2 align-items-center flex-wrap">
                                <button class="btn-details"
                                        data-bs-toggle="modal"
                                        data-bs-target="#viewModal{{ $request->id }}">
                                    <i class="fas fa-eye me-1"></i>View Details
                                </button>

                                @if($request->status == 'accepted')
                                    @php
                                        $provId = \Illuminate\Support\Facades\DB::table('service_requests')
                                            ->where('id', $request->id)->value('provider_id');
                                        $unread = \App\Models\ChatMessage::where('booking_id', $request->id)
                                            ->where('receiver_id', auth()->id())
                                            ->whereNull('read_at')->count();
                                    @endphp
                                    @if($provId)
                                        <a href="{{ route('chat.booking', $request->id) }}" class="btn-chat">
                                            <i class="bi bi-chat-dots-fill"></i>Chat
                                            @if($unread > 0)
                                                <span class="unread-badge">{{ $unread }}</span>
                                            @endif
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </td>
                    </tr>

                    {{-- VIEW MODAL --}}
                    <div class="modal fade" id="viewModal{{ $request->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Request Details</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Service:</strong> {{ $request->service->name }}</p>
                                    <p><strong>Description:</strong> {{ $request->description }}</p>
                                    <p><strong>Price Range:</strong> {{ $request->price_range }}</p>

                                    @if($request->work_picture)
                                        <hr>
                                        <p><strong>Work Picture:</strong></p>
                                        <img src="{{ asset('assets/documents/' . $request->work_picture) }}"
                                             class="modal-work-pic mb-3" alt="Work Picture">
                                    @endif

                                    <hr>
                                    <p><strong>Location:</strong>
                                        <a href="{{ $request->location }}" target="_blank">Open Map</a>
                                    </p>
                                    <p><strong>Latitude:</strong> {{ $request->latitude }}</p>
                                    <p><strong>Longitude:</strong> {{ $request->longitude }}</p>
                                    <hr>
                                    <p><strong>Status:</strong> {{ ucfirst($request->status ?? 'pending') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">No Requests Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</main>
</div>
@include('layouts.admin.script')
</body>