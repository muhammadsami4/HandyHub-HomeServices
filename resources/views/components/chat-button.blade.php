{{--
    ─── USAGE ───
    Seeker ya provider ki booking list mein, har booking card ke andar:
        <x-chat-button :booking="$booking" />
--}}

@props(['booking'])

@if($booking)
    @php
        $unread = \App\Models\ChatMessage::where('booking_id', $booking->id)
            ->where('receiver_id', auth()->id())
            ->whereNull('read_at')
            ->count();
    @endphp
    <a href="{{ route('chat.booking', $booking->id) }}"
       class="btn btn-sm btn-outline-secondary rounded-pill position-relative"
       title="Chat karein">
        <i class="bi bi-chat-dots me-1"></i>Chat
        @if($unread > 0)
            <span class="badge bg-danger rounded-pill ms-1" style="font-size:.65rem;">{{ $unread }}</span>
        @endif
    </a>
@endif
