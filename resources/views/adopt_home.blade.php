@extends('layouts.app')

@section('title', 'Adopt a Pet - PETSROLOGY')


@section('styles')
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

        /* Enhanced Search & Filter Section */
        .search-filter-section {
            background: #fff;
            padding: 35px 20px;
            margin: -25px 20px 0;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(255,111,97,0.12), 0 2px 8px rgba(0,0,0,0.04);
            position: relative;
            z-index: 2;
        }

        .search-filter-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .search-bar {
            display: flex;
            align-items: center;
            background: #f8f9fa;
            border-radius: 25px;
            padding: 8px 20px;
            margin-bottom: 25px;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .search-bar:focus-within {
            border-color: #ff6f61;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(255,111,97,0.1);
        }

        .search-input {
            flex: 1;
            border: none;
            background: transparent;
            padding: 12px 15px;
            font-size: 1rem;
            outline: none;
            font-family: 'Nunito', sans-serif;
        }

        .search-input::placeholder {
            color: #999;
        }

        .search-icon {
            color: #ff6f61;
            font-size: 1.2rem;
        }

        .filters-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .filter-group {
            position: relative;
        }

        .filter-select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            background: #fff;
            font-family: 'Nunito', sans-serif;
            font-size: 1rem;
            color: #333;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-select:focus {
            border-color: #ff6f61;
            outline: none;
            box-shadow: 0 0 0 3px rgba(255,111,97,0.1);
        }

        .clear-filters-btn {
            background: #6c757d;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-family: 'Nunito', sans-serif;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .clear-filters-btn:hover {
            background: #5a6268;
            transform: translateY(-1px);
        }

        /* Quick Actions Section */
        .quick-actions-section {
            margin: 40px 0 60px 0;
            padding: 30px 20px;
        }

        .quick-actions-tabs {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin: 0 auto;
            max-width: 800px;
            flex-wrap: wrap;
        }

        .action-tab {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            border: 2px solid #e9ecef;
            border-radius: 15px;
            padding: 20px 30px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            min-width: 200px;
            position: relative;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
        }

        .action-tab::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #ff6f61 0%, #ff9472 100%);
            transition: left 0.3s ease;
            z-index: -1;
        }

        /* First action tab (favorites) - Red/Orange theme */
        .action-tab:first-child::before {
            background: linear-gradient(135deg, #ff6f61 0%, #ff9472 100%);
        }

        /* Second action tab (first-time adopter) - Green theme */
        .action-tab:last-child::before {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        }

        .action-tab:last-child:hover,
        .action-tab:last-child.active {
            border-color: #28a745;
        }

        .action-tab:hover::before,
        .action-tab.active::before {
            left: 0;
        }

        .action-tab:hover,
        .action-tab.active {
            color: white;
            transform: translateY(-5px);
            text-decoration: none;
        }

        .action-tab:first-child:hover,
        .action-tab:first-child.active {
            border-color: #ff6f61;
        }

        .action-tab:last-child:hover,
        .action-tab:last-child.active {
            border-color: #28a745;
        }

        .action-tab-link {
            display: block;
        }

        .action-tab-link:hover {
            text-decoration: none;
            color: white;
        }

        .action-tab-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            transition: color 0.3s ease;
        }

        /* Default icon color for first tab (favorites) */
        .action-tab:first-child .action-tab-icon {
            color: #ff6f61;
        }

        /* Icon color for second tab (first-time adopter) */
        .action-tab:last-child .action-tab-icon {
            color: #28a745;
        }

        .action-tab:hover .action-tab-icon,
        .action-tab.active .action-tab-icon {
            color: white;
        }

        .action-tab h3 {
            font-size: 1.4rem;
            margin-bottom: 8px;
            font-weight: 800;
            color: #2c3e50;
            transition: color 0.3s ease;
        }

        .action-tab:hover h3,
        .action-tab.active h3 {
            color: white;
        }

        .action-tab p {
            font-size: 0.95rem;
            color: #5a6c7d;
            margin: 0;
            transition: color 0.3s ease;
        }

        .action-tab:hover p,
        .action-tab.active p {
            color: white;
        }

        /* Responsive Design for Action Tabs */
        @media (max-width: 700px) {
            .quick-actions-section {
                margin: 30px 0 50px 0;
                padding: 20px 15px;
            }
            
            .quick-actions-tabs {
                display: grid;
                grid-template-columns: 1fr;
                gap: 20px;
                max-width: none;
            }
            
            .action-tab {
                min-width: auto;
                padding: 15px 20px;
            }
            
            .action-tab-icon {
                font-size: 2rem;
                margin-bottom: 10px;
            }
            
            .action-tab h3 {
                font-size: 1.2rem;
                margin-bottom: 5px;
            }
            
            .action-tab p {
                font-size: 0.85rem;
            }
        }

        .results-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding: 0 5px;
        }

        .results-count {
            color: #666;
            font-weight: 600;
        }

        .view-toggle {
            display: flex;
            gap: 8px;
        }

        .view-btn {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .view-btn.active {
            background: #ff6f61;
            color: white;
            border-color: #ff6f61;
        }

        .view-btn:hover {
            border-color: #ff6f61;
        }
        .back-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255,255,255,0.2);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .back-btn:hover {
            background: rgba(255,255,255,0.3);
        }
        /* Enhanced Greeting Section */
        .greeting-section {
            padding: 50px 20px 40px;
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            margin: 20px 20px 0;
            border-radius: 18px;
            box-shadow: 0 6px 25px rgba(255,111,97,0.08), 0 2px 8px rgba(0,0,0,0.04);
            border: 1px solid rgba(255,111,97,0.05);
        }

        .greeting-content {
            max-width: 1000px;
            margin: 0 auto;
        }

        .greeting-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ff6f61 0%, #ff9472 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.3rem;
            font-weight: 700;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(255,111,97,0.2);
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .greeting-text h2 {
            margin: 0;
            font-size: 1.8rem;
            color: #333;
            font-weight: 700;
        }

        .greeting-text p {
            margin: 5px 0 0;
            color: #666;
            font-size: 1rem;
        }

        .stats-summary {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 1.8rem;
            font-weight: 700;
            color: #ff6f61;
            display: block;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #666;
            margin-top: 2px;
        }
        .categories {
            padding: 20px 20px 40px;
            background: #fff;
        }
        .categories-content {
            max-width: 800px;
            margin: 0 auto;
        }
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }
        .category-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 18px rgba(255,111,97,0.10), 0 1.5px 6px rgba(0,0,0,0.04);
            padding: 20px;
            text-align: center;
            transition: box-shadow 0.25s, transform 0.25s, border 0.25s;
            border: 2px solid transparent;
            cursor: pointer;
        }
        .category-card:hover {
            box-shadow: 0 8px 32px rgba(255,111,97,0.18), 0 3px 12px rgba(0,0,0,0.08);
            border: 2px solid #ff6f61;
            transform: translateY(-5px) scale(1.02);
        }
        .category-card.active {
            background: linear-gradient(135deg, #ff6f61 0%, #ff9472 100%);
            color: white;
            border: 2px solid #ff6f61;
        }
        .category-icon {
            width: 40px;
            height: 40px;
            margin: 0 auto 10px;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .category-card h4 {
            margin: 0;
            font-size: 1rem;
            font-weight: 600;
        }
        /* Enhanced Pets Section */
        .pets-section {
            padding: 50px 20px 80px;
            background: transparent;
        }

        .pets-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 50px;
            position: relative;
        }

        .section-header::before {
            content: '';
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(135deg, #ff6f61, #ff9472);
            border-radius: 2px;
        }

        .section-title {
            font-size: 2.8rem;
            margin-bottom: 15px;
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

        .pets-grid {
            display: grid;
            gap: 25px;
            transition: all 0.3s ease;
        }

        .pets-grid.grid-view {
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        }

        .pets-grid.list-view {
            grid-template-columns: 1fr;
        }

        /* Enhanced Pet Cards */
        .pet-card {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            border-radius: 18px;
            box-shadow: 0 6px 25px rgba(255,111,97,0.08), 0 2px 8px rgba(0,0,0,0.04);
            padding: 30px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid rgba(255,111,97,0.05);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .pet-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #ff6f61 0%, #ff9472 100%);
        }

        .pet-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 40px rgba(255,111,97,0.15), 0 5px 15px rgba(0,0,0,0.08);
            border-color: rgba(255,111,97,0.2);
        }

        .list-view .pet-card {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .grid-view .pet-card {
            display: flex;
            flex-direction: column;
            text-align: center;
        }

        .pet-image {
            width: 120px;
            height: 120px;
            border-radius: 15px;
            object-fit: cover;
            background: linear-gradient(135deg, #ff6f61 0%, #ff9472 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(255,111,97,0.15);
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .pet-card:hover .pet-image {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(255,111,97,0.2);
        }

        .grid-view .pet-image {
            margin: 0 auto 20px;
        }

        .pet-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 15px;
            transition: all 0.3s ease;
        }

        .pet-card:hover .pet-image img {
            transform: scale(1.1);
        }

        .pet-info {
            flex: 1;
        }

        .grid-view .pet-info {
            text-align: center;
        }

        .pet-info h3 {
            margin: 0 0 8px 0;
            font-size: 1.4rem;
            color: #333;
            font-weight: 700;
        }

        .pet-breed {
            color: #ff6f61;
            margin: 0 0 6px 0;
            font-size: 1rem;
            font-weight: 600;
        }

        .pet-details {
            color: #666;
            font-size: 0.95rem;
            margin: 0 0 15px 0;
        }

        .pet-tags {
            display: flex;
            gap: 8px;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }

        .grid-view .pet-tags {
            justify-content: center;
        }

        .pet-tag {
            background: #f8f9fa;
            color: #666;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .pet-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .grid-view .pet-actions {
            justify-content: center;
        }

        .adopt-btn {
            background: linear-gradient(135deg, #ff6f61 0%, #ff9472 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 25px;
            font-family: 'Nunito', sans-serif;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 4px 15px rgba(255,111,97,0.3);
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        .adopt-btn::before {
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

        .adopt-btn:hover::before {
            left: 0;
        }

        .adopt-btn:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 6px 20px rgba(255,111,97,0.4);
        }

        .favorite-btn {
            background: #f8f9fa;
            color: #666;
            border: 2px solid #e9ecef;
            padding: 8px 12px;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .favorite-btn:hover,
        .favorite-btn.active {
            background: #ff6f61;
            color: white;
            border-color: #ff6f61;
        }

        .no-pets-message {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }

        .no-pets-message i {
            font-size: 3rem;
            color: #ddd;
            margin-bottom: 20px;
            display: block;
        }

        .no-pets-message h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #999;
        }

        .no-pets-message p {
            font-size: 1rem;
            margin: 0;
        }
        /* Enhanced Contact Section */
        .contact-section {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            padding: 70px 20px;
            margin: 40px 20px 0;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(255,111,97,0.08), 0 2px 8px rgba(0,0,0,0.04);
            border: 1px solid rgba(255,111,97,0.05);
        }

        .contact-content {
            max-width: 1000px;
            margin: 0 auto;
            text-align: center;
        }

        .contact-content h2 {
            color: #ff6f61;
            font-size: 2.8rem;
            margin-bottom: 20px;
            font-weight: 800;
            letter-spacing: 1.2px;
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
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }

        .contact-item {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            border-radius: 18px;
            box-shadow: 0 6px 25px rgba(255,111,97,0.1), 0 2px 8px rgba(0,0,0,0.05);
            padding: 30px 25px 25px;
            text-align: center;
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
            .pets-section {
                padding: 40px 20px 60px;
            }
            
            .section-title {
                font-size: 2.2rem;
            }
            
            .contact-info {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }
            
            .contact-item {
                width: auto;
                min-width: 0;
            }
            
            .navbar-nav {
                gap: 4px;
            }
            
            .nav-link, .logout-btn {
                padding: 10px 16px;
                font-size: 0.9rem;
            }
        }
        @media (max-width: 700px) {
            .navbar-container {
                padding: 0 15px;
                height: 60px;
            }
            .brand-logo {
                width: 35px;
                height: 35px;
                margin-right: 8px;
            }
            .brand-text {
                font-size: 1.2rem;
            }
            .navbar-nav {
                flex-wrap: wrap;
                gap: 2px;
            }
            .nav-link {
                padding: 8px 12px;
                font-size: 0.85rem;
            }
            header {
                padding: 40px 20px 30px;
            }
            header h1 {
                font-size: 2rem;
            }
            .categories-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }
            .back-btn {
                top: 15px;
                right: 15px;
                padding: 6px 12px;
                font-size: 0.8rem;
            }
            .greeting-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
        @media (max-width: 1150px) {
            .nav-link {
                padding: 12px 14px;
                font-size: 0.9rem;
            }
            .navbar-container {
                padding: 0 15px;
            }
        }
        @media (max-width: 900px) {
            .navbar-nav {
                gap: 4px;
            }
            .nav-link {
                padding: 10px 12px;
                font-size: 0.85rem;
            }
        }
        @media (max-width: 700px) {
            .navbar-container {
                padding: 0 10px;
                height: auto;
                min-height: 60px;
                flex-wrap: wrap;
            }
            .navbar-nav {
                width: 100%;
                justify-content: center;
                margin-top: 10px;
                flex-wrap: wrap;
                gap: 2px;
                margin-right: 0;
            }
            .brand-logo {
                width: 35px;
                height: 35px;
                margin-right: 8px;
            }
            .brand-text {
                font-size: 1.2rem;
            }
            .nav-link {
                padding: 8px 10px;
                font-size: 0.8rem;
            }
        }
    </style>
@endsection

@section('content')
        <header>
            <div class="header-icon-container">
                <div class="header-icon">
                    <span>🐾</span>
                </div>
            </div>
            <h1>Adopt a Pet</h1>
            <p>Find your perfect companion and give them a loving home</p>
        </header>

        <section class="greeting-section">
            <div class="greeting-content">
                <div class="greeting-header">
                    <div class="user-info">
                        <div class="user-avatar">
                            @if($currentUser && $currentUser->avatar)
                                <img src="{{ asset('storage/' . $currentUser->avatar) }}" alt="User Avatar" />
                            @else
                                {{ $currentUser ? strtoupper(substr($currentUser->name ?? 'U', 0, 1)) : 'U' }}
                            @endif
                        </div>
                        <div class="greeting-text">
                            <h2>Hi, {{ $currentUser ? $currentUser->name ?? 'Guest' : 'Guest' }}!</h2>
                            <p>
                                @if($currentUser)
                                    @php
                                        $hour = date('H');
                                        $timeGreeting = '';
                                        if ($hour < 12) {
                                            $timeGreeting = 'Good morning! ';
                                        } elseif ($hour < 17) {
                                            $timeGreeting = 'Good afternoon! ';
                                        } else {
                                            $timeGreeting = 'Good evening! ';
                                        }
                                        
                                        // Check if user has previous adoption requests
                                        $userAdoptions = \App\Models\AdoptionRequest::where('user_id', $currentUser->id)->count();
                                        
                                        if ($userAdoptions > 0) {
                                            $message = $timeGreeting . "Welcome back! Looking for another furry friend?";
                                        } else {
                                            $message = $timeGreeting . "Ready to find your new best friend?";
                                        }
                                    @endphp
                                    {{ $message }}
                                @else
                                    Ready to find your new best friend?
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="stats-summary">
                        <div class="stat-item">
                            <span class="stat-number" data-target="{{ $totalAvailablePets }}" id="totalPets">0</span>
                            <div class="stat-label">Available Pets</div>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number" data-target="{{ $totalHappyAdoptions }}">0</span>
                            <div class="stat-label">Happy Adoptions</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <section class="search-filter-section">
            <div class="search-filter-container">
                <form method="GET" action="" id="filterForm">
                    <div class="search-bar">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" name="search" value="{{ request('search') }}" placeholder="Search by name, breed, or type...">
                    </div>
                    <div class="filters-row">
                        <div class="filter-group">
                            <select class="filter-select" name="category" onchange="document.getElementById('filterForm').submit()">
                                <option value="">All Categories</option>
                                <option value="dog" {{ request('category') == 'dog' ? 'selected' : '' }}>Dog</option>
                                <option value="cat" {{ request('category') == 'cat' ? 'selected' : '' }}>Cat</option>
                                <option value="bird" {{ request('category') == 'bird' ? 'selected' : '' }}>Bird</option>
                                <option value="other" {{ request('category') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <select class="filter-select" name="age" onchange="document.getElementById('filterForm').submit()">
                                <option value="">All Ages</option>
                                <option value="young" {{ request('age') == 'young' ? 'selected' : '' }}>Young (Under 1 year)</option>
                                <option value="adult" {{ request('age') == 'adult' ? 'selected' : '' }}>Adult (1-3 years)</option>
                                <option value="senior" {{ request('age') == 'senior' ? 'selected' : '' }}>Senior (3+ years)</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <select class="filter-select" name="gender" onchange="document.getElementById('filterForm').submit()">
                                <option value="">All Genders</option>
                                <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <button type="button" class="clear-filters-btn" onclick="window.location.href='{{ url()->current() }}'">
                                <i class="fas fa-times"></i> Clear Filters
                            </button>
                        </div>
                    </div>
                    <div class="results-info">
                        <div class="results-count">Showing {{ count($adoptionPosts) }} pet{{ count($adoptionPosts) == 1 ? '' : 's' }}</div>
                        <div class="view-toggle">
                            <button class="view-btn active" id="gridViewBtn" type="button" onclick="toggleView('grid')">
                                <i class="fas fa-th-large"></i>
                            </button>
                            <button class="view-btn" id="listViewBtn" type="button" onclick="toggleView('list')">
                                <i class="fas fa-list"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </section>

        <!-- Quick Actions Section -->
        <section class="quick-actions-section">
            <div class="quick-actions-tabs">
                <div class="action-tab" onclick="toggleFavorites()">
                    <div class="action-tab-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3>Show Favorites</h3>
                    <p>View your saved pets</p>
                </div>
                <a href="{{ route('first.time.adopter') }}" class="action-tab action-tab-link">
                    <div class="action-tab-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3>Haven't adopted a pet before</h3>
                    <p>New to pet adoption? Get guidance</p>
                </a>
            </div>
        </section>

        <section class="pets-section">
            <div class="pets-content">
                <div class="section-header">
                    <h2 class="section-title">Available Pets</h2>
                    <p class="section-subtitle">Meet our wonderful animals looking for their forever homes</p>
                </div>
                <div class="pets-grid grid-view" id="petsGrid">
                    @foreach($adoptionPosts as $post)
                        <div class="pet-card"
                            data-category="{{ strtolower($post->category) ?? 'other' }}"
                            data-age="{{ $post->pet_age < 1 ? 'young' : ($post->pet_age < 3 ? 'adult' : 'senior') }}"
                            data-gender="{{ strtolower($post->gender) }}"
                            data-name="{{ strtolower($post->pet_name) }}"
                            data-breed="{{ strtolower($post->title) ?? 'unknown' }}">
                            <div class="pet-image">
                                <img src="{{ $post->image ? $post->getImageUrl() : 'https://placehold.co/160x160?text=No+Image' }}" alt="{{ $post->pet_name }}" />
                            </div>
                            <div class="pet-info">
                                <h3>{{ $post->pet_name }}</h3>
                                <p class="pet-breed">{{ $post->title }}</p>
                                <p class="pet-details">{{ ucfirst($post->gender) }} • {{ $post->pet_age }} year{{ $post->pet_age == 1 ? '' : 's' }} old</p>
                                <div class="pet-tags">
                                    <span class="pet-tag">{{ $post->character }}</span>
                                </div>
                                <div class="pet-actions">
                                    @if($post->status === 'adopted')
                                        <span class="adopt-btn" style="background: #6c757d; cursor: not-allowed;">Adopted</span>
                                    @else
                                        <a class="adopt-btn" href="{{ url('/adoption-details?pet=' . urlencode(strtolower($post->pet_name))) }}">Adopt Me</a>
                                    @endif
                                    <button class="favorite-btn" onclick="toggleFavorite(this)"><i class="far fa-heart"></i></button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="no-pets-message" id="noPetsMessage" style="display: none;">
                    <i class="fas fa-search"></i>
                    <h3>No pets found</h3>
                    <p>Try adjusting your search criteria or filters</p>
                </div>
            </div>
        </section>

        <section class="contact-section">
            <div class="contact-content">
                <h2>Contact Our Adoption Team</h2>
                <p class="contact-subtitle">We're here to help you find your perfect companion</p>
                <div class="contact-info">
                    <div class="contact-item">
                        <span class="contact-icon">📍</span>
                        <h4>Visit Us</h4>
                        <p>Shop-11, Mirpur-1<br>Mirpur, Dhaka-1213<br>Bangladesh</p>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">📞</span>
                        <h4>Call Us</h4>
                        <p>+880 1609192668<br>+8801751187753</p>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">📧</span>
                        <h4>Email Us</h4>
                        <p>adopt@pethouse.com<br>info@pethouse.com</p>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">🕐</span>
                        <h4>Open Hours</h4>
                        <p>Mon-Sat: 9AM-7PM<br>Sunday: 10AM-5PM</p>
                    </div>
                </div>
            </div>
        </section>
@endsection

@section('scripts')
    <script>
        // Search and Filter Functionality
        function initializeFilters() {
            const searchInput = document.getElementById('searchInput');
            const categoryFilter = document.getElementById('categoryFilter');
            const ageFilter = document.getElementById('ageFilter');
            const genderFilter = document.getElementById('genderFilter');
            const petCards = document.querySelectorAll('.pet-card');
            const noPetsMessage = document.getElementById('noPetsMessage');
            const resultsCount = document.getElementById('resultsCount');

            function filterPets() {
                const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';
                const categoryValue = categoryFilter ? categoryFilter.value : '';
                const ageValue = ageFilter ? ageFilter.value : '';
                const genderValue = genderFilter ? genderFilter.value : '';
                const favoritesBtn = document.getElementById('favoritesBtn');
                const showingFavorites = favoritesBtn && favoritesBtn.classList.contains('active');
                const favorites = showingFavorites ? JSON.parse(localStorage.getItem('favoritePets') || '[]') : [];

                let visibleCount = 0;

                petCards.forEach(card => {
                    const petName = card.dataset.name ? card.dataset.name.toLowerCase() : '';
                    const petBreed = card.dataset.breed ? card.dataset.breed.toLowerCase() : '';
                    const petCategory = card.dataset.category ? card.dataset.category.toLowerCase() : '';
                    const petAge = card.dataset.age ? card.dataset.age.toLowerCase() : '';
                    const petGender = card.dataset.gender ? card.dataset.gender.toLowerCase() : '';

                    // Dynamic filtering using actual values from AdoptionPost table
                    const matchesSearch = !searchTerm || petName.includes(searchTerm) || petBreed.includes(searchTerm);
                    const matchesCategory = !categoryValue || petCategory === categoryValue.toLowerCase();
                    const matchesAge = !ageValue || petAge === ageValue.toLowerCase();
                    const matchesGender = !genderValue || petGender === genderValue.toLowerCase();
                    const matchesFavorites = !showingFavorites || favorites.includes(card.dataset.name);

                    if (matchesSearch && matchesCategory && matchesAge && matchesGender && matchesFavorites) {
                        card.style.display = 'block';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Update results count
                if (resultsCount) {
                    if (showingFavorites) {
                        resultsCount.textContent = `Showing ${visibleCount} favorite pets`;
                    } else {
                        resultsCount.textContent = `Showing ${visibleCount} of ${petCards.length} pets`;
                    }
                }

                // Show/hide no pets message
                if (noPetsMessage) {
                    if (visibleCount === 0) {
                        noPetsMessage.style.display = 'block';
                    } else {
                        noPetsMessage.style.display = 'none';
                    }
                }
            }

            // Add event listeners with safety checks
            if (searchInput) searchInput.addEventListener('input', filterPets);
            if (categoryFilter) categoryFilter.addEventListener('change', filterPets);
            if (ageFilter) ageFilter.addEventListener('change', filterPets);
            if (genderFilter) genderFilter.addEventListener('change', filterPets);
        }

        // Clear all filters function
        function clearAllFilters() {
            const searchInput = document.getElementById('searchInput');
            const categoryFilter = document.getElementById('categoryFilter');
            const ageFilter = document.getElementById('ageFilter');
            const genderFilter = document.getElementById('genderFilter');
            const favoritesBtn = document.getElementById('favoritesBtn');

            if (searchInput) searchInput.value = '';
            if (categoryFilter) categoryFilter.value = '';
            if (ageFilter) ageFilter.value = '';
            if (genderFilter) genderFilter.value = '';
            
            // Reset favorites display
            if (favoritesBtn && favoritesBtn.classList.contains('active')) {
                favoritesBtn.classList.remove('active');
                favoritesBtn.innerHTML = '<i class="fas fa-heart"></i> Show Favorites';
            }

            // Trigger filter update
            const event = new Event('change');
            if (categoryFilter) categoryFilter.dispatchEvent(event);
        }

        // View Toggle Functionality
        function toggleView(viewType) {
            const petsGrid = document.getElementById('petsGrid');
            const gridBtn = document.getElementById('gridViewBtn');
            const listBtn = document.getElementById('listViewBtn');

            if (petsGrid && gridBtn && listBtn) {
                if (viewType === 'grid') {
                    petsGrid.className = 'pets-grid grid-view';
                    gridBtn.classList.add('active');
                    listBtn.classList.remove('active');
                } else {
                    petsGrid.className = 'pets-grid list-view';
                    listBtn.classList.add('active');
                    gridBtn.classList.remove('active');
                }
            }
        }

        // Pet Card Actions
        function adoptPet(petName) {
            // Redirect to adoption details page with pet information
            window.location.href = '/adoption-details?pet=' + encodeURIComponent(petName.toLowerCase());
        }

        function toggleFavorite(button) {
            const petCard = button.closest('.pet-card');
            const petName = petCard.dataset.name;
            const icon = button.querySelector('i');
            
            // Get current favorites from localStorage
            let favorites = JSON.parse(localStorage.getItem('favoritePets') || '[]');
            
            if (icon.classList.contains('far')) {
                // Add to favorites
                icon.classList.remove('far');
                icon.classList.add('fas');
                button.classList.add('active');
                if (!favorites.includes(petName)) {
                    favorites.push(petName);
                }
            } else {
                // Remove from favorites
                icon.classList.remove('fas');
                icon.classList.add('far');
                button.classList.remove('active');
                favorites = favorites.filter(name => name !== petName);
            }
            
            // Save to localStorage
            localStorage.setItem('favoritePets', JSON.stringify(favorites));
            
            // Update favorites count if showing favorites
            const favoritesBtn = document.getElementById('favoritesBtn');
            if (favoritesBtn && favoritesBtn.classList.contains('active')) {
                updateFavoritesDisplay();
            }
        }

        // Load favorites from localStorage and apply to UI
        function loadFavorites() {
            const favorites = JSON.parse(localStorage.getItem('favoritePets') || '[]');
            const petCards = document.querySelectorAll('.pet-card');
            
            petCards.forEach(card => {
                const petName = card.dataset.name;
                const favoriteBtn = card.querySelector('.favorite-btn');
                const icon = favoriteBtn.querySelector('i');
                
                if (favorites.includes(petName)) {
                    icon.classList.remove('far');
                    icon.classList.add('fas');
                    favoriteBtn.classList.add('active');
                } else {
                    icon.classList.remove('fas');
                    icon.classList.add('far');
                    favoriteBtn.classList.remove('active');
                }
            });
        }

        // Toggle favorites display
        function toggleFavorites() {
            const favoritesTab = document.querySelector('.action-tab');
            const isActive = favoritesTab.classList.contains('active');
            
            if (isActive) {
                // Show all pets
                favoritesTab.classList.remove('active');
                favoritesTab.querySelector('h3').textContent = 'Show Favorites';
                favoritesTab.querySelector('p').textContent = 'View your saved pets';
                showAllPets();
            } else {
                // Show only favorites
                favoritesTab.classList.add('active');
                favoritesTab.querySelector('h3').textContent = 'Show All Pets';
                favoritesTab.querySelector('p').textContent = 'View all available pets';
                showOnlyFavorites();
            }
        }

        // Show only favorite pets
        function showOnlyFavorites() {
            const favorites = JSON.parse(localStorage.getItem('favoritePets') || '[]');
            const petCards = document.querySelectorAll('.pet-card');
            const noPetsMessage = document.getElementById('noPetsMessage');
            let visibleCount = 0;
            
            petCards.forEach(card => {
                const petName = card.dataset.name;
                if (favorites.includes(petName)) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Update results count
            const resultsCount = document.getElementById('resultsCount');
            if (resultsCount) {
                resultsCount.textContent = `Showing ${visibleCount} favorite pets`;
            }
            
            // Show/hide no pets message
            if (noPetsMessage) {
                if (visibleCount === 0) {
                    noPetsMessage.style.display = 'block';
                    noPetsMessage.querySelector('h3').textContent = 'No favorite pets yet';
                    noPetsMessage.querySelector('p').textContent = 'Start adding pets to your favorites by clicking the heart icon';
                } else {
                    noPetsMessage.style.display = 'none';
                }
            }
        }

        // Show all pets (reset favorites filter)
        function showAllPets() {
            const petCards = document.querySelectorAll('.pet-card');
            const noPetsMessage = document.getElementById('noPetsMessage');
            let visibleCount = 0;
            
            petCards.forEach(card => {
                card.style.display = 'block';
                visibleCount++;
            });
            
            // Update results count
            const resultsCount = document.getElementById('resultsCount');
            if (resultsCount) {
                resultsCount.textContent = `Showing ${visibleCount} of ${visibleCount} pets`;
            }
            
            // Hide no pets message
            if (noPetsMessage) {
                noPetsMessage.style.display = 'none';
            }
            
            // Re-apply other filters
            initializeFilters();
            const categoryFilter = document.getElementById('categoryFilter');
            if (categoryFilter) {
                categoryFilter.dispatchEvent(new Event('change'));
            }
        }

        // Update favorites display when favorites change
        function updateFavoritesDisplay() {
            const favoritesBtn = document.getElementById('favoritesBtn');
            if (favoritesBtn && favoritesBtn.classList.contains('active')) {
                showOnlyFavorites();
            }
        }

        // Filter Button Actions for Category Cards
        // Now supports optional age and gender filtering
        function filterPetsByCategory(category, age, gender, el) {
            const categoryFilter = document.getElementById('categoryFilter');
            const ageFilter = document.getElementById('ageFilter');
            const genderFilter = document.getElementById('genderFilter');
            if (categoryFilter) {
                categoryFilter.value = category;
            }
            if (ageFilter && age) {
                ageFilter.value = age;
            } else if (ageFilter) {
                ageFilter.value = '';
            }
            if (genderFilter && gender) {
                genderFilter.value = gender;
            } else if (genderFilter) {
                genderFilter.value = '';
            }
            // Update active category card
            document.querySelectorAll('.category-card').forEach(card => card.classList.remove('active'));
            if (el) {
                el.classList.add('active');
            }
            // Trigger filter update
            if (categoryFilter) categoryFilter.dispatchEvent(new Event('change'));
            if (ageFilter && age) ageFilter.dispatchEvent(new Event('change'));
            if (genderFilter && gender) genderFilter.dispatchEvent(new Event('change'));
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            initializeFilters();

            // Set default active view button
            const gridBtn = document.getElementById('gridViewBtn');
            if (gridBtn) gridBtn.classList.add('active');

            // Initialize stats with animation
            animateStatCounters();
            
            // Update total pets count dynamically based on visible cards
            updateTotalPetsCount();

            // Initialize results count
            const resultsCount = document.getElementById('resultsCount');
            const petCards = document.querySelectorAll('.pet-card');
            if (resultsCount) {
                resultsCount.textContent = `Showing ${petCards.length} of ${petCards.length} pets`;
            }

            // Load favorites from localStorage
            loadFavorites();
        });

        // Animate stat counters
        function animateStatCounters() {
            const counters = document.querySelectorAll('.stat-number[data-target]');
            
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const duration = 1500; // 1.5 seconds
                const increment = target / (duration / 16); // 60fps
                let current = 0;
                
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    
                    // Update counter display
                    counter.textContent = Math.floor(current);
                }, 16);
            });
        }

        // Update total pets count when filters change
        function updateTotalPetsCount() {
            const petCards = document.querySelectorAll('.pet-card');
            const totalPetsElement = document.getElementById('totalPets');
            
            if (totalPetsElement && !totalPetsElement.hasAttribute('data-target')) {
                // Only update if not using dynamic data
                totalPetsElement.textContent = petCards.length;
            }
        }
    </script>
@endsection