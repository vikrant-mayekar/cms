<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Modern CMS')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-color: #6a5af9;
            --secondary-color: #ffffff;
            --background-color: #f0f2f5;
            --text-color: #333;
            --sidebar-bg: #1e1e2d;
            --sidebar-text: #a1a1b5;
            --sidebar-active: #ffffff;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            display: flex;
            color: var(--text-color);
        }
        .main-content {
            margin-left: 250px;
            padding: 2rem;
            width: calc(100% - 250px);
        }
    </style>
    @stack('styles')
</head>
<body>
    @include('components.sidebar')

    <main class="main-content">
        @yield('content')
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const token = localStorage.getItem('jwt_token');
            if (!token) {
                window.location.href = '/login';
                return;
            }

            try {
                const res = await fetch('/api/auth/me', {
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });

                if (res.ok) {
                    const user = await res.json();
                    if (user.role === 'admin') {
                        const adminOnlyLinks = document.querySelectorAll('.admin-only');
                        adminOnlyLinks.forEach(link => link.style.display = 'flex');
                    }
                    if (document.getElementById('welcome-message')) {
                         document.getElementById('welcome-message').textContent = `Welcome, ${user.name}!`;
                    }
                } else {
                    localStorage.removeItem('jwt_token');
                    window.location.href = '/login';
                }
            } catch (error) {
                console.error('Failed to fetch user data:', error);
                localStorage.removeItem('jwt_token');
                window.location.href = '/login';
            }
        });
        
        document.getElementById('logoutButton').addEventListener('click', () => {
            localStorage.removeItem('jwt_token');
            window.location.href = '/login';
        });
    </script>
    @stack('scripts')
</body>
</html> 