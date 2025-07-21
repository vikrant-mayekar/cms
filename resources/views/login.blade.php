<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Modern CMS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6a5af9;
            --secondary-color: #f7f7f7;
            --background-color: #f0f2f5;
            --text-color: #333;
            --glass-bg: rgba(255, 255, 255, 0.2);
            --shadow-color: rgba(0, 0, 0, 0.1);
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden;
        }
        .login-container {
            background: var(--glass-bg);
            padding: 3rem;
            border-radius: 20px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px 0 var(--shadow-color);
            text-align: center;
            width: 100%;
            max-width: 420px;
            animation: fadeIn 0.8s ease-out forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        h2 {
            margin-bottom: 2rem;
            color: var(--text-color);
            font-weight: 600;
            font-size: 2.5rem;
        }
        .form-group {
            position: relative;
            margin-bottom: 2rem;
        }
        .form-group input {
            width: 100%;
            padding: 10px 0;
            background: transparent;
            border: none;
            border-bottom: 2px solid rgba(0,0,0,0.2);
            outline: none;
            font-size: 1rem;
            color: var(--text-color);
            transition: border-color 0.3s;
        }
        .form-group label {
            position: absolute;
            top: 10px;
            left: 0;
            font-size: 1rem;
            color: #666;
            pointer-events: none;
            transition: all 0.3s ease;
        }
        .form-group input:focus ~ label,
        .form-group input:valid ~ label {
            top: -20px;
            left: 0;
            font-size: 0.85rem;
            color: var(--primary-color);
        }
        .form-group input:focus {
            border-bottom-color: var(--primary-color);
        }
        button {
            width: 100%;
            padding: 1rem;
            border: none;
            border-radius: 50px;
            background: var(--primary-color);
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }
        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(106, 90, 249, 0.4);
        }
        .error {
            color: #d93025;
            margin-top: 1rem;
            font-weight: 400;
            height: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Welcome Back</h2>
        <form id="loginForm">
            <div class="form-group">
                <input type="email" id="email" name="email" required autocomplete="off" value="admin@example.com">
                <label for="email">Email Address</label>
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" required value="password">
                <label for="password">Password</label>
            </div>
            <button type="submit">Log In</button>
        </form>
        <div class="error" id="error"></div>
    </div>
    <script>
        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const errorDiv = document.getElementById('error');
            const submitButton = this.querySelector('button');
            errorDiv.textContent = '';
            submitButton.disabled = true;
            submitButton.textContent = 'Logging In...';
            
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            try {
                const res = await fetch('/api/auth/login', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email, password })
                });
                const data = await res.json();
                
                if (res.ok && data.access_token) {
                    localStorage.setItem('jwt_token', data.access_token);
                    window.location.href = '/dashboard';
                } else {
                    errorDiv.textContent = data.error || 'Login failed. Please try again.';
                }
            } catch (err) {
                errorDiv.textContent = 'A network error occurred. Please try again.';
            } finally {
                submitButton.disabled = false;
                submitButton.textContent = 'Log In';
            }
        });
    </script>
</body>
</html> 