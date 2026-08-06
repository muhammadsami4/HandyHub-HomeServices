<style>
    /* =========================
   PREMIUM ALERT SYSTEM
========================= */

.custom-alert{
    position: fixed;
    top: 30px;
    right: 30px;
    width: 380px;
    min-height: 90px;
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(14px);
    border-radius: 20px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.15);
    display: flex;
    align-items: center;
    padding: 18px 20px;
    overflow: hidden;
    z-index: 9999;

    transform: translateX(450px);
    opacity: 0;
    transition: all 0.5s ease;
}

/* SHOW ALERT */
.custom-alert.show-alert{
    transform: translateX(0);
    opacity: 1;
}

/* SUCCESS */
.success-alert{
    border-left: 6px solid #10b981;
}

/* ERROR */
.error-alert{
    border-left: 6px solid #ef4444;
}

/* ICON */
.alert-icon{
    width: 55px;
    height: 55px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 16px;
    flex-shrink: 0;
}

.success-alert .alert-icon{
    background: rgba(16,185,129,0.12);
    color: #10b981;
}

.error-alert .alert-icon{
    background: rgba(239,68,68,0.12);
    color: #ef4444;
}

.alert-icon i{
    font-size: 26px;
}

/* CONTENT */
.alert-content{
    flex: 1;
}

.alert-content h4{
    font-size: 16px;
    margin-bottom: 4px;
    font-weight: 700;
    color: #111827;
}

.alert-content p{
    font-size: 14px;
    color: #6b7280;
    margin: 0;
}

/* CLOSE BUTTON */
.close-alert{
    background: none;
    border: none;
    color: #9ca3af;
    cursor: pointer;
    font-size: 16px;
    transition: 0.3s;
}

.close-alert:hover{
    color: #111827;
    transform: rotate(90deg);
}

/* PROGRESS BAR */
.alert-progress{
    position: absolute;
    bottom: 0;
    left: 0;
    height: 5px;
    width: 100%;
    animation: progressBar 5s linear forwards;
}

.success-alert .alert-progress{
    background: linear-gradient(to right,#10b981,#34d399);
}

.error-alert .alert-progress{
    background: linear-gradient(to right,#ef4444,#f87171);
}

/* ANIMATION */
@keyframes progressBar{
    0%{
        width: 100%;
    }
    100%{
        width: 0%;
    }
}

/* MOBILE */
@media(max-width:768px){

    .custom-alert{
        width: calc(100% - 40px);
        right: 20px;
        top: 20px;
    }
}
</style>

<!-- ALERT MESSAGE -->
@if(session('success'))
<div class="custom-alert success-alert show-alert">

    <div class="alert-icon">
        <i class="fas fa-check-circle"></i>
    </div>

    <div class="alert-content">
        <h4>Success</h4>
        <p>{{ session('success') }}</p>
    </div>

    <button class="close-alert">
        <i class="fas fa-times"></i>
    </button>

    <div class="alert-progress"></div>

</div>
@endif


@if(session('error'))
<div class="custom-alert error-alert show-alert">

    <div class="alert-icon">
        <i class="fas fa-times-circle"></i>
    </div>

    <div class="alert-content">
        <h4>Error</h4>
        <p>{{ session('error') }}</p>
    </div>

    <button class="close-alert">
        <i class="fas fa-times"></i>
    </button>

    <div class="alert-progress"></div>

</div>
@endif

<script>

    // AUTO HIDE ALERT
    const alerts = document.querySelectorAll('.custom-alert');

    alerts.forEach(alert => {

        // AUTO REMOVE
        setTimeout(() => {
            alert.classList.remove('show-alert');

            setTimeout(() => {
                alert.remove();
            }, 500);

        }, 5000);

        // CLOSE BUTTON
        const closeBtn = alert.querySelector('.close-alert');

        closeBtn.addEventListener('click', () => {

            alert.classList.remove('show-alert');

            setTimeout(() => {
                alert.remove();
            }, 500);

        });

    });

</script>