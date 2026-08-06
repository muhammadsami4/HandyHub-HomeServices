     function setRole(btn, role) {
            document.querySelectorAll('.role-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            // Here you can store the role in a hidden input or session
            console.log("Selected Role:", role);
        }

        function togglePassword() {
            const pass = document.getElementById('password');
            const icon = event.target;
            if (pass.type === 'password') {
                pass.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                pass.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add login logic here
            alert('Login functionality would be implemented here.');
        });