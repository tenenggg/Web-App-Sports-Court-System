<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Court Hub - Sports Court Booking</title>

        <!-- Google Analytics 4 -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-GEMCH948FX"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'G-GEMCH948FX');
        </script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- Styles -->
        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background: linear-gradient(135deg, #000000 0%, #1a1a1a 100%);
                min-height: 100vh;
                margin: 0;
                color: #fff;
            }
            
            .welcome-container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 2rem;
            }
            
            .nav-buttons {
                position: fixed;
                top: 2rem;
                right: 2rem;
                display: flex;
                gap: 1rem;
            }
            
            .nav-button {
                background: rgba(255, 255, 255, 0.1);
                color: #fff;
                padding: 0.75rem 1.5rem;
                border-radius: 50px;
                text-decoration: none;
                backdrop-filter: blur(10px);
                transition: all 0.3s ease;
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
            
            .nav-button:hover {
                background: rgba(255, 255, 255, 0.2);
                transform: translateY(-2px);
                color: #ff6b00;
            }
            
            .hero-section {
                text-align: center;
                padding: 8rem 2rem;
            }
            
            .hero-title {
                font-size: 3.5rem;
                font-weight: 700;
                margin-bottom: 1rem;
                animation: fadeInUp 1s ease;
            }
            
            .hero-subtitle {
                font-size: 1.5rem;
                opacity: 0.9;
                margin-bottom: 2rem;
                animation: fadeInUp 1s ease 0.2s;
            }
            
            .features-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 2rem;
                padding: 4rem 0;
            }
            
            .feature-card {
                background: rgba(255, 255, 255, 0.05);
                padding: 2rem;
                border-radius: 20px;
                backdrop-filter: blur(10px);
                border: 1px solid #ff6b00;
                transition: transform 0.3s ease;
            }
            
            .feature-card:hover {
                transform: translateY(-10px);
                background: rgba(255, 107, 0, 0.1);
            }
            
            .feature-icon {
                font-size: 2.5rem;
                margin-bottom: 1rem;
                color: #ff6b00;
            }
            
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
    </head>
    <body>
        <div class="welcome-container">
            @if (Route::has('login'))
                <div class="nav-buttons">
                    @auth
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('admin.home') }}" class="nav-button">
                                <i class="fas fa-home"></i> Admin Dashboard
                            </a>
                        @else
                            <a href="{{ route('user.home') }}" class="nav-button">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="nav-button">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-button">
                                <i class="fas fa-user-plus"></i> Register
                            </a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="hero-section">
                <h1 class="hero-title">Welcome to Court Hub</h1>
                <p class="hero-subtitle">Your Premier Sports Court Booking Platform</p>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <i class="fas fa-calendar-check feature-icon"></i>
                    <h3>Easy Booking</h3>
                    <p>Book your favorite courts with just a few clicks</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-clock feature-icon"></i>
                    <h3>24/7 Availability</h3>
                    <p>Book anytime, anywhere at your convenience</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-map-marker-alt feature-icon"></i>
                    <h3>Multiple Venues</h3>
                    <p>Choose from various locations near you</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-shield-alt feature-icon"></i>
                    <h3>Secure Payments</h3>
                    <p>Safe and secure payment processing</p>
                </div>
            </div>
        </div>
    </body>
</html>
