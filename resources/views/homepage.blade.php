@extends('layouts.app')

@section('title', 'Home - ESEM')

@push('styles')
    <style>

        .booking-page {
            padding: 40px 0;
            background: #f9fafb;
            min-height: 100vh;
        }

        .booking-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 40px;
            align-items: start;
        }

        .event-details-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .event-header {
            display: flex;
            gap: 25px;
            margin-bottom: 30px;
        }

        .event-image {
            width: 200px;
            height: 250px;
            border-radius: 12px;
            object-fit: cover;
            background: #f3f4f6;
        }

        .event-info h1 {
            font-size: 28px;
            color: #1f2937;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .event-meta {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 20px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #6b7280;
            font-size: 14px;
        }

        .event-price {
            font-size: 24px;
            color: #14b8a6;
            font-weight: 700;
            margin: 20px 0;
        }

        .event-description {
            color: #4b5563;
            line-height: 1.6;
            margin-top: 20px;
        }

        .booking-form-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 20px;
        }

        .form-title {
            font-size: 20px;
            color: #1f2937;
            margin-bottom: 25px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #374151;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            border-color: #14b8a6;
            outline: none;
        }

        .btn-proceed {
            background: #14b8a6;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            width: 100%;
            font-size: 16px;
            margin-top: 10px;
        }

        .btn-proceed:hover {
            background: #0d9488;
            transform: translateY(-2px);
        }

        .payment-methods {
            margin-top: 25px;
            border-top: 1px solid #e5e7eb;
            padding-top: 20px;
        }

        .payment-methods h4 {
            margin-bottom: 15px;
            color: #374151;
        }

        .payment-option {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .payment-option.selected {
            border-color: #14b8a6;
            background: #f0fdfa;
        }

        .payment-option input {
            margin: 0;
        }

        /* Existing homepage styles remain unchanged */
        .search-section {
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            padding: 40px 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .search-wrapper {
            max-width: 900px;
            margin: 0 auto;
            position: relative;
        }

        .search-container {
            background: white;
            border-radius: 50px;
            padding: 8px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s;
        }

        .search-container:hover {
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }

        .search-container:focus-within {
            box-shadow: 0 12px 40px rgba(20, 184, 166, 0.3);
            transform: translateY(-2px);
        }

        .search-icon-left {
            padding-left: 20px;
            color: #14b8a6;
            font-size: 20px;
        }

        .search-input {
            flex: 1;
            border: none;
            outline: none;
            padding: 12px 10px;
            font-size: 16px;
            color: #1f2937;
            background: transparent;
        }

        .search-input::placeholder {
            color: #9ca3af;
        }

        .search-btn {
            background: #14b8a6;
            color: white;
            border: none;
            padding: 12px 32px;
            border-radius: 40px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .search-btn:hover {
            background: #0d9488;
            transform: scale(1.05);
        }

        .search-btn:active {
            transform: scale(0.98);
        }

        /* Hero Banner */
        .hero-banner {
            position: relative;
            padding: 80px 0;
            text-align: center;
            color: white;
            overflow: hidden;
            min-height: 400px;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
        }

        .hero-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('/image/seminar-background.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            filter: brightness(0.7);
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-banner h1 {
            font-size: 48px;
            margin-bottom: 30px;
            line-height: 1.2;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
            font-weight: 900;
        }

        /* Menu Options */
        .menu-options {
            padding: 60px 0;
            background: white;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .section-header h2 {
            font-size: 32px;
            color: #1f2937;
            position: relative;
            padding-bottom: 10px;
        }

        .section-header h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: #14b8a6;
            border-radius: 2px;
        }

        .view-all {
            color: #14b8a6;
            text-decoration: none;
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 20px;
            transition: all 0.3s;
            border: 2px solid transparent;
        }

        .view-all:hover {
            background: #ecfdf5;
            border-color: #14b8a6;
        }

        .cards-wrapper {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .cards-grid-all {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            transition: transform 0.3s ease-in-out;
        }

        .cards-grid {
            display: flex;
            gap: 16px;
            overflow-x: auto;
            scroll-behavior: smooth;
            /* ruang agar tombol tidak tertutup */
        }

        .cards-grid::-webkit-scrollbar {
            display: none;
            /* opsional */
        }

        .event-card {
            background: white;
            min-width: 240px;
            flex-shrink: 0;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.4s;
            position: relative;
        }

        .scroll-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 999;
            font-size: 34px;
            background: white;
            border: 2px solid #00bfa5;
            color: #00bfa5;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            cursor: pointer;
        }

        .scroll-btn.left {
            left: 5px;
        }

        .scroll-btn.right {
            right: 5px;
        }

        .event-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
        }

        .event-card img {
            width: 100%;
            height: 320px;
            object-fit: cover;
            background: #f3f4f6;
            transition: transform 0.4s;
        }

        .event-card:hover img {
            transform: scale(1.05);
        }

        .card-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
        }

        .card-btn {
            width: 100%;
            padding: 12px;
            background: #14b8a6;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .card-btn:hover {
            background: #0d9488;
            transform: scale(1.03);
        }

        .card-btn.disabled {
            background: #6b7280;
            cursor: not-allowed;
        }

        /* Enhanced Recent Events Section */
        .recent-events {
            padding: 60px 0;
            background: #f9fafb;
        }

        .filter-controls {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            align-items: center;
            flex-wrap: wrap;
        }

        .filter-dropdown {
            position: relative;
        }

        .filter-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 24px;
            background: white;
            border: 2px solid #14b8a6;
            border-radius: 12px;
            cursor: pointer;
            font-size: 14px;
            color: #14b8a6;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .filter-btn:hover {
            background: #ecfdf5;
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.15);
            transform: translateY(-2px);
        }

        .filter-btn .emoji {
            font-size: 16px;
            transition: transform 0.3s;
        }

        .filter-btn.active .emoji {
            transform: rotate(180deg);
        }

        .filter-menu {
            display: none;
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            min-width: 220px;
            z-index: 100;
            overflow: hidden;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .filter-menu.active {
            display: block;
        }

        .filter-menu label {
            display: flex;
            align-items: center;
            padding: 12px 18px;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 14px;
            color: #1f2937;
        }

        .filter-menu label:hover {
            background: #f3f4f6;
            padding-left: 22px;
        }

        .filter-menu input[type="checkbox"] {
            margin-right: 12px;
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #14b8a6;
        }

        .filter-tags {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            align-items: center;
        }

        .filter-tag {
            background: #14b8a6;
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .filter-tag .remove {
            cursor: pointer;
            font-weight: bold;
            opacity: 0.8;
            transition: opacity 0.2s;
        }

        .filter-tag .remove:hover {
            opacity: 1;
        }

        .search-filter {
            flex: 1;
            max-width: 450px;
            position: relative;
        }

        .search-filter-input {
            width: 100%;
            padding: 12px 45px 12px 45px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 14px;
            outline: none;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .search-filter-input:focus {
            border-color: #14b8a6;
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.15);
        }

        .search-filter .icon-left {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #9ca3af;
        }

        .search-filter .icon-right {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            color: #9ca3af;
            cursor: pointer;
            transition: all 0.2s;
        }

        .search-filter .icon-right:hover {
            color: #14b8a6;
            transform: translateY(-50%) scale(1.2);
        }

        .events-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .event-item {
            background: white;
            border-radius: 16px;
            padding: 25px;
            display: flex;
            align-items: center;
            gap: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            transition: all 0.3s;
            border: 2px solid transparent;
        }

        .event-item:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
            border-color: #14b8a6;
            transform: translateX(5px);
        }

        .event-item.disabled {
            background: #f3f4f6;
            opacity: 0.6;
        }

        .event-thumb {
            width: 120px;
            height: 120px;
            border-radius: 12px;
            object-fit: cover;
            background: #f3f4f6;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .event-item.disabled .event-thumb {
            filter: grayscale(100%);
        }

        .event-info {
            flex: 1;
        }

        .event-info h3 {
            font-size: 22px;
            color: #14b8a6;
            margin-bottom: 5px;
            font-weight: 700;
        }

        .event-time {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .event-title {
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 5px;
        }

        .event-location {
            color: #6b7280;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .event-actions {
            display: flex;
            gap: 12px;
        }

        .btn-view {
            padding: 12px 28px;
            border: 2px solid #14b8a6;
            background: white;
            color: #14b8a6;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-view:hover {
            background: #ecfdf5;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.2);
        }

        .btn-book {
            padding: 12px 28px;
            background: #14b8a6;
            border: none;
            color: white;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-book:hover {
            background: #0d9488;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3);
        }

        .btn-book.disabled {
            background: #d1d5db;
            cursor: not-allowed;
        }

        .hidden {
            display: none !important;
        }

        /* Smooth Animations */
        .event-item {
            animation: fadeInUp 0.5s ease;
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

        @media (max-width: 768px) {
            .search-container {
                flex-direction: column;
                border-radius: 20px;
                padding: 15px;
            }

            .search-btn {
                width: 100%;
                justify-content: center;
            }

            .hero-banner h1 {
                font-size: 32px;
            }

            .cards-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .event-item {
                flex-direction: column;
                text-align: center;
            }

            .event-thumb {
                width: 100%;
                height: 200px;
            }

            .event-actions {
                flex-direction: column;
                width: 100%;
            }

            .filter-controls {
                flex-direction: column;
                align-items: stretch;
            }

            .search-filter {
                max-width: 100%;
            }

            .booking-container {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .event-header {
                flex-direction: column;
            }

            .event-image {
                width: 100%;
                height: 250px;
            }
        }
    </style>

@endpush

@section('content')
    @if(isset($isBookingPage) && $isBookingPage)
        <!-- Booking Page -->
        <section class="booking-page">
            <div class="container booking-container">
                <!-- Event Details -->
                <div class="event-details-card">
                    <div class="event-header">
                        <img src="{{ asset('image/event' . $eventData->event_id . '.png') }}"
                            alt="Event {{ $eventData->event_id }}"
                            class="event-image"
                            onerror="this.src='https://via.placeholder.com/400x400/14b8a6/ffffff?text=Event'">
                        <div class="event-info">
                            <h1>{{ $eventData->event_name}}</h1>
                            <div class="event-meta">
                                <div class="meta-item">
                                    <span>📅</span>
                                    <span>{{ \Carbon\Carbon::parse($eventData->eventDetail->date)->format('M-d-Y') }}
                                </div>
                                <div class="meta-item">
                                    <span>🕐</span>
                                    {{ \Carbon\Carbon::parse($eventData->eventDetail->date)->format('D') }}
                                    •
                                    {{ \Carbon\Carbon::parse($eventData->eventDetail->date)->format('h:ia') }}</span>
                                </div>
                                <div class="meta-item">
                                    <span>📍</span>
                                    <span>{{ $eventData->eventDetail->event_address }}</span>
                                </div>
                                <div class="meta-item">
                                    <span>🎤</span>
                                    <span>Speaker: {{ $eventData->eventDetail->event_speaker }}</span>
                                </div>
                                <div class="meta-item">
                                    <span>🏷️</span>Seminar</span>
                                </div>
                            </div>
                            <div class="event-price">
                                Rp {{ number_format($eventData->eventDetail->cost, 2, ',', '.') }}
                            </div>
                        </div>
                    </div>
                    <div class="event-description">
                        <h3>About This Event</h3>
                        <p>{{ $eventData->eventDetail->event_description }}</p>
                    </div>
                </div>

                <!-- Booking Form -->
                <div class="booking-form-card">
                    <h2 class="form-title">Book Your Seat</h2>
                    <form id="bookingForm" action="{{ route('payment.process') }}" method="POST">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $eventData->event_id}}">
                        <input type="hidden" name="event_name" value="{{ $eventData->event_name}}">
                        <input type="hidden" name="event_cost" value="{{ $eventData->eventDetail->cost }}">
                        <input type="hidden" name="paid_status" value="{{ $eventData->eventDetail->paid_status }}">

                        <div class="form-group">
                            <label for="fullName">Full Name</label>
                            <input type="text" id="fullName" name="fullName" required placeholder="Enter your full name"
                                value="{{ old('fullName') }}">
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" required placeholder="Enter your email address"
                                value="{{ old('email') }}">
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" required placeholder="Enter your phone number"
                                value="{{ old('phone') }}">
                        </div>
                        @if(!$eventData->eventDetail->paid_status)
                        <button type="submit" class="btn-proceed">Book Now</button>
                        @else
                        <button type="submit" class="btn-proceed">Proceed to Payment</button>
                        @endif
                    </form>
                </div>
            </div>
        </section>
    @else
        <!-- Original Homepage Content -->
        <!-- Enhanced Search Section -->
        <div class="search-section">
            <div class="container">
                <div class="search-wrapper">
                    <div class="search-container">
                        <span class="search-icon-left">🔍</span>
                        <input type="text" class="search-input" id="mainSearch"
                            placeholder="Search for events, seminars, workshops...">
                        <button class="search-btn">
                            <span>Search</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hero Banner -->
        <section class="hero-banner">
            <div class="container hero-content">
                <h1>Get more benefit now!<br>with Seminar !!</h1>
            </div>
        </section>

        <!-- Menu Options -->
        <section class="menu-options">
            <div class="container">
                <div class="section-header">
                    <h2>Menu Options</h2>
                    <a href="#" class="view-all" id="toggleViewAll">View All</a>
                </div>
                <div class="cards-wrapper">
                    <button class="scroll-btn left" id="btnLeft">&#10094;</button>
                    <div id="cardsGrid" class="cards-grid"> 
                        @foreach($openRegisterEvent as $event) 
                        <div class="event-card">
                           <img src="{{ asset('image/event' . $event->event_id . '.png') }}"
                            alt="Event {{ $event->event_id }}"
                            onerror="this.src='https://via.placeholder.com/400x320/14b8a6/ffffff?text=Event+Image'">

                          <div class="card-overlay">
                            <a href="{{ route('event.booking', ['eventId' => $event->event_id]) }}" class="card-btn">
                                Register Now
                            </a>
                        </div>

                        </div>
                        @endforeach

                        @foreach($comingSoonEvent as $event)
                            <div class="event-card">
                                <img src="{{ asset('image/event' . $event->event_id . '.png') }}"
                                    onerror="this.src='https://via.placeholder.com/400x320/6b7280/ffffff?text=AI+Forum'">
                                <div class="card-overlay">
                                    <button class="card-btn disabled">Coming Soon</button>
                                </div>
                            </div>

                        @endforeach
                    </div>
                    <button class="scroll-btn right" id="btnRight">&#10095;</button>

                </div>
            </div>
        </section>

        <!-- Recent Events -->
        <section class="recent-events">
            <div class="container">
                <div class="section-header">
                    <h2>Our Recent Events</h2>
                </div>

                <div class="filter-controls">
                    <div class="search-filter">
                        <span class="icon-left">🔍</span>
                        <input type="text" class="search-filter-input" id="eventSearch" placeholder="Search events...">
                        <span class="icon-right" id="clearSearch">✕</span>
                    </div>

                    <div class="filter-dropdown">
                        <button class="filter-btn" id="filterBtn">
                            <span class="emoji"></span>
                            <span>Filter Events</span>
                        </button>
                        <div class="filter-menu" id="filterMenu">
                            <label>
                                <input type="checkbox" value="seminar" class="filter-checkbox"> Seminar
                            </label>
                            <label>
                                <input type="checkbox" value="workshop" class="filter-checkbox"> Workshop
                            </label>
                            <label>
                                <input type="checkbox" value="malang" class="filter-checkbox"> Kota Malang
                            </label>
                            <label>
                                <input type="checkbox" value="surabaya" class="filter-checkbox"> Kota Surabaya
                            </label>
                        </div>
                    </div>

                    <div class="filter-tags" id="filterTags"></div>
                </div>

                <div class="events-list" id="eventsList">
                    @foreach($recentEvent as $event)
                        <div class="event-item disabled" data-type="seminar" data-city="surabaya"
                            data-title="{{$event->event_name}}" data-speaker="Joko Susilo" data-price="Rp 75.000"
                            data-description="Sesi pelatihan mengenai cara memaksimalkan potensi diri dan tampil percaya diri dalam setiap situasi, baik personal maupun profesional. **Event sudah penuh.**">
                           <img src="{{ asset('image/event' . $event->event_id . '.png') }}"
                            alt="Event {{ $event->event_id }}"
                            class="event-thumb"
                            onerror="this.src='https://via.placeholder.com/120x120/6b7280/ffffff?text=Event'">
                            <div class="event-info">
                                <h3>{{ \Carbon\Carbon::parse($event->eventDetail->date)->format('M d Y') }}</h3>
                                <p class="event-time">
                                    🕐 {{ \Carbon\Carbon::parse($event->eventDetail->date)->format('D') }}
                                    •
                                    {{ \Carbon\Carbon::parse($event->eventDetail->date)->format('h:ia') }}
                                </p>
                                <p class="event-title">{{$event->event_name}}</p>
                                <p class="event-location">📍 {{$event->eventDetail->event_address}}</p>
                            </div>
                            <div class="event-actions">
                                <button class="btn-book disabled">Show More</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection

@push('scripts')
    <script>
        //function button scroller Menu Option

        const grid = document.getElementById("cardsGrid");
        const scrollArea = document.getElementById('scrollArea');
        const btnLeft = document.getElementById('btnLeft');
        const btnRight = document.getElementById('btnRight');
        const toggleBtn = document.getElementById("toggleViewAll");
        const cardWidth = 260 + 16; // width + gap
        const scrollStep = cardWidth * 2; // geser 2 kartu tiap klik

        btnLeft.addEventListener("click", () => {
            grid.scrollBy({
                left: -300,
                behavior: 'smooth'
            });
        });

        btnRight.addEventListener("click", () => {
            grid.scrollBy({
                left: 300,
                behavior: 'smooth'
            });
        });

        toggleBtn.addEventListener("click", function (e) {
            e.preventDefault();

            if (grid.classList.contains("cards-grid")) {
                // Replace cards-grid → cards-grid-all
                grid.classList.replace("cards-grid", "cards-grid-all");
                toggleBtn.textContent = "View Less";
                btnLeft.style.display = "none";
                btnRight.style.display = "none";

            } else {
                // Replace cards-grid-all → cards-grid
                grid.classList.replace("cards-grid-all", "cards-grid");
                toggleBtn.textContent = "View All";
                btnLeft.style.display = "block";
                btnRight.style.display = "block";
            }
        });

        function updateButtons() {
            btnLeft.style.display = grid.scrollLeft <= 10 ? "none" : "block";
            btnRight.style.display =
                grid.scrollLeft + grid.clientWidth >= grid.scrollWidth - 10
                    ? "none"
                    : "block";
        }

        // Function to select payment method
        function selectPayment(method) {
            document.querySelectorAll('.payment-option').forEach(option => {
                option.classList.remove('selected');
            });
            document.getElementById(method).closest('.payment-option').classList.add('selected');
            document.getElementById(method).checked = true;
        }

        // Only run homepage scripts if not on booking page
        @if(!isset($isBookingPage) || !$isBookingPage)
            // Inisialisasi Elemen
            const searchInput = document.getElementById('eventSearch');
            const mainSearch = document.getElementById('mainSearch');
            const clearSearch = document.getElementById('clearSearch');
            const filterCheckboxes = document.querySelectorAll('.filter-checkbox');
            const eventItems = document.querySelectorAll('.event-item');
            const filterTags = document.getElementById('filterTags');

            // --- 1. Logika Toggle Dropdown Filter ---
            const filterBtn = document.getElementById('filterBtn');
            const filterMenu = document.getElementById('filterMenu');

            if (filterBtn && filterMenu) {
                filterBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    filterMenu.classList.toggle('active');
                    filterBtn.classList.toggle('active');
                });

                document.addEventListener('click', () => {
                    filterMenu.classList.remove('active');
                    filterBtn.classList.remove('active');
                });

                filterMenu.addEventListener('click', (e) => {
                    e.stopPropagation();
                });
            }

            // --- 2. Logika Search dan Filter Tags ---
            if (clearSearch && searchInput) {
                clearSearch.addEventListener('click', () => {
                    searchInput.value = '';
                    filterEvents();
                });

                searchInput.addEventListener('input', () => {
                    clearSearch.style.display = searchInput.value ? 'block' : 'none';
                    filterEvents();
                });
            }

            // Sync main search with filter search
            if (mainSearch && searchInput) {
                mainSearch.addEventListener('input', () => {
                    searchInput.value = mainSearch.value;
                    filterEvents();
                });
            }

            function updateFilterTags() {
                if (!filterTags) return;

                filterTags.innerHTML = '';

                filterCheckboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        const tag = document.createElement('div');
                        tag.className = 'filter-tag';
                        tag.innerHTML = `
                                                                                        ${checkbox.value}
                                                                                        <span class="remove" data-value="${checkbox.value}">✕</span>
                                                                                        `;
                        filterTags.appendChild(tag);
                    }
                });

                // Add click handlers to remove tags
                document.querySelectorAll('.filter-tag .remove').forEach(btn => {
                    btn.addEventListener('click', () => {
                        const value = btn.dataset.value;
                        const checkbox = Array.from(filterCheckboxes).find(cb => cb.value === value);
                        if (checkbox) {
                            checkbox.checked = false;
                            updateFilterTags();
                            filterEvents();
                        }
                    });
                });
            }

            // Listener untuk filter checkboxes
            filterCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', () => {
                    updateFilterTags();
                    filterEvents();
                });
            });

            // --- 3. Fungsi Filter Events ---
            function filterEvents() {
                if (!searchInput) return;

                const searchTerm = searchInput.value.toLowerCase();
                const selectedFilters = {
                    type: [],
                    city: []
                };

                // Ambil filter yang dipilih
                filterCheckboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        if (checkbox.value === 'seminar' || checkbox.value === 'workshop') {
                            selectedFilters.type.push(checkbox.value);
                        } else {
                            selectedFilters.city.push(checkbox.value);
                        }
                    }
                });

                // Iterasi melalui semua event item dan terapkan filter
                eventItems.forEach(item => {
                    const itemType = item.dataset.type;
                    const itemCity = item.dataset.city;
                    const itemTitle = item.dataset.title.toLowerCase();

                    // 1. Cek Pencarian
                    const matchesSearch = itemTitle.includes(searchTerm);

                    // 2. Cek Filter Tipe
                    const matchesType = selectedFilters.type.length === 0 || selectedFilters.type.includes(itemType);

                    // 3. Cek Filter Kota
                    const matchesCity = selectedFilters.city.length === 0 || selectedFilters.city.includes(itemCity);

                    // Tampilkan/Sembunyikan Item
                    if (matchesSearch && matchesType && matchesCity) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }

            // Panggil filterEvents saat halaman dimuat pertama kali untuk inisialisasi
            filterEvents();
            grid.addEventListener("scroll", updateButtons);
            updateButtons();
        @endif
    </script>
@endpush