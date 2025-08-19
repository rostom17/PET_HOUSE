@extends('layouts.app')

@section('title', 'Schedule Vaccination - PETSROLOGY')

@section('styles')
    <style>
        /* Override layout styles for full-width header */
        .main-content {
            padding: 0 !important;
            margin: 0 !important;
            min-height: calc(100vh - 70px) !important; /* Account for navbar height */
        }

        /* Remove any default margins on the content */
        body {
            margin: 0 !important;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            color: #333;
            line-height: 1.6;
            min-height: 100vh;
        }

        /* Enhanced Header - Full Width */
        .header {
            background: linear-gradient(135deg, #ff6f61 0%, #ff9472 100%);
            color: white;
            text-align: center;
            padding: 80px 20px 60px;
            box-shadow: 0 4px 20px rgba(255,111,97,0.2);
            position: relative;
            overflow: hidden;
            width: 100vw;
            margin-left: calc(-50vw + 50%);
            margin-top: 0;
            margin-bottom: 0;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="rgba(255,255,255,0.05)"><path d="M0,50 Q250,0 500,50 T1000,50 L1000,100 L0,100 Z"/></svg>') repeat-x;
            background-size: 1000px 100px;
            animation: wave 20s linear infinite;
        }

        @keyframes wave {
            0% { background-position-x: 0; }
            100% { background-position-x: 1000px; }
        }

        .header-icon-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 25px;
            position: relative;
            z-index: 1;
        }

        .header-icon {
            width: 90px;
            height: 90px;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 25px rgba(255,111,97,0.3);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255,255,255,0.2);
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .header-icon span {
            font-size: 3rem;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
        }

        .header h1 {
            font-size: 3rem;
            margin: 0 0 15px 0;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.1); 
            position: relative;
            z-index: 1;
        }

        .header p {
            font-size: 1.3rem;
            margin: 0;
            opacity: 0.95;
            font-weight: 500;
            position: relative;
            z-index: 1;
        }

        .back-btn {
            position: absolute;
            top: 25px;
            right: 25px;
            background: rgba(255,255,255,0.15);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 0.95rem;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .back-btn:hover {
            background: rgba(255,255,255,0.25);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
            color: white;
            text-decoration: none;
        }

        /* Page Container for content after header */
        .page-container {
            max-width: 1600px;
            margin: 0 auto;
            padding: 60px 40px;
        }

        /* Section Headers */
        .section-header {
            text-align: center;
            margin-bottom: 60px;
            position: relative;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .section-header::before {
            content: '';
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(135deg, #ff6f61, #ff9472);
            border-radius: 2px;
        }

        .section-header h2 {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #ff6f61;
            font-weight: 800;
            letter-spacing: 1.2px;
        }

        .section-subtitle {
            font-size: 1.3rem;
            color: #5a6c7d;
            font-weight: 500;
            line-height: 1.8;
        }

        /* Vaccination Packages Section */
        .packages-section {
            margin-bottom: 80px;
        }

        .packages-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
            max-width: 1500px;
            margin-left: auto;
            margin-right: auto;
        }

        .package-card {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(255,111,97,0.08), 0 2px 8px rgba(0,0,0,0.04);
            padding: 35px 30px 30px;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid rgba(255,111,97,0.05);
            position: relative;
            overflow: hidden;
        }

        .package-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 4px;
            background: linear-gradient(135deg, #ff6f61, #ff9472);
            transition: left 0.5s ease;
        }

        .package-card:hover::before {
            left: 0;
        }

        .package-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 20px 50px rgba(255,111,97,0.15), 0 8px 25px rgba(0,0,0,0.08);
            border-color: rgba(255,111,97,0.2);
        }

        .package-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #ff6f61 0%, #ff9472 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            font-size: 2rem;
            color: white;
            box-shadow: 0 8px 25px rgba(255,111,97,0.3);
            transition: all 0.3s ease;
        }

        .package-card:hover .package-icon {
            transform: scale(1.1);
            box-shadow: 0 12px 35px rgba(255,111,97,0.4);
        }

        .package-name {
            font-size: 1.8rem;
            margin: 0 0 10px 0;
            color: #2c3e50;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        .package-price {
            font-size: 2.2rem;
            color: #ff6f61;
            font-weight: 900;
            margin-bottom: 20px;
        }

        .package-features {
            list-style: none;
            padding: 0;
            margin: 0 0 30px 0;
        }

        .package-features li {
            padding: 8px 0;
            color: #5a6c7d;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .package-features li i {
            color: #27ae60;
            font-size: 0.9rem;
        }

        .package-btn {
            background: linear-gradient(135deg, #ff6f61 0%, #ff9472 100%);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(255,111,97,0.3);
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        .package-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #e65c50 0%, #ff6f61 100%);
            transition: left 0.3s ease;
            z-index: -1;
        }

        .package-btn:hover::before {
            left: 0;
        }

        .package-btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 25px rgba(255,111,97,0.4);
            color: white;
            text-decoration: none;
        }

        .popular-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Vaccination Experts Section */
        .experts-section {
            margin-bottom: 80px;
        }

        .experts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            max-width: 1500px;
            margin-left: auto;
            margin-right: auto;
        }

        .expert-card {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(255,111,97,0.08), 0 2px 8px rgba(0,0,0,0.04);
            padding: 35px 30px 30px;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid rgba(255,111,97,0.05);
            position: relative;
            overflow: hidden;
        }

        .expert-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 4px;
            background: linear-gradient(135deg, #ff6f61, #ff9472);
            transition: left 0.5s ease;
        }

        .expert-card:hover::before {
            left: 0;
        }

        .expert-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 20px 50px rgba(255,111,97,0.15), 0 8px 25px rgba(0,0,0,0.08);
            border-color: rgba(255,111,97,0.2);
        }

        .expert-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 0 auto 25px;
            background: linear-gradient(135deg, #ff6f61 0%, #ff9472 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 700;
            color: white;
            box-shadow: 0 8px 25px rgba(255,111,97,0.3);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border: 3px solid #fff;
            font-family: 'Nunito', sans-serif;
            letter-spacing: 1px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .expert-card:hover .expert-avatar {
            transform: scale(1.1);
            box-shadow: 0 12px 35px rgba(255,111,97,0.4);
        }

        .expert-name {
            font-size: 1.6rem;
            margin: 0 0 8px 0;
            color: #2c3e50;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        .expert-specialty {
            color: #ff6f61;
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .expert-experience {
            color: #5a6c7d;
            font-size: 0.9rem;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .expert-rating {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            margin-bottom: 15px;
        }

        .expert-stars {
            color: #ffc107;
            font-size: 1rem;
        }

        .expert-rating-text {
            color: #5a6c7d;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .expert-btn {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 700;
            font-size: 0.9rem;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(39,174,96,0.3);
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        .expert-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #229954 0%, #27ae60 100%);
            transition: left 0.3s ease;
            z-index: -1;
        }

        .expert-btn:hover::before {
            left: 0;
        }

        .expert-btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 25px rgba(39,174,96,0.4);
            color: white;
            text-decoration: none;
        }

        /* Info Section */
        .info-section {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 8px 30px rgba(255,111,97,0.08);
            margin-bottom: 80px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 35px;
            max-width: 1500px;
            margin-left: auto;
            margin-right: auto;
        }

        .info-item {
            text-align: center;
        }

        .info-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #ff6f61 0%, #ff9472 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 1.8rem;
            color: white;
            box-shadow: 0 8px 25px rgba(255,111,97,0.3);
        }

        .info-title {
            font-size: 1.4rem;
            color: #2c3e50;
            font-weight: 800;
            margin-bottom: 15px;
        }

        .info-description {
            color: #5a6c7d;
            line-height: 1.7;
            font-weight: 500;
        }


        /* Responsive Design */
        @media (max-width: 1200px) {
            .page-container {
                max-width: 1400px;
                padding: 50px 30px;
            }
            
            .packages-grid, .experts-grid, .info-grid {
                max-width: 1200px;
            }
        }
        
        @media (max-width: 900px) {
            .page-container {
                padding: 40px 20px;
            }
            
            .section-header h2 {
                font-size: 2.2rem;
            }
            
            .packages-grid, .experts-grid {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 25px;
                max-width: 100%;
            }
            
            .info-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 30px;
                max-width: 100%;
            }
        }
        
        @media (max-width: 600px) {
            .packages-grid, .experts-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
                gap: 25px;
            }
        }

        @media (max-width: 700px) {
            
            .header {
                padding: 40px 20px 30px;
            }
            
            .header h1 {
                font-size: 2rem;
            }
            
            .back-btn {
                top: 15px;
                right: 15px;
                padding: 6px 12px;
                font-size: 0.8rem;
            }
            
            .package-card, .expert-card {
                padding: 25px 20px 20px;
            }
            
            .info-section {
                padding: 30px 20px;
            }
        }

    </style>
