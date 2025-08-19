@extends('layouts.app')

@section('title', 'Veterinary Support - PETSROLOGY')

@section('styles')
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            color: #333;
            line-height: 1.6;
        }

        /* Enhanced Header */
        header {
            background: linear-gradient(135deg, #ff6f61 0%, #ff9472 100%);
            color: white;
            text-align: center;
            padding: 80px 20px 60px;
            box-shadow: 0 4px 20px rgba(255,111,97,0.2);
            position: relative;
            overflow: hidden;
        }

        header::before {
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

        header h1 {
            font-size: 3rem;
            margin: 0 0 15px 0;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: relative;
            z-index: 1;
        }

        header p {
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
        /* Enhanced Services Section */
        .services {
            padding: 60px 20px;
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
        }

        .services::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(135deg, #ff6f61, #ff9472);
            border-radius: 2px;
        }

        .services h2 {
            text-align: center;
            font-size: 2.8rem;
            margin-bottom: 20px;
            color: #ff6f61;
            font-weight: 800;
            letter-spacing: 1.2px;
        }

        .services-subtitle {
            text-align: center;
            font-size: 1.3rem;
            color: #5a6c7d;
            margin-bottom: 50px;
            font-weight: 500;
            line-height: 1.8;
        }
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 35px;
            margin-bottom: 60px;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }

        .service-card {
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

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 4px;
            background: linear-gradient(135deg, #ff6f61, #ff9472);
            transition: left 0.5s ease;
        }

        .service-card:hover::before {
            left: 0;
        }

        .service-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 20px 50px rgba(255,111,97,0.15), 0 8px 25px rgba(0,0,0,0.08);
            border-color: rgba(255,111,97,0.2);
        }

        .service-icon {
            font-size: 3.5rem;
            margin-bottom: 20px;
            display: block;
            transition: all 0.3s ease;
            filter: drop-shadow(0 4px 8px rgba(255,111,97,0.1));
        }

        .service-card:hover .service-icon {
            transform: scale(1.15) rotate(-8deg);
            filter: drop-shadow(0 6px 12px rgba(255,111,97,0.2));
        }

        .service-card h3 {
            font-size: 1.6rem;
            margin: 15px 0 12px 0;
            color: #2c3e50;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        .service-card p {
            color: #5a6c7d;
            line-height: 1.7;
            margin-bottom: 25px;
            font-size: 1.05rem;
            font-weight: 500;
        }
        .service-btn {
            background: linear-gradient(135deg, #ff6f61 0%, #ff9472 100%);
            color: white;
            border: none;
            padding: 12px 28px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 4px 15px rgba(255,111,97,0.3);
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        .service-btn::before {
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

        .service-btn:hover::before {
            left: 0;
        }

        .service-btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 25px rgba(255,111,97,0.4);
            color: white;
            text-decoration: none;
        }
        /* Enhanced Emergency Section */
        .emergency-section {
            background: linear-gradient(135deg, #fff3f2 0%, #ffe8e6 100%);
            padding: 50px 20px;
            margin: 40px 0;
            border-radius: 20px;
            margin-left: 20px;
            margin-right: 20px;
            box-shadow: 0 8px 30px rgba(211, 47, 47, 0.1);
        }

        .emergency-content {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }

        .emergency-content h2 {
            color: #d32f2f;
            font-size: 2.3rem;
            margin-bottom: 20px;
            font-weight: 800;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 4px rgba(211, 47, 47, 0.1);
        }

        .emergency-content p {
            font-size: 1.2rem;
            color: #5a6c7d;
            margin-bottom: 30px;
            line-height: 1.8;
            font-weight: 500;
        }

        .emergency-btn {
            background: linear-gradient(135deg, #d32f2f 0%, #b71c1c 100%);
            color: white;
            border: none;
            padding: 15px 35px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 6px 20px rgba(211, 47, 47, 0.3);
            letter-spacing: 0.5px;
        }

        .emergency-btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 10px 30px rgba(211, 47, 47, 0.4);
            color: white;
            text-decoration: none;
        }
        /* Enhanced Contact Section */
        .contact-section {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            padding: 70px 20px;
            margin: 0;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            border-radius: 20px 20px 0 0;
        }

        .contact-content {
            max-width: 1100px;
            margin: 0 auto;
            text-align: center;
        }

        .contact-content h2 {
            color: #ff6f61;
            font-size: 2.8rem;
            margin-bottom: 20px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .contact-subtitle {
            font-size: 1.3rem;
            color: #5a6c7d;
            margin-bottom: 60px;
            font-weight: 500;
            line-height: 1.8;
        }
        .contact-info {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            margin-bottom: 50px;
        }

        .contact-item {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            border-radius: 18px;
            box-shadow: 0 6px 25px rgba(255,111,97,0.1), 0 2px 8px rgba(0,0,0,0.05);
            padding: 30px 25px 25px;
            text-align: center;
            width: 220px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid rgba(255,111,97,0.05);
            position: relative;
            overflow: hidden;
        }

        .contact-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 3px;
            background: linear-gradient(135deg, #ff6f61, #ff9472);
            transition: left 0.5s ease;
        }

        .contact-item:hover::before {
            left: 0;
        }

        .contact-item:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 40px rgba(255,111,97,0.15), 0 5px 15px rgba(0,0,0,0.08);
            border-color: rgba(255,111,97,0.2);
        }

        .contact-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            display: block;
            transition: all 0.3s ease;
            filter: drop-shadow(0 2px 4px rgba(255,111,97,0.1));
        }

        .contact-item:hover .contact-icon {
            transform: scale(1.1) rotate(-5deg);
            filter: drop-shadow(0 4px 8px rgba(255,111,97,0.2));
        }

        .contact-item h4 {
            color: #2c3e50;
            margin: 12px 0 10px 0;
            font-size: 1.2rem;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        .contact-item p {
            color: #5a6c7d;
            margin: 0;
            font-size: 0.95rem;
            line-height: 1.6;
            font-weight: 500;
        }

        @media (max-width: 900px) {
            .services {
                padding: 30px 20px;
            }
            .services h2 {
                font-size: 2rem;
            }
            .services-grid {
                grid-template-columns: 1fr;
                gap: 25px;
            }
            .emergency-section {
                padding: 30px 20px;
            }
            .emergency-content h2 {
                font-size: 1.8rem;
            }
            .contact-section {
                padding: 50px 20px;
            }
            .contact-content h2 {
                font-size: 2rem;
            }
            .contact-info {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }
            .contact-item {
                width: auto;
                min-width: 0;
                max-width: none;
            }
        }
        @media (max-width: 700px) {
            header {
                padding: 40px 20px 30px;
            }
            header h1 {
                font-size: 2rem;
            }
            .service-card {
                width: 90vw;
                min-width: 0;
            }
            .services-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            .contact-info {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            .back-btn {
                top: 15px;
                right: 15px;
                padding: 6px 12px;
                font-size: 0.8rem;
            }
        }
        @media (max-width: 900px) {
            .service-card {
                width: 90vw;
                min-width: 0;
            }
        }

        /* Coming Soon Modal Styles */
        .coming-soon-modal {
            display: none;
            position: fixed;
            z-index: 10000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.6);
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            margin: 10% auto;
            padding: 0;
            border: none;
            border-radius: 20px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            animation: modalSlideIn 0.3s ease-out;
            overflow: hidden;
            position: relative;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-50px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .modal-header {
            background: linear-gradient(135deg, #ff6f61 0%, #ff9472 100%);
            color: white;
            padding: 25px 30px;
            text-align: center;
            position: relative;
        }

        .modal-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="rgba(255,255,255,0.1)"><path d="M0,50 Q250,0 500,50 T1000,50 L1000,100 L0,100 Z"/></svg>') repeat-x;
            background-size: 1000px 100px;
        }

        .modal-header h2 {
            font-size: 1.8rem;
            margin: 0;
            font-weight: 800;
            letter-spacing: 0.5px;
            position: relative;
            z-index: 1;
        }

        .modal-body {
            padding: 40px 30px;
            text-align: center;
        }

        .coming-soon-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            display: block;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-15px); }
            60% { transform: translateY(-7px); }
        }

        .modal-body h3 {
            color: #2c3e50;
            font-size: 1.5rem;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .modal-body p {
            color: #5a6c7d;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 30px;
            font-weight: 500;
        }

        .modal-close-btn {
            background: linear-gradient(135deg, #ff6f61 0%, #ff9472 100%);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255,111,97,0.3);
            letter-spacing: 0.5px;
        }

        .modal-close-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255,111,97,0.4);
        }

        .close {
            position: absolute;
            top: 15px;
            right: 20px;
            color: white;
            font-size: 2rem;
            font-weight: bold;
            cursor: pointer;
            z-index: 2;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            transition: all 0.3s ease;
        }

        .close:hover {
            background: rgba(255,255,255,0.3);
            transform: scale(1.1);
        }
    </style>
@endsection

@section('content')
    <div class="main-content">
        <header>
            <a href="{{ url('/welcome') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Home
            </a>
            <div class="header-icon-container">
                <div class="header-icon">
                    <span>🏥</span>
                </div>
            </div>
            <h1>Veterinary Support</h1>
            <p>Professional care for your beloved pets</p>
        </header>

        <section class="services">
            <h2>Our Pet Care Services</h2>
            <p class="services-subtitle">Comprehensive healthcare solutions for your beloved companions</p>
            <div class="services-grid">
                <div class="service-card">
                    <span class="service-icon">🩺</span>
                    <h3>General Checkup</h3>
                    <p>Comprehensive health examinations to keep your pet healthy and detect any issues early. Regular checkups are essential for your pet's wellbeing.</p>
                    <a href="{{ route('all.vets') }}" class="service-btn">View All Vets</a>
                </div>
                <div class="service-card">
                    <span class="service-icon">💉</span>
                    <h3>Vaccinations</h3>
                    <p>Essential vaccination services to protect your pet from diseases and infections. Keep your furry friend safe with up-to-date immunizations.</p>
                    <a href="{{ route('vaccination.schedule') }}" class="service-btn">Schedule Vaccination</a>
                </div>
                <div class="service-card">
                    <span class="service-icon">🏥</span>
                    <h3>Surgery</h3>
                    <p>Advanced surgical procedures performed by experienced veterinary surgeons. From routine spaying to complex operations, we provide expert care.</p>
                    <a href="{{ route('book.appointment') }}" class="service-btn">Surgical Consultation</a>
                </div>
                <div class="service-card">
                    <span class="service-icon">✂️</span>
                    <h3>Pet Grooming</h3>
                    <p>Professional grooming services including bathing, nail trimming, hair cutting, and overall hygiene care for your beloved pet.</p>
                    <button onclick="showComingSoon('Pet Grooming')" class="service-btn">Book Grooming</button>
                </div>
            </div>
        </section>

        <section class="emergency-section">
            <div class="emergency-content">
                <h2>🚨 Pet Emergency Services</h2>
                <p>We provide 24/7 emergency veterinary care for your pets in urgent situations. Our experienced veterinary team is always ready to help your furry friends during critical moments.</p>
                <a href="#" class="emergency-btn">Call Pet Emergency: +880 1777-987654</a>
            </div>
        </section>

        <section class="contact-section">
            <div class="contact-content">
                <h2>Contact Our Pet Care Team</h2>
                <p class="contact-subtitle">Professional veterinary services for your beloved companions</p>
                <div class="contact-info">
                    <div class="contact-item">
                        <span class="contact-icon">📍</span>
                        <h4>Our Location</h4>
                        <p>House 15, Road 27, Block K<br>Banani, Dhaka-1213<br>Bangladesh</p>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">📞</span>
                        <h4>Call Us</h4>
                        <p>Pet Care: +880 1711-234567<br>Emergency: +880 1777-987654</p>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">📧</span>
                        <h4>Email Us</h4>
                        <p>petcare@pethouse.com.bd<br>emergency@pethouse.com.bd</p>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">🕒</span>
                        <h4>Visit Hours</h4>
                        <p>Sun-Thu: 9:00 AM - 9:00 PM<br>Fri-Sat: 10:00 AM - 7:00 PM<br>Emergency: 24/7</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Coming Soon Modal -->
    <div id="comingSoonModal" class="coming-soon-modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="closeComingSoon()">&times;</span>
                <h2>🚧 Coming Soon!</h2>
            </div>
            <div class="modal-body">
                <span class="coming-soon-icon">🔜</span>
                <h3 id="modalServiceName">Pet Grooming Service</h3>
                <p>We're working hard to bring you this amazing feature! Our <strong id="modalServiceType">Pet Grooming</strong> service will be available very soon. Stay tuned for updates!</p>
                <button class="modal-close-btn" onclick="closeComingSoon()">Got It!</button>
            </div>
        </div>
    </div>

    <script>
        // Coming Soon Modal Functions
        function showComingSoon(serviceName) {
            const modal = document.getElementById('comingSoonModal');
            const serviceNameElement = document.getElementById('modalServiceName');
            const serviceTypeElement = document.getElementById('modalServiceType');
            
            serviceNameElement.textContent = serviceName + ' Service';
            serviceTypeElement.textContent = serviceName;
            
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
            
            // Add animation class
            setTimeout(() => {
                modal.querySelector('.modal-content').style.animation = 'modalSlideIn 0.3s ease-out';
            }, 10);
        }

        function closeComingSoon() {
            const modal = document.getElementById('comingSoonModal');
            const modalContent = modal.querySelector('.modal-content');
            
            // Add slide out animation
            modalContent.style.animation = 'modalSlideIn 0.3s ease-out reverse';
            
            setTimeout(() => {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto'; // Restore scrolling
            }, 300);
        }

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            const modal = document.getElementById('comingSoonModal');
            if (event.target === modal) {
                closeComingSoon();
            }
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const modal = document.getElementById('comingSoonModal');
                if (modal.style.display === 'block') {
                    closeComingSoon();
                }
            }
        });
    </script>
@endsection