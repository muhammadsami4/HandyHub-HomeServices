        // Navbar Scroll Effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Scroll Reveal Animation
        function reveal() {
            var reveals = document.querySelectorAll(".reveal");
            for (var i = 0; i < reveals.length; i++) {
                var windowHeight = window.innerHeight;
                var elementTop = reveals[i].getBoundingClientRect().top;
                var elementVisible = 150;
                if (elementTop < windowHeight - elementVisible) {
                    reveals[i].classList.add("active");
                }
            }
        }
        window.addEventListener("scroll", reveal);
        // Trigger once on load
        reveal();

        // Animated Number Counters
        const counters = document.querySelectorAll('.counter');
        let hasCounted = false;

        const startCounters = () => {
            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const increment = target / 100;
                
                const updateCounter = () => {
                    const c = +counter.innerText;
                    if(c < target) {
                        counter.innerText = Math.ceil(c + increment);
                        setTimeout(updateCounter, 20);
                    } else {
                        counter.innerText = target.toLocaleString();
                    }
                };
                updateCounter();
            });
        };

        // Trigger counters when stats section is in view
        const statsSection = document.querySelector('.stats-section');
        const observer = new IntersectionObserver((entries) => {
            if(entries[0].isIntersecting && !hasCounted) {
                startCounters();
                hasCounted = true;
            }
        }, { threshold: 0.5 });

        observer.observe(statsSection);