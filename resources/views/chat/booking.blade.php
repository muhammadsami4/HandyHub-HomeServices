@include('layouts.admin.head')

<style>
/* ═══════════════════════════════════════════
   CHAT PAGE — FULL SCREEN LAYOUT
═══════════════════════════════════════════ */

/* Override admin layout padding for chat */
.content { padding: 0 !important; height: calc(100vh - 70px); overflow: hidden; }
.main-wrap { overflow: hidden; }

/* ── CHAT WRAPPER ── */
.chat-wrapper {
    display: flex;
    flex-direction: column;
    height: 100%;
    background: #f0f2f5;
}

/* ── HEADER ── */
.chat-top {
    background: #fff;
    padding: 14px 24px;
    display: flex;
    align-items: center;
    gap: 14px;
    border-bottom: 1px solid #e5e7eb;
    box-shadow: 0 2px 10px rgba(0,0,0,.06);
    flex-shrink: 0;
    z-index: 10;
}

.chat-avatar {
    width: 46px; height: 46px;
    border-radius: 50%;
    background: linear-gradient(135deg, #4f46e5, #7c3aed);
    color: #fff;
    font-size: 18px;
    font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    text-transform: uppercase;
}

.chat-user-info { flex: 1; }
.chat-user-info .name {
    font-size: 16px;
    font-weight: 700;
    color: #111827;
    line-height: 1.2;
}
.chat-user-info .sub {
    font-size: 12.5px;
    color: #6b7280;
    display: flex;
    align-items: center;
    gap: 6px;
    margin-top: 2px;
}

.live-dot {
    width: 8px; height: 8px;
    border-radius: 50%;
    background: #22c55e;
    box-shadow: 0 0 0 3px rgba(34,197,94,.2);
    animation: pulse 2s infinite;
    transition: all .3s;
    flex-shrink: 0;
}
.live-dot.offline    { background: #9ca3af; box-shadow: none; animation: none; }
.live-dot.connecting { background: #f59e0b; box-shadow: 0 0 0 3px rgba(245,158,11,.2); }
@keyframes pulse { 0%,100%{opacity:1} 50%{opacity:.5} }

.chat-top .badge-req {
    background: #ede9fe;
    color: #6d28d9;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.btn-back {
    width: 38px; height: 38px;
    border-radius: 50%;
    background: #f3f4f6;
    border: none;
    display: flex; align-items: center; justify-content: center;
    color: #374151;
    text-decoration: none;
    font-size: 16px;
    transition: background .2s;
    flex-shrink: 0;
}
.btn-back:hover { background: #e5e7eb; color: #111827; }

/* ── MESSAGES AREA ── */
.chat-messages {
    flex: 1;
    overflow-y: auto;
    padding: 24px 20px;
    scroll-behavior: smooth;
    display: flex;
    flex-direction: column;
    gap: 6px;
}

/* Scrollbar styling */
.chat-messages::-webkit-scrollbar { width: 5px; }
.chat-messages::-webkit-scrollbar-track { background: transparent; }
.chat-messages::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 10px; }

/* ── DATE DIVIDER ── */
.date-divider {
    text-align: center;
    margin: 10px 0;
}
.date-divider span {
    background: #e5e7eb;
    color: #6b7280;
    font-size: 11.5px;
    padding: 4px 14px;
    border-radius: 20px;
    font-weight: 500;
}

/* ── SECURE NOTICE ── */
.secure-notice {
    text-align: center;
    margin-bottom: 16px;
}
.secure-notice span {
    background: #fef9c3;
    color: #854d0e;
    font-size: 12px;
    padding: 6px 16px;
    border-radius: 20px;
    font-weight: 500;
    border: 1px solid #fde68a;
}

/* ── EMPTY STATE ── */
.empty-state {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #9ca3af;
    gap: 10px;
    padding-bottom: 40px;
}
.empty-state .icon {
    width: 72px; height: 72px;
    background: #f3f4f6;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 30px;
}
.empty-state p { font-size: 14px; margin: 0; }

/* ── MESSAGE ROW ── */
.msg-row {
    display: flex;
    align-items: flex-end;
    gap: 8px;
    max-width: 72%;
    animation: fadeIn .25s ease;
}
@keyframes fadeIn { from{opacity:0;transform:translateY(8px)} to{opacity:1;transform:translateY(0)} }

.msg-row.mine {
    flex-direction: row-reverse;
    align-self: flex-end;
}
.msg-row.other {
    align-self: flex-start;
}

.msg-av {
    width: 32px; height: 32px;
    border-radius: 50%;
    background: linear-gradient(135deg, #4f46e5, #7c3aed);
    color: #fff;
    font-size: 13px;
    font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    text-transform: uppercase;
    margin-bottom: 2px;
}
.msg-av.mine-av {
    background: linear-gradient(135deg, #059669, #10b981);
}

.msg-content { display: flex; flex-direction: column; gap: 3px; }
.msg-row.mine .msg-content { align-items: flex-end; }

.bubble {
    padding: 10px 15px;
    border-radius: 18px;
    font-size: 14px;
    line-height: 1.55;
    max-width: 100%;
    word-break: break-word;
    position: relative;
}

/* Other person's bubble */
.bubble-other {
    background: #fff;
    color: #1f2937;
    border-bottom-left-radius: 4px;
    box-shadow: 0 1px 3px rgba(0,0,0,.08);
}

/* My bubble */
.bubble-mine {
    background: linear-gradient(135deg, #4f46e5, #6d28d9);
    color: #fff;
    border-bottom-right-radius: 4px;
    box-shadow: 0 2px 8px rgba(79,70,229,.3);
}

.msg-meta {
    font-size: 11px;
    color: #9ca3af;
    display: flex;
    align-items: center;
    gap: 4px;
    padding: 0 4px;
}
.msg-row.mine .msg-meta { color: #9ca3af; }
.tick { font-size: 12px; color: #60a5fa; }

/* ── TYPING INDICATOR ── */
.typing-row {
    display: flex;
    align-items: flex-end;
    gap: 8px;
    align-self: flex-start;
}
.typing-bubble {
    background: #fff;
    border-radius: 18px;
    border-bottom-left-radius: 4px;
    padding: 12px 16px;
    box-shadow: 0 1px 3px rgba(0,0,0,.08);
    display: flex; gap: 5px; align-items: center;
}
.typing-dot {
    width: 7px; height: 7px;
    border-radius: 50%;
    background: #9ca3af;
    animation: bounce 1.3s infinite;
}
.typing-dot:nth-child(2) { animation-delay: .15s; }
.typing-dot:nth-child(3) { animation-delay: .3s; }
@keyframes bounce {
    0%,60%,100%{transform:translateY(0)}
    30%{transform:translateY(-6px)}
}

/* ── INPUT AREA ── */
.chat-input-area {
    background: #fff;
    border-top: 1px solid #e5e7eb;
    padding: 14px 20px;
    flex-shrink: 0;
}
.input-row {
    display: flex;
    align-items: flex-end;
    gap: 12px;
    background: #f3f4f6;
    border-radius: 28px;
    padding: 8px 8px 8px 18px;
    border: 2px solid transparent;
    transition: border-color .2s, box-shadow .2s;
}
.input-row:focus-within {
    border-color: #4f46e5;
    box-shadow: 0 0 0 3px rgba(79,70,229,.1);
    background: #fff;
}

#msgInput {
    flex: 1;
    border: none;
    background: transparent;
    outline: none;
    resize: none;
    font-size: 14.5px;
    color: #1f2937;
    max-height: 120px;
    line-height: 1.5;
    padding: 4px 0;
    font-family: inherit;
}
#msgInput::placeholder { color: #9ca3af; }

.btn-send {
    width: 44px; height: 44px;
    border-radius: 50%;
    background: linear-gradient(135deg, #4f46e5, #7c3aed);
    border: none;
    color: #fff;
    font-size: 17px;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer;
    flex-shrink: 0;
    transition: transform .2s, box-shadow .2s, opacity .2s;
    box-shadow: 0 3px 10px rgba(79,70,229,.35);
}
.btn-send:hover:not(:disabled) {
    transform: scale(1.08);
    box-shadow: 0 5px 16px rgba(79,70,229,.45);
}
.btn-send:disabled { opacity: .45; transform: none; box-shadow: none; }

.input-hint {
    text-align: center;
    font-size: 11.5px;
    color: #9ca3af;
    margin-top: 8px;
}
.input-hint kbd {
    background: #e5e7eb;
    padding: 1px 5px;
    border-radius: 4px;
    font-size: 10.5px;
}
</style>

<body>
@include('layouts.admin.sidebar')

<div class="main-wrap" id="mainWrap">
@include('layouts.admin.header')

<main class="content">
<div class="chat-wrapper">

    {{-- ─── HEADER ─── --}}
    <div class="chat-top">
        <a href="javascript:history.back()" class="btn-back">
            <i class="bi bi-arrow-left"></i>
        </a>

        <div class="chat-avatar">
            {{ strtoupper(substr($otherUser->name, 0, 2)) }}
        </div>

        <div class="chat-user-info">
            <div class="name">{{ $otherUser->name }}</div>
            <div class="sub">
                <span class="live-dot offline" id="connDot"></span>
                <span id="connLabel">Connecting…</span>
            </div>
        </div>

        <span class="badge-req">
            <i class="bi bi-hash"></i>Request {{ $serviceReq->id }}
        </span>
    </div>

    {{-- ─── MESSAGES ─── --}}
    <div class="chat-messages" id="chatMessages">

        <div class="secure-notice">
            <span>🔒 Only You And {{ $otherUser->name }} Can View This Chat </span>
        </div>

        <div class="date-divider">
            <span>{{ now()->format('d M Y') }}</span>
        </div>

        @if($messages->isEmpty())
            <div class="empty-state">
                <div class="icon"></div>
                <p><strong>NO MESSAGE YET</strong></p>
                <p></p>
            </div>
        @else
            @foreach($messages as $msg)
                @php $isMine = $msg->sender_id === auth()->id(); @endphp
                <div class="msg-row {{ $isMine ? 'mine' : 'other' }}" data-id="{{ $msg->id }}">
                    <div class="msg-av {{ $isMine ? 'mine-av' : '' }}">
                        {{ strtoupper(substr($msg->sender->name, 0, 2)) }}
                    </div>
                    <div class="msg-content">
                        <div class="bubble {{ $isMine ? 'bubble-mine' : 'bubble-other' }}">
                            {{ $msg->message }}
                        </div>
                        <div class="msg-meta">
                            {{ $msg->created_at->format('h:i A') }}
                            @if($isMine)
                                <span class="tick">✓✓</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        {{-- Typing indicator (hidden) --}}
        <div class="typing-row d-none" id="typingRow">
            <div class="msg-av">{{ strtoupper(substr($otherUser->name, 0, 2)) }}</div>
            <div class="typing-bubble">
                <div class="typing-dot"></div>
                <div class="typing-dot"></div>
                <div class="typing-dot"></div>
            </div>
        </div>

    </div>

    {{-- ─── INPUT ─── --}}
    <div class="chat-input-area">
        <div class="input-row">
            <textarea
                id="msgInput"
                rows="1"
                placeholder="Message likhein…"
            ></textarea>
            <button class="btn-send" id="sendBtn" disabled title="Bhejein">
                <i class="bi bi-send-fill"></i>
            </button>
        </div>
        <div class="input-hint">
            <kbd>Enter</kbd> se bhejein &nbsp;·&nbsp; <kbd>Shift+Enter</kbd> se naya line
        </div>
    </div>

</div>
</main>
</div>

{{-- Reverb CDN --}}
<script src="https://cdn.jsdelivr.net/npm/pusher-js@8/dist/web/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/laravel-echo@1/dist/echo.iife.js"></script>

<script>
const REQUEST_ID    = {{ $serviceReq->id }};
const MY_ID         = {{ auth()->id() }};
const MY_NAME       = "{{ auth()->user()->name }}";
const OTHER_NAME    = "{{ $otherUser->name }}";
const OTHER_INITIALS = "{{ strtoupper(substr($otherUser->name, 0, 2)) }}";
const MY_INITIALS    = "{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}";
const SEND_URL      = "{{ route('chat.booking.send', $serviceReq->id) }}";
const POLL_URL      = "{{ route('chat.booking.poll', $serviceReq->id) }}";


const CSRF = '{{ csrf_token() }}';
const REVERB_KEY    = "{{ config('broadcasting.connections.reverb.key') }}";
const REVERB_HOST   = "{{ config('broadcasting.connections.reverb.options.host') }}";
const REVERB_PORT   = {{ config('broadcasting.connections.reverb.options.port') }};
const REVERB_SCHEME = "{{ config('broadcasting.connections.reverb.options.scheme') }}";

let lastMsgId = {{ $messages->last()?->id ?? 0 }};
const rendered = new Set(
    [...document.querySelectorAll('.msg-row[data-id]')].map(el => +el.dataset.id)
);

const msgInput  = document.getElementById('msgInput');
const sendBtn   = document.getElementById('sendBtn');
const msgArea   = document.getElementById('chatMessages');
const connDot   = document.getElementById('connDot');
const connLabel = document.getElementById('connLabel');

// Enable send button when input has text
msgInput.addEventListener('input', () => {
    msgInput.style.height = 'auto';
    msgInput.style.height = Math.min(msgInput.scrollHeight, 120) + 'px';
    sendBtn.disabled = !msgInput.value.trim();
});

msgInput.addEventListener('keydown', e => {
    if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        if (!sendBtn.disabled) sendMessage();
    }
});
sendBtn.addEventListener('click', sendMessage);

function scrollBottom(smooth = true) {
    msgArea.scrollTo({ top: msgArea.scrollHeight, behavior: smooth ? 'smooth' : 'instant' });
}

// Remove empty state when first message appears
function removeEmptyState() {
    const empty = msgArea.querySelector('.empty-state');
    if (empty) empty.remove();
}

function appendBubble({ id, message, isMine, time, animate = true }) {
    if (id && rendered.has(id)) return;
    if (id) { rendered.add(id); if (id > lastMsgId) lastMsgId = id; }

    removeEmptyState();

    const row = document.createElement('div');
    row.className = `msg-row ${isMine ? 'mine' : 'other'}`;
    if (id) row.dataset.id = id;
    if (!animate) row.style.animation = 'none';

    const initials = isMine ? MY_INITIALS : OTHER_INITIALS;
    const avClass  = isMine ? 'mine-av' : '';
    const bubClass = isMine ? 'bubble-mine' : 'bubble-other';
    const tick     = isMine ? `<span class="tick">✓✓</span>` : '';

    row.innerHTML = `
        <div class="msg-av ${avClass}">${initials}</div>
        <div class="msg-content">
            <div class="bubble ${bubClass}">${escHtml(message)}</div>
            <div class="msg-meta">${time} ${tick}</div>
        </div>`;

    // Insert before typing indicator
    const typing = document.getElementById('typingRow');
    msgArea.insertBefore(row, typing);
    scrollBottom();
}

function escHtml(s) {
    return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;')
            .replace(/"/g,'&quot;').replace(/\n/g,'<br>');
}

async function sendMessage() {
    const text = msgInput.value.trim();
    if (!text) return;

    msgInput.value = '';
    msgInput.style.height = 'auto';
    sendBtn.disabled = true;

    try {
        const res  = await fetch(SEND_URL, {
            method:  'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body:    JSON.stringify({ message: text }),
        });

        if (!res.ok) { const err = await res.text(); console.error('Server error:', err); throw new Error(err); }
        const data = await res.json();

        // Agar WebSocket nahi chal raha to manually show karo
        if (connDot.classList.contains('offline')) {
            appendBubble({
                id:     data.message.id,
                message: data.message.message,
                isMine: true,
                time:   data.message.time,
            });
        }
    } catch {
        alert('Message send nahi ho saka. Internet check karein.');
        msgInput.value = text;
    } finally {
        msgInput.focus();
    }
}

async function pollMessages() {
    try {
        const res  = await fetch(`${POLL_URL}?since=${lastMsgId}`);
        const data = await res.json();
        data.messages.forEach(m => appendBubble({
            id:      m.id,
            message: m.message,
            isMine:  m.sender_id === MY_ID,
            time:    m.time,
        }));
    } catch(e) { console.error(e); }
}

// Connection status
function setStatus(state) {
    const states = {
        connected:   { cls: '',           label: 'Online' },
        connecting:  { cls: 'connecting', label: 'Connecting…' },
        unavailable: { cls: 'connecting', label: 'Reconnecting…' },
    };
    const s = states[state] || { cls: 'offline', label: 'Offline' };
    connDot.className = 'live-dot ' + s.cls;
    connLabel.textContent = s.label;
}

// Reverb / Echo
try {
    window.Pusher = Pusher;
    window.Echo = new Echo({
        broadcaster:       'reverb',
        key:               REVERB_KEY,
        wsHost:            REVERB_HOST,
        wsPort:            REVERB_PORT,
        wssPort:           REVERB_PORT,
        forceTLS:          REVERB_SCHEME === 'https',
        enabledTransports: ['ws', 'wss'],
        auth:              { headers: { 'X-CSRF-TOKEN': CSRF } },
    });

    window.Echo.private(`chat.${REQUEST_ID}`)
        .listen('.message.sent', e => {
            appendBubble({
                id:      e.id,
                message: e.message,
                isMine:  e.sender_id === MY_ID,
                time:    e.time,
            });
        });

    window.Echo.connector.pusher.connection.bind('state_change', s => setStatus(s.current));
    window.Echo.connector.pusher.connection.bind('connected', () => setStatus('connected'));

} catch(err) {
    console.error('Reverb init failed:', err);
    setStatus('failed');
}

// Initial scroll
scrollBottom(false);
</script>

@include('layouts.admin.script')
</body>