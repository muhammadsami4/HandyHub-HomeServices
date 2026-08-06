 // ===== SIDEBAR TOGGLE (Desktop) =====
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainWrap = document.getElementById('mainWrap');
            const icon = document.querySelector('#sidebarToggle i');

            sidebar.classList.toggle('collapsed');
            mainWrap.classList.toggle('expanded');

            // Rotate icon
            if (sidebar.classList.contains('collapsed')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-chevron-right');
            } else {
                icon.classList.remove('fa-chevron-right');
                icon.classList.add('fa-bars');
            }

            // Resize charts after transition
            setTimeout(() => {
                revenueChart.resize();
                serviceChart.resize();
            }, 350);
        }

        // ===== MOBILE SIDEBAR =====
        function openMobileSidebar() {
            document.getElementById('sidebar').classList.add('show');
            document.getElementById('overlay').classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeMobileSidebar() {
            document.getElementById('sidebar').classList.remove('show');
            document.getElementById('overlay').classList.remove('show');
            document.body.style.overflow = '';
        }

        // Close mobile sidebar on window resize to desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth > 991) {
                closeMobileSidebar();
            }
        });

        // ===== ANIMATED COUNTERS =====
        const counters = document.querySelectorAll('.counter');
        const animateCounters = () => {
            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const duration = 1500;
                const increment = target / (duration / 16);
                let current = 0;

                const update = () => {
                    current += increment;
                    if (current < target) {
                        counter.innerText = Math.floor(current).toLocaleString();
                        requestAnimationFrame(update);
                    } else {
                        counter.innerText = target.toLocaleString();
                    }
                };
                update();
            });
        };
        setTimeout(animateCounters, 400);

        // ===== REVENUE CHART =====
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Revenue',
                    data: [28000, 32000, 30000, 35000, 42000, 38000, 45000, 48000, 52000, 49000, 55000, 60000],
                    borderColor: '#ff6b00',
                    backgroundColor: 'rgba(255, 107, 0, 0.08)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#ff6b00',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 3,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f1f4f9', drawBorder: false },
                        ticks: {
                            callback: v => '$' + v.toLocaleString(),
                            font: { size: 11 },
                            color: '#94a3b8'
                        }
                    },
                    x: {
                        grid: { display: false, drawBorder: false },
                        ticks: {
                            font: { size: 11 },
                            color: '#94a3b8'
                        }
                    }
                }
            }
        });

        // ===== SERVICE CHART =====
        const serviceCtx = document.getElementById('serviceChart').getContext('2d');
        const serviceChart = new Chart(serviceCtx, {
            type: 'doughnut',
            data: {
                labels: ['Plumbing', 'Electrical', 'Cleaning', 'Carpentry', 'Painting', 'AC'],
                datasets: [{
                    data: [25, 20, 18, 15, 12, 10],
                    backgroundColor: ['#ff6b00', '#1a1a2e', '#10b981', '#3b82f6', '#f59e0b', '#8b5cf6'],
                    borderWidth: 0,
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '72%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 15,
                            font: { size: 11 },
                            color: '#64748b'
                        }
                    }
                }
            }
        });