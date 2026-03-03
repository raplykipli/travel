<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keys Tour & Travel</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=DM+Sans:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --red: #C8102E;
            --red-dark: #9B0B23;
            --red-light: #E8203E;
            --cream: #FFF9F5;
            --dark: #1A0A0D;
            --gray: #6B6B6B;
            --border: #F0E8E8;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #fff;
            color: var(--dark);
            overflow-x: hidden;
        }

        /* SCROLLBAR */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #fff;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--red);
            border-radius: 3px;
        }

        /* PAGE SYSTEM */
        .page {
            display: none;
        }

        .page.active {
            display: block;
        }

        /* WHATSAPP FLOAT */
        .wa-float {
            position: fixed;
            bottom: 28px;
            right: 28px;
            background: #25D366;
            color: white;
            padding: 14px 22px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            box-shadow: 0 8px 30px rgba(37, 211, 102, 0.4);
            z-index: 1000;
            transition: all 0.3s;
        }

        .wa-float:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 40px rgba(37, 211, 102, 0.5);
        }

        .wa-float svg {
            width: 22px;
            height: 22px;
            fill: white;
        }

        /* NAVBAR */
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 100;
            transition: all 0.4s;
            padding: 20px 0;
        }

        nav.scrolled {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(20px);
            padding: 14px 0;
            box-shadow: 0 2px 30px rgba(0, 0, 0, 0.08);
        }

        nav.scrolled .nav-logo-text {
            color: var(--dark);
        }

        nav.scrolled .nav-links a {
            color: var(--dark);
        }

        nav.scrolled .nav-cta {
            background: var(--red) !important;
            color: white !important;
        }

        .nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            text-decoration: none;
        }

        .nav-logo-icon {
            width: 40px;
            height: 40px;
            background: var(--red);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-family: 'Playfair Display', serif;
            font-weight: 900;
            font-size: 20px;
        }

        .nav-logo-text {
            font-weight: 600;
            font-size: 17px;
            color: white;
            letter-spacing: -0.3px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 36px;
            list-style: none;
        }

        .nav-links a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: color 0.2s;
        }

        .nav-links a:hover {
            color: white;
        }

        .nav-cta {
            background: white;
            color: var(--red);
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s;
        }

        .nav-cta:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        /* HERO */
        .hero {
            height: 100vh;
            min-height: 700px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=1920&q=80');
            background-size: cover;
            background-position: center;
            transform: scale(1.05);
            animation: heroZoom 20s ease-in-out infinite alternate;
        }

        @keyframes heroZoom {
            from {
                transform: scale(1.05);
            }

            to {
                transform: scale(1.12);
            }
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(26, 10, 13, 0.75) 0%, rgba(200, 16, 46, 0.35) 100%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 0 24px;
            max-width: 900px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 28px;
            letter-spacing: 0.5px;
        }

        .hero-badge span {
            width: 6px;
            height: 6px;
            background: #ff6b6b;
            border-radius: 50%;
            display: inline-block;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.4;
            }
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(48px, 7vw, 88px);
            font-weight: 900;
            color: white;
            line-height: 1.05;
            margin-bottom: 22px;
            letter-spacing: -2px;
        }

        .hero-title em {
            font-style: italic;
            color: #FFB3B3;
        }

        .hero-sub {
            color: rgba(255, 255, 255, 0.82);
            font-size: clamp(16px, 2vw, 20px);
            margin-bottom: 44px;
            font-weight: 300;
            line-height: 1.6;
        }

        .hero-btns {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-primary {
            background: var(--red);
            color: white;
            padding: 16px 36px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 15px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            box-shadow: 0 8px 30px rgba(200, 16, 46, 0.4);
        }

        .btn-primary:hover {
            background: var(--red-dark);
            transform: translateY(-2px);
            box-shadow: 0 14px 40px rgba(200, 16, 46, 0.5);
        }

        .btn-outline {
            background: transparent;
            color: white;
            padding: 16px 36px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 15px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 2px solid rgba(255, 255, 255, 0.5);
            transition: all 0.3s;
            cursor: pointer;
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: white;
        }

        .hero-stats {
            position: absolute;
            bottom: 48px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 0;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            overflow: hidden;
            z-index: 2;
        }

        .hero-stat {
            padding: 18px 32px;
            text-align: center;
            color: white;
            border-right: 1px solid rgba(255, 255, 255, 0.15);
        }

        .hero-stat:last-child {
            border-right: none;
        }

        .hero-stat-num {
            font-family: 'Playfair Display', serif;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 3px;
        }

        .hero-stat-label {
            font-size: 12px;
            opacity: 0.75;
            font-weight: 400;
        }

        /* SEARCH BAR */
        .search-section {
            max-width: 860px;
            margin: -30px auto 0;
            padding: 0 24px;
            position: relative;
            z-index: 10;
        }

        .search-card {
            background: white;
            border-radius: 20px;
            padding: 24px 28px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            gap: 16px;
            align-items: end;
        }

        .search-field label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 8px;
        }

        .search-field select,
        .search-field input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--border);
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: var(--dark);
            outline: none;
            transition: border-color 0.2s;
            background: white;
        }

        .search-field select:focus,
        .search-field input:focus {
            border-color: var(--red);
        }

        .search-btn {
            background: var(--red);
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s;
            white-space: nowrap;
        }

        .search-btn:hover {
            background: var(--red-dark);
            transform: translateY(-1px);
        }

        /* SECTION BASE */
        section {
            padding: 100px 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 40px;
        }

        .section-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 700;
            color: var(--red);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 16px;
        }

        .section-label::before {
            content: '';
            width: 20px;
            height: 2px;
            background: var(--red);
            display: inline-block;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(32px, 4vw, 52px);
            font-weight: 800;
            color: var(--dark);
            line-height: 1.15;
            letter-spacing: -1px;
            margin-bottom: 16px;
        }

        .section-title span {
            color: var(--red);
            font-style: italic;
        }

        .section-sub {
            color: var(--gray);
            font-size: 16px;
            line-height: 1.7;
            max-width: 500px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 56px;
            gap: 24px;
        }

        /* CATEGORIES */
        .categories-section {
            background: var(--cream);
            padding: 70px 0;
        }

        .categories-grid {
            display: flex;
            gap: 16px;
            overflow-x: auto;
            padding-bottom: 8px;
            scrollbar-width: none;
        }

        .categories-grid::-webkit-scrollbar {
            display: none;
        }

        .cat-card {
            flex: 0 0 auto;
            padding: 16px 28px;
            border-radius: 50px;
            border: 2px solid var(--border);
            background: white;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
            font-size: 14px;
            white-space: nowrap;
        }

        .cat-card:hover,
        .cat-card.active {
            background: var(--red);
            color: white;
            border-color: var(--red);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(200, 16, 46, 0.25);
        }

        .cat-card .cat-icon {
            font-size: 20px;
        }

        /* PACKAGES GRID */
        .packages-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
        }

        .pkg-card {
            border-radius: 20px;
            overflow: hidden;
            background: white;
            border: 1px solid var(--border);
            transition: all 0.35s;
            cursor: pointer;
        }

        .pkg-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.12);
        }

        .pkg-img {
            height: 220px;
            overflow: hidden;
            position: relative;
        }

        .pkg-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .pkg-card:hover .pkg-img img {
            transform: scale(1.08);
        }

        .pkg-badge {
            position: absolute;
            top: 16px;
            left: 16px;
            background: var(--red);
            color: white;
            padding: 5px 14px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
        }

        .pkg-badge.popular {
            background: #FF6B35;
        }

        .pkg-fav {
            position: absolute;
            top: 16px;
            right: 16px;
            width: 36px;
            height: 36px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .pkg-fav:hover {
            transform: scale(1.2);
        }

        .pkg-body {
            padding: 22px 24px 24px;
        }

        .pkg-rating {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 10px;
        }

        .stars {
            color: #FFB800;
            font-size: 13px;
        }

        .rating-num {
            font-size: 13px;
            font-weight: 600;
        }

        .review-count {
            font-size: 12px;
            color: var(--gray);
        }

        .pkg-name {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--dark);
        }

        .pkg-meta {
            display: flex;
            gap: 16px;
            margin-bottom: 16px;
        }

        .pkg-meta-item {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 13px;
            color: var(--gray);
        }

        .pkg-desc {
            font-size: 13px;
            color: var(--gray);
            line-height: 1.6;
            margin-bottom: 20px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .pkg-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 18px;
            border-top: 1px solid var(--border);
        }

        .pkg-price-label {
            font-size: 11px;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .pkg-price {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--red);
        }

        .pkg-price-per {
            font-size: 11px;
            color: var(--gray);
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
        }

        .pkg-btn {
            background: var(--cream);
            color: var(--red);
            border: 2px solid var(--border);
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .pkg-btn:hover {
            background: var(--red);
            color: white;
            border-color: var(--red);
        }

        .view-all {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--red);
            font-weight: 600;
            font-size: 15px;
            text-decoration: none;
            cursor: pointer;
            transition: gap 0.2s;
        }

        .view-all:hover {
            gap: 12px;
        }

        /* WHY US */
        .whyus-section {
            background: var(--dark);
            position: relative;
            overflow: hidden;
        }

        .whyus-section::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(200, 16, 46, 0.15) 0%, transparent 70%);
        }

        .whyus-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
        }

        .whyus-left .section-title {
            color: white;
        }

        .whyus-left .section-sub {
            color: rgba(255, 255, 255, 0.6);
        }

        .whyus-features {
            margin-top: 48px;
            display: flex;
            flex-direction: column;
            gap: 28px;
        }

        .whyus-feat {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }

        .whyus-feat-icon {
            width: 52px;
            height: 52px;
            background: rgba(200, 16, 46, 0.15);
            border: 1px solid rgba(200, 16, 46, 0.3);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .whyus-feat-text h4 {
            color: white;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .whyus-feat-text p {
            color: rgba(255, 255, 255, 0.55);
            font-size: 13px;
            line-height: 1.6;
        }

        .whyus-right {
            position: relative;
        }

        .whyus-img-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .whyus-img {
            border-radius: 16px;
            overflow: hidden;
            aspect-ratio: 3/4;
        }

        .whyus-img:first-child {
            margin-top: 40px;
        }

        .whyus-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .whyus-numbers {
            position: absolute;
            bottom: -20px;
            left: -20px;
            background: var(--red);
            color: white;
            padding: 24px 28px;
            border-radius: 20px;
            text-align: center;
        }

        .whyus-num {
            font-family: 'Playfair Display', serif;
            font-size: 38px;
            font-weight: 700;
            line-height: 1;
        }

        .whyus-num-label {
            font-size: 12px;
            margin-top: 4px;
            opacity: 0.85;
        }

        /* TESTIMONIALS */
        .testimonials-section {
            background: var(--cream);
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .testi-card {
            background: white;
            border-radius: 20px;
            padding: 28px;
            border: 1px solid var(--border);
            transition: all 0.3s;
        }

        .testi-card:hover {
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.08);
            transform: translateY(-4px);
        }

        .testi-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 18px;
        }

        .testi-user {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .testi-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
        }

        .testi-name {
            font-weight: 600;
            font-size: 15px;
            margin-bottom: 2px;
        }

        .testi-dest {
            font-size: 12px;
            color: var(--red);
            font-weight: 500;
        }

        .testi-quote-icon {
            color: var(--red);
            font-size: 32px;
            line-height: 1;
            opacity: 0.3;
            font-family: Georgia, serif;
        }

        .testi-text {
            font-size: 14px;
            color: var(--gray);
            line-height: 1.7;
            margin-bottom: 18px;
        }

        .testi-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .testi-stars {
            color: #FFB800;
            font-size: 14px;
        }

        .testi-trip {
            font-size: 12px;
            color: var(--gray);
        }

        /* CONTACT CTA */
        .cta-section {
            background: linear-gradient(135deg, var(--red) 0%, var(--red-dark) 100%);
            position: relative;
            overflow: hidden;
            padding: 100px 0;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -10%;
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .cta-section::after {
            content: '';
            position: absolute;
            bottom: -30%;
            right: -5%;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.04);
            border-radius: 50%;
        }

        .cta-inner {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 700px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .cta-inner .section-label {
            color: rgba(255, 255, 255, 0.7);
        }

        .cta-inner .section-label::before {
            background: rgba(255, 255, 255, 0.7);
        }

        .cta-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(36px, 5vw, 60px);
            font-weight: 800;
            color: white;
            line-height: 1.1;
            margin-bottom: 20px;
            letter-spacing: -1px;
        }

        .cta-sub {
            color: rgba(255, 255, 255, 0.8);
            font-size: 17px;
            margin-bottom: 44px;
        }

        .cta-btns {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .cta-btn-wa {
            background: white;
            color: var(--red);
            padding: 16px 36px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 15px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .cta-btn-wa:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 40px rgba(0, 0, 0, 0.3);
        }

        .cta-btn-tel {
            background: transparent;
            color: white;
            padding: 16px 36px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 15px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border: 2px solid rgba(255, 255, 255, 0.5);
            transition: all 0.3s;
        }

        .cta-btn-tel:hover {
            border-color: white;
            background: rgba(255, 255, 255, 0.1);
        }

        /* FOOTER */
        footer {
            background: var(--dark);
            color: white;
            padding: 70px 0 32px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 48px;
            margin-bottom: 60px;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
        }

        .footer-logo-icon {
            width: 40px;
            height: 40px;
            background: var(--red);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Playfair Display', serif;
            font-weight: 900;
            font-size: 20px;
        }

        .footer-logo-name {
            font-weight: 600;
            font-size: 17px;
        }

        .footer-desc {
            color: rgba(255, 255, 255, 0.5);
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 24px;
        }

        .footer-social {
            display: flex;
            gap: 12px;
        }

        .social-btn {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.2s;
            text-decoration: none;
        }

        .social-btn:hover {
            background: var(--red);
        }

        .footer-col h5 {
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
            color: rgba(255, 255, 255, 0.9);
        }

        .footer-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.5);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: white;
        }

        .footer-contact-item {
            display: flex;
            gap: 12px;
            margin-bottom: 16px;
            align-items: flex-start;
        }

        .footer-contact-icon {
            font-size: 16px;
            margin-top: 1px;
        }

        .footer-contact-text {
            color: rgba(255, 255, 255, 0.5);
            font-size: 13px;
            line-height: 1.6;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding-top: 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-bottom p {
            color: rgba(255, 255, 255, 0.35);
            font-size: 13px;
        }

        /* DETAIL PAGE */
        .detail-nav {
            background: white;
            border-bottom: 1px solid var(--border);
            padding: 16px 0;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .detail-nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 40px;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .back-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--gray);
            background: none;
            border: none;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.2s;
            padding: 0;
        }

        .back-btn:hover {
            color: var(--red);
        }

        .detail-breadcrumb {
            font-size: 13px;
            color: var(--gray);
        }

        .detail-breadcrumb span {
            color: var(--dark);
            font-weight: 500;
        }

        .detail-hero {
            height: 480px;
            position: relative;
            overflow: hidden;
        }

        .detail-hero img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .detail-hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7) 0%, transparent 60%);
        }

        .detail-hero-content {
            position: absolute;
            bottom: 48px;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 1200px;
            padding: 0 40px;
            color: white;
        }

        .detail-hero-content h1 {
            font-family: 'Playfair Display', serif;
            font-size: 52px;
            font-weight: 800;
            margin-bottom: 16px;
            letter-spacing: -1px;
        }

        .detail-tags {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .detail-tag {
            padding: 7px 18px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
        }

        .detail-tag.red {
            background: var(--red);
        }

        .detail-tag.glass {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .detail-layout {
            max-width: 1200px;
            margin: 0 auto;
            padding: 60px 40px;
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 48px;
            align-items: start;
        }

        .detail-section {
            margin-bottom: 44px;
        }

        .detail-section-title {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .detail-section-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .detail-highlights {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .detail-highlight {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            background: var(--cream);
            border-radius: 12px;
            font-size: 14px;
            color: var(--dark);
        }

        .detail-highlight::before {
            content: '✓';
            width: 24px;
            height: 24px;
            background: var(--red);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .itinerary-list {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .itin-item {
            display: flex;
            gap: 20px;
            position: relative;
        }

        .itin-item:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 19px;
            top: 48px;
            bottom: 0;
            width: 2px;
            background: var(--border);
        }

        .itin-num {
            width: 40px;
            height: 40px;
            background: var(--red);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 15px;
            flex-shrink: 0;
            z-index: 1;
        }

        .itin-text {
            padding: 8px 0 32px;
        }

        .itin-day {
            font-weight: 700;
            font-size: 15px;
            margin-bottom: 6px;
            color: var(--dark);
        }

        .itin-act {
            font-size: 14px;
            color: var(--gray);
            line-height: 1.6;
        }

        .includes-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .include-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            color: var(--dark);
        }

        .include-icon {
            color: #22C55E;
            font-size: 16px;
        }

        /* SIDEBAR */
        .booking-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 24px;
            overflow: hidden;
            position: sticky;
            top: 80px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        }

        .booking-card-header {
            background: linear-gradient(135deg, var(--red), var(--red-dark));
            padding: 28px;
            color: white;
            text-align: center;
        }

        .booking-card-from {
            font-size: 12px;
            opacity: 0.8;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .booking-card-price {
            font-family: 'Playfair Display', serif;
            font-size: 40px;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 4px;
        }

        .booking-card-per {
            font-size: 13px;
            opacity: 0.75;
        }

        .booking-card-body {
            padding: 24px;
        }

        .booking-action {
            display: block;
            width: 100%;
            padding: 15px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 15px;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            margin-bottom: 12px;
            transition: all 0.3s;
            border: none;
            font-family: 'DM Sans', sans-serif;
        }

        .booking-action.wa {
            background: #25D366;
            color: white;
        }

        .booking-action.wa:hover {
            background: #1EB756;
        }

        .booking-action.main {
            background: var(--red);
            color: white;
        }

        .booking-action.main:hover {
            background: var(--red-dark);
        }

        .booking-includes {
            padding: 24px;
            border-top: 1px solid var(--border);
        }

        .booking-includes h4 {
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 16px;
        }

        .booking-inc-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
            font-size: 13px;
            color: var(--dark);
        }

        .booking-inc-icon {
            color: #22C55E;
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .packages-grid {
                grid-template-columns: 1fr 1fr;
            }

            .testimonials-grid {
                grid-template-columns: 1fr;
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }

            .whyus-grid {
                grid-template-columns: 1fr;
            }

            .whyus-img-grid {
                display: none;
            }

            .detail-layout {
                grid-template-columns: 1fr;
            }

            .search-card {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            .packages-grid {
                grid-template-columns: 1fr;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }

            .hero-stats {
                display: none;
            }

            .nav-links {
                display: none;
            }

            .detail-highlights {
                grid-template-columns: 1fr;
            }

            .includes-list {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <!-- WA Float -->
    <a href="https://wa.me/628164912570" target="_blank" class="wa-float">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
            <path
                d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.122 1.531 5.856L.057 23.886a.5.5 0 00.611.635l6.218-1.63A11.934 11.934 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.885 0-3.655-.498-5.19-1.369l-.37-.218-3.832 1.005.959-3.728-.24-.386A9.96 9.96 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z" />
        </svg>
        Chat Kami
    </a>

    <!-- ======= HOME PAGE ======= -->
    <div id="home-page" class="page active">

        <!-- NAV -->
        <nav id="navbar">
            <div class="nav-inner">
                <a class="nav-logo" onclick="showPage('home')" href="#">
                    <div class="nav-logo-icon">K</div>
                    <span class="nav-logo-text">Keys Tour & Travel</span>
                </a>
                <ul class="nav-links">
                    <li><a href="#paket" onclick="smoothScroll('paket')">Paket Wisata</a></li>
                    <li><a href="#layanan" onclick="smoothScroll('layanan')">Layanan</a></li>
                    <li><a href="#testimoni" onclick="smoothScroll('testimoni')">Testimoni</a></li>
                    <li><a href="#kontak" onclick="smoothScroll('kontak')">Kontak</a></li>
                </ul>
                <a href="https://wa.me/628164912570" target="_blank" class="nav-cta">Hubungi Kami</a>
            </div>
        </nav>

        <!-- HERO -->
        <section class="hero" id="home">
            <div class="hero-bg"></div>
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <div class="hero-badge">
                    <span></span>
                    Melayani wisata seluruh Indonesia
                </div>
                <h1 class="hero-title">
                    Jelajahi <em>Keindahan</em><br>Nusantara
                </h1>
                <p class="hero-sub">Bersama Keys Tour & Travel, setiap perjalanan<br>menjadi kenangan yang tak
                    terlupakan.</p>
                <div class="hero-btns">
                    <a href="#paket" onclick="smoothScroll('paket')" class="btn-primary">
                        🗺️ Lihat Paket Wisata
                    </a>
                    <a href="https://wa.me/628164912570" target="_blank" class="btn-outline">
                        💬 Konsultasi Gratis
                    </a>
                </div>
            </div>
            <div class="hero-stats">
                <div class="hero-stat">
                    <div class="hero-stat-num">500+</div>
                    <div class="hero-stat-label">Wisatawan Puas</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-num">15+</div>
                    <div class="hero-stat-label">Destinasi</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-num">4.9</div>
                    <div class="hero-stat-label">Rating Bintang</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-num">5+</div>
                    <div class="hero-stat-label">Tahun Pengalaman</div>
                </div>
            </div>
        </section>

        <!-- SEARCH -->
        <div class="search-section" id="paket">
            <div class="search-card">
                <div class="search-field">
                    <label>Destinasi</label>
                    <select>
                        <option>Semua Destinasi</option>
                        <option>Labuan Bajo</option>
                        <option>Bali</option>
                        <option>Yogyakarta</option>
                        <option>Bromo</option>
                        <option>Jawa Barat</option>
                        <option>Pangandaran</option>
                    </select>
                </div>
                <div class="search-field">
                    <label>Durasi</label>
                    <select>
                        <option>Semua Durasi</option>
                        <option>1-2 Hari</option>
                        <option>3-4 Hari</option>
                        <option>5+ Hari</option>
                    </select>
                </div>
                <button class="search-btn" onclick="smoothScroll('packages-grid-section')">🔍 Cari Paket</button>
            </div>
        </div>

        <!-- CATEGORIES -->
        <div class="categories-section" style="padding-top: 60px;">
            <div class="container">
                <div class="categories-grid">
                    <div class="cat-card active">
                        <span class="cat-icon">🗺️</span> Semua
                    </div>
                    <div class="cat-card">
                        <span class="cat-icon">🏖️</span> Pantai & Bahari
                    </div>
                    <div class="cat-card">
                        <span class="cat-icon">🏔️</span> Alam & Gunung
                    </div>
                    <div class="cat-card">
                        <span class="cat-icon">🏛️</span> Budaya & Sejarah
                    </div>
                    <div class="cat-card">
                        <span class="cat-icon">👨‍👩‍👧</span> Family Trip
                    </div>
                    <div class="cat-card">
                        <span class="cat-icon">💑</span> Honeymoon
                    </div>
                    <div class="cat-card">
                        <span class="cat-icon">🏢</span> Corporate
                    </div>
                </div>
            </div>
        </div>

        <!-- PACKAGES -->
        <section id="packages-grid-section" style="padding-top: 70px;">
            <div class="container">
                <div class="section-header">
                    <div>
                        <div class="section-label">Paket Wisata</div>
                        <h2 class="section-title">Destinasi <span>Terpopuler</span></h2>
                    </div>
                    <a class="view-all" onclick="smoothScroll('packages-grid-section')">Lihat Semua →</a>
                </div>
                <div class="packages-grid" id="packages-container"></div>
            </div>
        </section>

        <!-- WHY US -->
        <section class="whyus-section" id="layanan">
            <div class="container">
                <div class="whyus-grid">
                    <div class="whyus-left">
                        <div class="section-label" style="color: rgba(255,255,255,0.5);">
                            <span
                                style="display:inline-block;width:20px;height:2px;background:rgba(255,255,255,0.5);margin-right:8px;"></span>
                            Mengapa Kami
                        </div>
                        <h2 class="section-title" style="color:white;">Kenapa Pilih <span>Keys</span> Tour & Travel?
                        </h2>
                        <p class="section-sub" style="color:rgba(255,255,255,0.6);">Kami berkomitmen memberikan
                            pengalaman wisata terbaik dengan layanan profesional dan terpercaya.</p>
                        <div class="whyus-features">
                            <div class="whyus-feat">
                                <div class="whyus-feat-icon">✈️</div>
                                <div class="whyus-feat-text">
                                    <h4>Harga Terbaik & Transparan</h4>
                                    <p>Harga kompetitif tanpa biaya tersembunyi. Kami pastikan Anda mendapatkan nilai
                                        terbaik untuk setiap rupiah.</p>
                                </div>
                            </div>
                            <div class="whyus-feat">
                                <div class="whyus-feat-icon">🎯</div>
                                <div class="whyus-feat-text">
                                    <h4>Tour Guide Bersertifikat</h4>
                                    <p>Dipandu oleh guide profesional berpengalaman yang siap memastikan perjalanan Anda
                                        menyenangkan.</p>
                                </div>
                            </div>
                            <div class="whyus-feat">
                                <div class="whyus-feat-icon">🛡️</div>
                                <div class="whyus-feat-text">
                                    <h4>Asuransi Perjalanan Lengkap</h4>
                                    <p>Setiap perjalanan dilindungi asuransi komprehensif sehingga Anda bisa menikmati
                                        liburan dengan tenang.</p>
                                </div>
                            </div>
                            <div class="whyus-feat">
                                <div class="whyus-feat-icon">💯</div>
                                <div class="whyus-feat-text">
                                    <h4>Layanan 24 Jam</h4>
                                    <p>Tim kami siap membantu Anda kapanpun, sebelum, selama, hingga setelah perjalanan
                                        berlangsung.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="whyus-right">
                        <div class="whyus-img-grid">
                            <div class="whyus-img">
                                <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=600&q=80"
                                    alt="Labuan Bajo">
                            </div>
                            <div class="whyus-img" style="margin-top: -40px;">
                                <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=600&q=80"
                                    alt="Bali">
                            </div>
                        </div>
                        <div class="whyus-numbers">
                            <div class="whyus-num">500+</div>
                            <div class="whyus-num-label">Pelanggan Bahagia</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- TESTIMONIALS -->
        <section class="testimonials-section" id="testimoni">
            <div class="container">
                <div class="section-header">
                    <div>
                        <div class="section-label">Testimoni</div>
                        <h2 class="section-title">Kata Mereka yang <span>Sudah</span> Bersama Kami</h2>
                    </div>
                </div>
                <div class="testimonials-grid" id="testimonials-container"></div>
            </div>
        </section>

        <!-- CTA -->
        <section class="cta-section" id="kontak">
            <div class="cta-inner">
                <div class="section-label">Siap Berlibur?</div>
                <h2 class="cta-title">Rencanakan Perjalanan<br>Impian Anda Sekarang</h2>
                <p class="cta-sub">Konsultasikan kebutuhan wisata Anda dengan tim kami. Gratis tanpa biaya apapun!</p>
                <div class="cta-btns">
                    <a href="https://wa.me/628164912570?text=Halo Keys Tour, saya ingin tanya tentang paket wisata"
                        target="_blank" class="cta-btn-wa">
                        💬 Chat via WhatsApp
                    </a>
                    <a href="tel:+628164912570" class="cta-btn-tel">
                        📞 +62 816-4912-5700
                    </a>
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer>
            <div class="container">
                <div class="footer-grid">
                    <div>
                        <div class="footer-logo">
                            <div class="nav-logo-icon"
                                style="width:40px;height:40px;background:var(--red);border-radius:12px;display:flex;align-items:center;justify-content:center;font-family:'Playfair Display',serif;font-weight:900;font-size:20px;color:white;">
                                K</div>
                            <span class="footer-logo-name">Keys Tour & Travel</span>
                        </div>
                        <p class="footer-desc">Kami adalah mitra perjalanan wisata terpercaya Anda. Menghadirkan
                            pengalaman liburan tak terlupakan ke berbagai destinasi indah di Indonesia.</p>
                        <div class="footer-social">
                            <a class="social-btn" href="#">📘</a>
                            <a class="social-btn" href="#">📸</a>
                            <a class="social-btn" href="#">🐦</a>
                            <a class="social-btn" href="#">▶️</a>
                        </div>
                    </div>
                    <div>
                        <h5>Destinasi</h5>
                        <ul class="footer-links">
                            <li><a href="#">Labuan Bajo</a></li>
                            <li><a href="#">Bali</a></li>
                            <li><a href="#">Yogyakarta</a></li>
                            <li><a href="#">Bromo</a></li>
                            <li><a href="#">Pangandaran</a></li>
                        </ul>
                    </div>
                    <div>
                        <h5>Layanan</h5>
                        <ul class="footer-links">
                            <li><a href="#">Private Tour</a></li>
                            <li><a href="#">Group Tour</a></li>
                            <li><a href="#">Honeymoon Package</a></li>
                            <li><a href="#">Corporate Trip</a></li>
                            <li><a href="#">Airport Transfer</a></li>
                        </ul>
                    </div>
                    <div>
                        <h5>Kontak</h5>
                        <div class="footer-contact-item">
                            <span class="footer-contact-icon">📞</span>
                            <span class="footer-contact-text">+62 816-4912-5700</span>
                        </div>
                        <div class="footer-contact-item">
                            <span class="footer-contact-icon">✉️</span>
                            <span class="footer-contact-text">keystourandtravel@gmail.com</span>
                        </div>
                        <div class="footer-contact-item">
                            <span class="footer-contact-icon">📍</span>
                            <span class="footer-contact-text">JL.Caringin, Komp Perum The Greenhill BlokA11, Ngamprah,
                                Kab.Bandung Barat</span>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <p>© 2026 Keys Tour & Travel. All rights reserved.</p>
                    <p>Made with ❤️ in Bandung</p>
                </div>
            </div>
        </footer>

    </div>

    <!-- ======= DETAIL PAGE ======= -->
    <div id="detail-page" class="page">

        <div class="detail-nav">
            <div class="detail-nav-inner">
                <button class="back-btn" onclick="showPage('home')">
                    ← Kembali
                </button>
                <span style="color:var(--border);font-size:18px;">/</span>
                <div class="detail-breadcrumb">Paket Wisata › <span id="breadcrumb-title">Detail</span></div>
            </div>
        </div>

        <div id="detail-content"></div>

        <footer style="background:var(--dark);color:white;padding:40px 0;margin-top:80px;">
            <div class="container" style="text-align:center;">
                <p style="color:rgba(255,255,255,0.35);font-size:13px;">© 2026 Keys Tour & Travel. All rights reserved.
                </p>
            </div>
        </footer>

    </div>

    <script>
        // ===== DATA =====
        const packages = [{
                id: 1,
                name: "Labuan Bajo Explorer",
                category: "Pantai & Bahari",
                badge: "Terlaris",
                badgeClass: "popular",
                rating: 4.9,
                reviews: 124,
                description: "Jelajahi surga bahari Indonesia. Nikmati keindahan pulau-pulau eksotis, laut biru jernih, dan pengalaman yang tak terlupakan.",
                image: "https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=800&q=80",
                price: "Rp 5.500.000",
                duration: "4 Hari 3 Malam",
                highlights: ["Pulau Komodo - Melihat komodo di habitat aslinya",
                    "Pink Beach - Pantai pasir merah muda eksotis", "Pulau Padar - Pemandangan bukit ikonik",
                    "Snorkeling di Manta Point", "Sunset di Kalong Island"
                ],
                includes: ["Tiket Bus PP (Executive AC)", "Hotel bintang 4", "Kapal phinisi", "Makan 3x sehari",
                    "Tour guide profesional", "Peralatan snorkeling", "Tiket masuk wisata", "Dokumentasi foto"
                ],
                itinerary: [{
                        day: "Hari 1",
                        activity: "Tiba di Labuan Bajo · Check in hotel · City tour sore hari"
                    },
                    {
                        day: "Hari 2",
                        activity: "Pulau Komodo · Pink Beach · Manta Point snorkeling"
                    },
                    {
                        day: "Hari 3",
                        activity: "Pulau Padar sunrise · Kalong Island · Sunset cruise"
                    },
                    {
                        day: "Hari 4",
                        activity: "Free time · Check out"
                    }
                ]
            },
            {
                id: 2,
                name: "Bromo Adventure",
                category: "Alam & Gunung",
                badge: "Petualangan",
                badgeClass: "",
                rating: 4.8,
                reviews: 89,
                description: "Rasakan petualangan menakjubkan menikmati keindahan Gunung Bromo dan pemandangan spektakuler sunrise.",
                image: "https://images.unsplash.com/photo-1596422846543-75c6fc197f07?w=800&q=80",
                price: "Rp 2.800.000",
                duration: "3 Hari 2 Malam",
                highlights: ["Sunrise di Pananjakan", "Kawah Bromo", "Padang Savana", "Bukit Teletubbies",
                    "Pasir Berbisik"
                ],
                includes: ["Transportasi AC dari Surabaya", "Hotel bintang 3", "Jeep 4WD", "Makan 3x sehari",
                    "Tour guide", "Tiket masuk wisata", "Masker debu"
                ],
                itinerary: [{
                        day: "Hari 1",
                        activity: "Penjemputan Surabaya · Perjalanan ke Bromo · Check in"
                    },
                    {
                        day: "Hari 2",
                        activity: "Sunrise tour (03:00) · Kawah Bromo · Savana · Hotel"
                    },
                    {
                        day: "Hari 3",
                        activity: "Check out · Wisata sekitar · Kembali ke Surabaya"
                    }
                ]
            },
            {
                id: 3,
                name: "Jawa Barat Explorer",
                category: "Alam & Gunung",
                badge: "Lokal Favorite",
                badgeClass: "",
                rating: 4.7,
                reviews: 203,
                description: "Pesona alam dan budaya Jawa Barat dengan rute pilihan, fasilitas lengkap, dan pemandu profesional.",
                image: "https://images.unsplash.com/photo-1555400038-63f5ba517a47?w=800&q=80",
                price: "Rp 1.800.000",
                duration: "2 Hari 1 Malam",
                highlights: ["Kawah Putih Ciwidey", "Situ Patenggang", "Kebun Strawberry", "Glamping Lakeside",
                    "Floating Market Lembang"
                ],
                includes: ["Transportasi AC", "Penginapan glamping", "Makan 3x", "Tour guide", "Tiket masuk wisata",
                    "Dokumentasi"
                ],
                itinerary: [{
                        day: "Hari 1",
                        activity: "Bandung · Kawah Putih · Situ Patenggang · Glamping"
                    },
                    {
                        day: "Hari 2",
                        activity: "Strawberry farm · Floating Market · Kembali"
                    }
                ]
            },
            {
                id: 4,
                name: "Bali Paradise",
                category: "Budaya & Sejarah",
                badge: "Best Seller",
                badgeClass: "popular",
                rating: 4.9,
                reviews: 312,
                description: "Nikmati keindahan Pulau Dewata dengan paket lengkap termasuk hotel, transportasi, dan tour guide profesional.",
                image: "https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800&q=80",
                price: "Rp 4.200.000",
                duration: "5 Hari 4 Malam",
                highlights: ["Tanah Lot Temple", "Ubud Monkey Forest", "Tegalalang Rice Terrace", "Pantai Seminyak",
                    "Water sport Tanjung Benoa"
                ],
                includes: ["Tiket pesawat PP", "Hotel bintang 4", "Transportasi selama tour", "Makan 3x sehari",
                    "Tour guide", "Tiket masuk wisata", "Air mineral"
                ],
                itinerary: [{
                        day: "Hari 1",
                        activity: "Tiba di Ngurah Rai · Check in · Tanah Lot sunset"
                    },
                    {
                        day: "Hari 2",
                        activity: "Ubud tour · Monkey Forest · Tegalalang · Art Market"
                    },
                    {
                        day: "Hari 3",
                        activity: "Water sport · Pantai Pandawa · Uluwatu Temple"
                    },
                    {
                        day: "Hari 4",
                        activity: "Free program · Shopping · Spa optional"
                    },
                    {
                        day: "Hari 5",
                        activity: "Check out · Oleh-oleh · Transfer ke bandara"
                    }
                ]
            },
            {
                id: 5,
                name: "Yogyakarta Explorer",
                category: "Budaya & Sejarah",
                badge: "Budaya",
                badgeClass: "",
                rating: 4.8,
                reviews: 156,
                description: "Pengalaman wisata budaya dan alam Yogyakarta dengan destinasi ikonik dan pelayanan profesional.",
                image: "https://images.unsplash.com/photo-1591696331111-ef9586a5b17a?w=800&q=80",
                price: "Rp 2.500.000",
                duration: "3 Hari 2 Malam",
                highlights: ["Candi Borobudur", "Candi Prambanan", "Keraton Yogyakarta", "Malioboro",
                    "Pantai Parangtritis"
                ],
                includes: ["Hotel bintang 3", "Transportasi AC", "Makan 3x sehari", "Tour guide", "Tiket masuk wisata",
                    "Dokumentasi"
                ],
                itinerary: [{
                        day: "Hari 1",
                        activity: "Tiba di Yogya · Malioboro · Keraton · Check in"
                    },
                    {
                        day: "Hari 2",
                        activity: "Borobudur sunrise · Prambanan · Tebing Breksi"
                    },
                    {
                        day: "Hari 3",
                        activity: "Pantai Parangtritis · Oleh-oleh · Check out"
                    }
                ]
            },
            {
                id: 6,
                name: "Pangandaran Explorer",
                category: "Pantai & Bahari",
                badge: "Akhir Pekan",
                badgeClass: "",
                rating: 4.6,
                reviews: 78,
                description: "Nikmati keindahan pantai dan suasana alam Pangandaran dengan panorama laut dan aktivitas wisata berkesan.",
                image: "https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=800&q=80",
                price: "Rp 1.500.000",
                duration: "2 Hari 1 Malam",
                highlights: ["Pantai Pangandaran", "Green Canyon", "Body rafting", "Sunset di pantai barat",
                    "Seafood fresh"
                ],
                includes: ["Hotel tepi pantai", "Transportasi AC", "Makan 3x sehari", "Tour guide", "Tiket wisata",
                    "Peralatan body rafting"
                ],
                itinerary: [{
                        day: "Hari 1",
                        activity: "Bandung · Green Canyon · Body rafting · Check in"
                    },
                    {
                        day: "Hari 2",
                        activity: "Pantai Pangandaran · Seafood lunch · Kembali"
                    }
                ]
            }
        ];

        const testimonials = [{
                name: "Rina Kusuma",
                dest: "Bali Paradise",
                avatar: "https://i.pravatar.cc/100?img=1",
                text: "Luar biasa! Semua fasilitas sesuai ekspektasi. Guide-nya ramah dan sangat informatif. Pasti akan pesan lagi untuk liburan berikutnya!",
                rating: 5,
                trip: "April 2025"
            },
            {
                name: "Budi Santoso",
                dest: "Bromo Adventure",
                avatar: "https://i.pravatar.cc/100?img=3",
                text: "Pengalaman sunrise di Bromo benar-benar menakjubkan. Harga terjangkau, service bagus, dan perjalanan sangat well-organized. Highly recommended!",
                rating: 5,
                trip: "Maret 2025"
            },
            {
                name: "Dewi Anggraini",
                dest: "Labuan Bajo Explorer",
                avatar: "https://i.pravatar.cc/100?img=5",
                text: "Kapal phinisi-nya bersih dan nyaman. Spot snorkeling luar biasa. Tim Keys sangat profesional dan responsif dari awal hingga akhir perjalanan.",
                rating: 5,
                trip: "Mei 2025"
            }
        ];

        // ===== RENDER =====
        function renderPackages() {
            const container = document.getElementById('packages-container');
            packages.forEach(pkg => {
                const stars = '★'.repeat(Math.floor(pkg.rating)) + (pkg.rating % 1 ? '☆' : '');
                const card = document.createElement('div');
                card.className = 'pkg-card';
                card.onclick = () => showDetail(pkg.id);
                card.innerHTML = `
            <div class="pkg-img">
                <img src="${pkg.image}" alt="${pkg.name}" loading="lazy">
                <div class="pkg-badge ${pkg.badgeClass}">${pkg.badge}</div>
                <div class="pkg-fav">♡</div>
            </div>
            <div class="pkg-body">
                <div class="pkg-rating">
                    <span class="stars">${stars}</span>
                    <span class="rating-num">${pkg.rating}</span>
                    <span class="review-count">(${pkg.reviews} ulasan)</span>
                </div>
                <h3 class="pkg-name">${pkg.name}</h3>
                <div class="pkg-meta">
                    <div class="pkg-meta-item">⏱️ ${pkg.duration}</div>
                    <div class="pkg-meta-item">🗺️ ${pkg.category}</div>
                </div>
                <p class="pkg-desc">${pkg.description}</p>
                <div class="pkg-footer">
                    <div>
                        <div class="pkg-price-label">Mulai dari</div>
                        <span class="pkg-price">${pkg.price}</span>
                        <span class="pkg-price-per">/orang</span>
                    </div>
                    <button class="pkg-btn">Lihat Detail →</button>
                </div>
            </div>
        `;
                container.appendChild(card);
            });
        }

        function renderTestimonials() {
            const container = document.getElementById('testimonials-container');
            testimonials.forEach(t => {
                const card = document.createElement('div');
                card.className = 'testi-card';
                card.innerHTML = `
            <div class="testi-top">
                <div class="testi-user">
                    <img src="${t.avatar}" class="testi-avatar" alt="${t.name}">
                    <div>
                        <div class="testi-name">${t.name}</div>
                        <div class="testi-dest">${t.dest}</div>
                    </div>
                </div>
                <div class="testi-quote-icon">"</div>
            </div>
            <p class="testi-text">${t.text}</p>
            <div class="testi-bottom">
                <div class="testi-stars">${'★'.repeat(t.rating)}</div>
                <div class="testi-trip">🗓️ ${t.trip}</div>
            </div>
        `;
                container.appendChild(card);
            });
        }

        // ===== NAVIGATION =====
        function showPage(page) {
            document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
            document.getElementById(page + '-page').classList.add('active');
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function showDetail(id) {
            const pkg = packages.find(p => p.id === id);
            if (!pkg) return;

            document.getElementById('breadcrumb-title').textContent = pkg.name;

            const stars = '★'.repeat(Math.floor(pkg.rating)) + (pkg.rating % 1 ? '☆' : '');

            document.getElementById('detail-content').innerHTML = `
        <div class="detail-hero">
            <img src="${pkg.image}" alt="${pkg.name}">
            <div class="detail-hero-overlay"></div>
            <div class="detail-hero-content">
                <h1>${pkg.name}</h1>
                <div class="detail-tags">
                    <span class="detail-tag red">${pkg.price} / orang</span>
                    <span class="detail-tag glass">⏱️ ${pkg.duration}</span>
                    <span class="detail-tag glass">⭐ ${pkg.rating} (${pkg.reviews} ulasan)</span>
                </div>
            </div>
        </div>

        <div class="detail-layout">
            <div>
                <!-- Description -->
                <div class="detail-section">
                    <div class="detail-section-title">Tentang Paket Ini</div>
                    <p style="font-size:15px;color:var(--gray);line-height:1.8;">${pkg.description} Paket ini dirancang khusus untuk memberikan pengalaman perjalanan terbaik dengan fasilitas lengkap dan layanan profesional.</p>
                </div>

                <!-- Highlights -->
                <div class="detail-section">
                    <div class="detail-section-title">✨ Highlight Wisata</div>
                    <div class="detail-highlights">
                        ${pkg.highlights.map(h => `<div class="detail-highlight">${h}</div>`).join('')}
                    </div>
                </div>

                <!-- Itinerary -->
                <div class="detail-section">
                    <div class="detail-section-title">📅 Itinerary</div>
                    <div class="itinerary-list">
                        ${pkg.itinerary.map((item, i) => `
                                                <div class="itin-item">
                                                    <div class="itin-num">${i+1}</div>
                                                    <div class="itin-text">
                                                        <div class="itin-day">${item.day}</div>
                                                        <div class="itin-act">${item.activity}</div>
                                                    </div>
                                                </div>
                                            `).join('')}
                    </div>
                </div>

                <!-- Includes -->
                <div class="detail-section">
                    <div class="detail-section-title">📦 Sudah Termasuk</div>
                    <div class="includes-list">
                        ${pkg.includes.map(item => `
                                                <div class="include-item">
                                                    <span class="include-icon">✓</span>
                                                    <span>${item}</span>
                                                </div>
                                            `).join('')}
                    </div>
                </div>
            </div>

            <!-- SIDEBAR -->
            <div>
                <div class="booking-card">
                    <div class="booking-card-header">
                        <div class="booking-card-from">Mulai dari</div>
                        <div class="booking-card-price">${pkg.price}</div>
                        <div class="booking-card-per">per orang · ${pkg.duration}</div>
                    </div>
                    <div class="booking-card-body">
                        <a href="https://wa.me/628164912570?text=Halo, saya tertarik paket ${encodeURIComponent(pkg.name)}" target="_blank" class="booking-action wa">💬 Tanya via WhatsApp</a>
                        <a href="/form-pemesanan" class="booking-action main">  🎫 Pesan Sekarang </a>
                    </div>
                    <div class="booking-includes">
                        <h4>Sudah Termasuk:</h4>
                        ${pkg.includes.slice(0, 5).map(item => `
                                                <div class="booking-inc-item">
                                                    <span class="booking-inc-icon">✓</span>
                                                    <span>${item}</span>
                                                </div>
                                            `).join('')}
                        ${pkg.includes.length > 5 ? `<div style="font-size:13px;color:var(--red);font-weight:600;margin-top:8px;">+${pkg.includes.length - 5} lainnya...</div>` : ''}
                    </div>
                </div>
            </div>
        </div>
    `;

            showPage('detail');
        }

        // ===== SMOOTH SCROLL =====
        function smoothScroll(id) {
            setTimeout(() => {
                const el = document.getElementById(id) || document.querySelector('#' + id);
                if (el) el.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }, 100);
        }

        // ===== NAVBAR SCROLL =====
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (nav) {
                if (window.scrollY > 60) nav.classList.add('scrolled');
                else nav.classList.remove('scrolled');
            }
        });

        // ===== CATEGORY FILTER =====
        document.querySelectorAll('.cat-card').forEach(cat => {
            cat.addEventListener('click', function() {
                document.querySelectorAll('.cat-card').forEach(c => c.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // ===== INIT =====
        renderPackages();
        renderTestimonials();
    </script>
</body>

</html>
