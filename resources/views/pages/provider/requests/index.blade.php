@include('layouts.admin.head')

<style>
    .page-header {
        background: linear-gradient(135deg, #f97316, #ea580c);
        padding: 30px; border-radius: 18px; color: #fff; margin-bottom: 25px;
        box-shadow: 0 8px 24px rgba(249,115,22,.3);
    }
    .page-header h1 { font-size: 28px; font-weight: 800; margin-bottom: 4px; }

    .table-box {
        background: #fff; border-radius: 16px; padding: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,.06); border: 1px solid #f3f4f6;
    }

    /* Status badges */
    .status { padding: 5px 14px; border-radius: 20px; font-size: 12px; font-weight: 700; }
    .pending  { background: #fef3c7; color: #92400e; }
    .accepted { background: #dcfce7; color: #166534; }
    .rejected { background: #fee2e2; color: #991b1b; }

    /* Action buttons */
    .btn-view {
        background: linear-gradient(135deg, #0284c7, #0ea5e9);
        color: #fff; border: none; border-radius: 8px;
        padding: 5px 14px; font-size: 13px; font-weight: 600;
        text-decoration: none; display: inline-block;
        box-shadow: 0 3px 10px rgba(14,165,233,.3); transition: all .2s;
    }
    .btn-view:hover { opacity: .88; color: #fff; transform: translateY(-1px); }

    .btn-accept {
        background: linear-gradient(135deg, #16a34a, #22c55e);
        color: #fff; border: none; border-radius: 8px;
        padding: 5px 14px; font-size: 13px; font-weight: 600;
        box-shadow: 0 3px 10px rgba(34,197,94,.3); transition: all .2s; cursor: pointer;
    }
    .btn-accept:hover { opacity: .88; transform: translateY(-1px); }

    .btn-reject {
        background: linear-gradient(135deg, #dc2626, #ef4444);
        color: #fff; border: none; border-radius: 8px;
        padding: 5px 14px; font-size: 13px; font-weight: 600;
        box-shadow: 0 3px 10px rgba(239,68,68,.3); transition: all .2s; cursor: pointer;
    }
    .btn-reject:hover { opacity: .88; transform: translateY(-1px); }

    .btn-chat {
        background: linear-gradient(135deg, #0d9488, #14b8a6);
        color: #fff; border: none; border-radius: 8px;
        padding: 5px 12px; font-size: 13px; font-weight: 600;
        text-decoration: none; display: inline-flex; align-items: center; gap: 5px;
        box-shadow: 0 3px 10px rgba(20,184,166,.3); transition: all .2s;
    }
    .btn-chat:hover { opacity: .88; color: #fff; transform: translateY(-1px); }

    .unread-badge {
        background: #ef4444; color: #fff; border-radius: 50%;
        width: 18px; height: 18px; font-size: 10px;
        display: inline-flex; align-items: center; justify-content: center;
    }

    .table thead th { background: #1f2937; color: #fff; font-weight: 600; }
    .table tbody tr:hover { background: #fff7ed; }
</style>

<body>
@include('layouts.admin.sidebar')
<div class="main-wrap" id="mainWrap">
@include('layouts.admin.header')
<main class="content">

    <div class="page-header">
        <h1>Service Requests</h1>
        <p style="opacity:.85;margin:0;">All requests from seekers</p>
    </div>

    <div class="table-box">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Service</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $req)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><span class="fw-semibold">{{ $req->user->name }}</span></td>
                        <td>
                            <i class="{{ $req->service->icon }}"></i>
                            {{ $req->service->name }}
                        </td>
                        <td>{{ $req->price_range ?? 'N/A' }}</td>
                        <td>
                            @if($req->status == 'accepted')
                                <span class="status accepted">Accepted</span>
                            @elseif($req->status == 'rejected')
                                <span class="status rejected">Rejected</span>
                            @else
                                <span class="status pending">Pending</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2 flex-wrap align-items-center">

                                <a href="{{ route('provider.requests.show', $req->id) }}" class="btn-view">
                                    <i class="fas fa-eye me-1"></i>View
                                </a>

                                <form action="{{ route('provider.requests.status', $req->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="status" value="accepted">
                                    <button class="btn-accept"><i class="fas fa-check me-1"></i>Accept</button>
                                </form>

                                <form action="{{ route('provider.requests.status', $req->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="status" value="rejected">
                                    <button class="btn-reject"><i class="fas fa-times me-1"></i>Reject</button>
                                </form>

                                @if($req->status == 'accepted')
                                    @php
                                        $unread = \App\Models\ChatMessage::where('booking_id', $req->id)
                                            ->where('receiver_id', auth()->id())
                                            ->whereNull('read_at')->count();
                                    @endphp
                                    <a href="{{ route('chat.booking', $req->id) }}" class="btn-chat">
                                        <i class="bi bi-chat-dots-fill"></i>Chat
                                        @if($unread > 0)
                                            <span class="unread-badge">{{ $unread }}</span>
                                        @endif
                                    </a>
                                @endif

                            </div>
                        </td>
                    </tr>
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