@endsection

@section('content')
    <div class="header">
        <a href="{{ url('/vet-home') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i>
            Back to Services
        </a>
        <div class="header-icon-container">
            <div class="header-icon">
                <span>💉</span>
            </div>
        </div>
        <h1>Schedule Vaccination</h1>
        <p>Protect your pet with professional vaccination services</p>
    </div>

    <div class="page-container">
        <!-- Vaccination Packages Section -->
        <section class="packages-section">
            <div class="section-header">
                <h2>Vaccination Packages</h2>
                <p class="section-subtitle">Comprehensive vaccination plans tailored for your pet's needs</p>
            </div>

            <div class="packages-grid">
                <!-- Basic Package -->
                <div class="package-card">
                    <div class="package-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="package-name">Basic Protection</h3>
                    <div class="package-price">৳2,500</div>
                    <ul class="package-features">
                        <li><i class="fas fa-check"></i> Core Vaccinations (DHPP)</li>
                        <li><i class="fas fa-check"></i> Rabies Vaccination</li>
                        <li><i class="fas fa-check"></i> Basic Health Checkup</li>
                        <li><i class="fas fa-check"></i> Vaccination Certificate</li>
                        <li><i class="fas fa-check"></i> 1 Follow-up Visit</li>
                    </ul>
                    <a href="{{ route('vaccination.booking', ['package' => 'Basic Protection']) }}" class="package-btn">
                        <i class="fas fa-calendar-plus"></i>
                        Book Package
                    </a>
                </div>

                <!-- Premium Package -->
                <div class="package-card">
                    <div class="popular-badge">Most Popular</div>
                    <div class="package-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3 class="package-name">Premium Protection</h3>
                    <div class="package-price">৳4,500</div>
                    <ul class="package-features">
                        <li><i class="fas fa-check"></i> All Basic Package Features</li>
                        <li><i class="fas fa-check"></i> Kennel Cough Vaccination</li>
                        <li><i class="fas fa-check"></i> Lyme Disease Protection</li>
                        <li><i class="fas fa-check"></i> Comprehensive Health Exam</li>
                        <li><i class="fas fa-check"></i> Deworming Treatment</li>
                        <li><i class="fas fa-check"></i> 3 Follow-up Visits</li>
                    </ul>
                    <a href="{{ route('vaccination.booking', ['package' => 'Premium Protection']) }}" class="package-btn">
                        <i class="fas fa-calendar-plus"></i>
                        Book Package
                    </a>
                </div>

                <!-- Complete Package -->
                <div class="package-card">
                    <div class="package-icon">
                        <i class="fas fa-crown"></i>
                    </div>
                    <h3 class="package-name">Complete Care</h3>
                    <div class="package-price">৳6,800</div>
                    <ul class="package-features">
                        <li><i class="fas fa-check"></i> All Premium Package Features</li>
                        <li><i class="fas fa-check"></i> Annual Vaccination Plan</li>
                        <li><i class="fas fa-check"></i> Blood Work & Lab Tests</li>
                        <li><i class="fas fa-check"></i> Microchip Installation</li>
                        <li><i class="fas fa-check"></i> Emergency Support</li>
                        <li><i class="fas fa-check"></i> Unlimited Follow-ups</li>
                    </ul>
                    <a href="{{ route('vaccination.booking', ['package' => 'Complete Care']) }}" class="package-btn">
                        <i class="fas fa-calendar-plus"></i>
                        Book Package
                    </a>
                </div>
            </div>
        </section>

        <!-- Vaccination Experts Section -->
        <section class="experts-section">
            <div class="section-header">
                <h2>Our Vaccination Experts</h2>
                <p class="section-subtitle">Professional veterinarians are available for consultation and vaccination services</p>
            </div>

            <div style="text-align: center; padding: 60px 20px; background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%); border-radius: 20px; box-shadow: 0 8px 30px rgba(255,111,97,0.08);">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #ff6f61 0%, #ff9472 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px; font-size: 2rem; color: white; box-shadow: 0 8px 25px rgba(255,111,97,0.3);">
                    <i class="fas fa-user-md"></i>
                </div>
                <h3 style="font-size: 1.8rem; color: #2c3e50; font-weight: 800; margin-bottom: 15px;">Expert Veterinarians Available</h3>
                <p style="color: #5a6c7d; font-size: 1.1rem; line-height: 1.6; max-width: 600px; margin: 0 auto 30px;">
                    Our qualified veterinarians are ready to provide professional vaccination services for your pets. 
                    Contact us to schedule an appointment with one of our certified specialists.
                </p>
                <a href="{{ route('vaccination.booking') }}" style="background: linear-gradient(135deg, #ff6f61 0%, #ff9472 100%); color: white; border: none; padding: 15px 30px; border-radius: 25px; cursor: pointer; font-weight: 700; font-size: 1rem; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 15px rgba(255,111,97,0.3); letter-spacing: 0.5px; transition: all 0.3s ease;">
                    <i class="fas fa-calendar-plus"></i>
                    Schedule Consultation
                </a>
            </div>
        </section>

        <!-- Information Section -->
        <section class="info-section">
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="info-title">Flexible Scheduling</h3>
                    <p class="info-description">Book appointments that fit your schedule. We offer morning, afternoon, and evening slots to accommodate your busy lifestyle.</p>
                </div>
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h3 class="info-title">Certified Vaccines</h3>
                    <p class="info-description">All our vaccines are certified and approved by veterinary authorities, ensuring the highest safety standards for your pet.</p>
                </div>
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3 class="info-title">Caring Support</h3>
                    <p class="info-description">Our team provides compassionate care throughout the vaccination process, ensuring your pet feels comfortable and safe.</p>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        // Add animation on scroll
        function animateOnScroll() {
            const cards = document.querySelectorAll('.package-card, .expert-card');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, { threshold: 0.1 });

            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });
        }

        // Initialize animations
        window.addEventListener('load', animateOnScroll);
    </script>
@endsection