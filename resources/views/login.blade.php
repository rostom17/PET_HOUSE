<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PETHOUSE</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .page-container {
            display: flex;
            width: 900px;
            max-width: 90%;
            margin: 40px auto;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(255,111,97,0.15), 0 3px 10px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .login-container {
            width: 60%;
            padding: 48px 50px;
        }
        .login-header {
            margin-bottom: 32px;
        }
        .login-header h2 {
            color: #ff6f61;
            margin: 0 0 15px 0;
            font-size: 2.2rem;
            letter-spacing: 1px;
            font-weight: 700;
        }
        .login-header p {
            color: #666;
            font-size: 1.1rem;
            margin: 0 0 12px 0;
            line-height: 1.5;
        }
        .logo {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #ff6f61 70%, #ff9472 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 15px rgba(255,111,97,0.2);
            margin-bottom: 20px;
        }
        .role-selection {
            display: flex;
            gap: 15px;
            margin-bottom: 24px;
        }
        .role-selection input[type="radio"] {
            display: none;
        }
        .role-label {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 14px 16px;
            border: 2px solid #eee;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            font-size: 1rem;
            color: #666;
            background: #fafafa;
        }
        .role-label:hover {
            border-color: #ff6f61;
            background: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .role-selection input[type="radio"]:checked + .role-label {
            border-color: #ff6f61;
            background: #ff6f61;
            color: white;
            box-shadow: 0 4px 12px rgba(255,111,97,0.2);
        }
        .role-label i {
            font-size: 1.2rem;
        }
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        .form-group label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: #444;
            font-size: 1.05rem;
        }
        .login-form input {
            width: 100%;
            padding: 14px 45px 14px 16px;
            border-radius: 10px;
            border: 1.5px solid #eee;
            font-size: 1rem;
            background: #fafafa;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }
        .login-form input:focus {
            border: 1.5px solid #ff6f61;
            outline: none;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(255,111,97,0.1);
        }
        .input-icon {
            position: absolute;
            right: 16px;
            top: 44px;
            color: #aaa;
            font-size: 1.1rem;
            line-height: 0;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
        }
        .btn {
            display: inline-block;
            width: 100%;
            padding: 14px 0;
            border-radius: 30px;
            font-size: 1.1rem;
            font-weight: 700;
            text-decoration: none;
            background: linear-gradient(90deg, #ff6f61 60%, #ff9472 100%);
            color: #fff;
            border: none;
            box-shadow: 0 4px 15px rgba(255,111,97,0.2);
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn:hover, .btn:focus {
            background: linear-gradient(90deg, #e65c50 60%, #ff9472 100%);
            box-shadow: 0 7px 25px rgba(255,111,97,0.25);
            transform: translateY(-2px);
            letter-spacing: 1.5px;
        }
        .signup-link {
            display: block;
            text-align: center;
            margin-top: 25px;
            color: #ff6f61;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: color 0.2s;
        }
        .signup-link:hover {
            color: #e65c50;
            text-decoration: underline;
        }
        
        /* Side container styles */
        .side-container {
            width: 40%;
            background: linear-gradient(135deg, #ff6f61 0%, #ff9472 100%);
            color: white;
            padding: 48px 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .side-logo-container {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }
        .map-container {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 25px;
        }
        .side-logo {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            padding: 2px;
            box-sizing: border-box;
        }
        .brand-name {
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .contact-info {
            margin-top: 0;
        }
        .contact-info h3 {
            font-size: 1.4rem;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            font-size: 1rem;
        }
        .contact-item i {
            width: 30px;
            font-size: 1.2rem;
            margin-right: 10px;
        }
        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }
        .social-icons a {
            color: white;
            background: rgba(255, 255, 255, 0.2);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        .social-icons a:hover {
            background: rgba(255, 255, 255, 0.4);
            transform: translateY(-3px);
        }
        .view-map-link {
            margin: -5px 0 15px 40px;
        }
        .view-map-link a {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .view-map-link a:hover {
            color: #fff;
            text-decoration: underline;
        }
        
        @media (max-width: 768px) {
            .page-container {
                flex-direction: column;
                width: 95%;
            }
            .login-container, .side-container {
                width: 100%;
                padding: 30px;
            }
            .side-container {
                order: -1;
                padding-bottom: 40px;
            }
        }
    </style>
</head>
<body>
    <div class="page-container">
        <div class="login-container">
            <div class="login-header">
            @if($errors->any())
                <div style="color: #fff; background: #ff6f61; padding: 12px 20px; border-radius: 8px; margin-bottom: 18px; text-align: center; font-weight: bold;">
                    {{ $errors->first() }}
                </div>
            @endif
            @if(session('success'))
                <div style="color: #fff; background: #28a745; padding: 12px 20px; border-radius: 8px; margin-bottom: 18px; text-align: center; font-weight: bold;">
                    {{ session('success') }}
                </div>
            @endif
                <h2>Welcome Back</h2>
                <p>Please sign in to access your PETHOUSE account</p>
            </div>
            <form class="login-form" method="POST" action="{{ route('login.submit') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required placeholder="you@email.com">
                    <span class="input-icon"><i class="fas fa-envelope"></i></span>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required placeholder="Your password">
                    <span class="input-icon"><i class="fas fa-lock"></i></span>
                </div>
                <button type="submit" class="btn">Sign In</button>
            </form>
            <div style="margin: 30px 0 20px 0; text-align: center; color: #aaa; font-size: 1rem; position: relative;">
                <hr style="border: none; height: 1px; background-color: #eee; margin: 0;">
                <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: #fff; padding: 0 15px;">or continue with</span>
            </div>
        <div style="display: flex; justify-content: center; gap: 16px; margin-bottom: 20px;">
            <a href="{{ route('google.login') }}" style="display:flex;align-items:center;justify-content:center;width:200px;height:50px;background:#fff;color:#444;border:1.5px solid #eee;border-radius:12px;text-decoration:none;transition:all 0.3s ease;box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/google/google-original.svg" alt="Google" style="width:24px;height:24px;margin-right:10px;">
                <span style="font-weight:600;">Continue with Google</span>
            </a>
        </div>
        <a href="{{ url('/signup') }}" class="signup-link">Don't have an account? Sign Up</a>
        </div>
        
        <div class="side-container">
            <div class="side-logo-container">
                <div class="side-logo">
                    <svg width="40" height="40" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: block; margin: auto;">
                        <ellipse cx="22" cy="30" rx="11" ry="8" fill="#fff"/>
                        <ellipse cx="12" cy="18" rx="4" ry="5" fill="#fff"/>
                        <ellipse cx="32" cy="18" rx="4" ry="5" fill="#fff"/>
                        <ellipse cx="17" cy="11" rx="2.2" ry="2.8" fill="#fff"/>
                        <ellipse cx="27" cy="11" rx="2.2" ry="2.8" fill="#fff"/>
                    </svg>
                </div>
                <div class="brand-name">PETHOUSE</div>
            </div>
            
            <div class="contact-info">
                <h3>Contact Information</h3>
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Dhaka, Bangladesh</span>
                </div>
                <div class="contact-item">
                    <i class="fas fa-phone-alt"></i>
                    <span>+8801609192668</span>
                </div>
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <span>contact@pethouse.com</span>
                </div>
            </div>
            
            <div class="map-container">
                
            </div>
            <div class="view-map-link">
                
            </div>
            
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</body>
</html>
