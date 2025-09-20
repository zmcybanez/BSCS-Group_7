<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @if(isset($pageType) && $pageType === 'myQuestions')
            My Questions - Farm Guide
        @else
            Farm Guide Dashboard
        @endif
    </title>
    <link rel="icon" type="image/png" href="{{ asset('logo2.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: #333;
            line-height: 1.6;
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, #2d5016 0%, #4a7c23 100%);
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-left {
            display: flex;
            align-items: center;
        }

        .nav-left a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: white;
        }

        .logo {
            height: 40px;
            margin-right: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        .nav-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            background: linear-gradient(45deg, #90c695, #ffffff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .nav-button {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.3);
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 25px;
            cursor: pointer;
            font-size: 0.9rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .nav-button:hover {
            background: rgba(255,255,255,0.2);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .nav-button.logout {
            background: rgba(215,48,39,0.2);
            border-color: rgba(215,48,39,0.5);
        }

        .nav-button.logout:hover {
            background: #d73027;
        }

        /* Search Container */
        .search-container {
            position: relative;
            max-width: 400px;
            margin-right: 1rem;
            min-width: 200px;
        }

        .search-bar {
            width: 100%;
            padding: 0.8rem 1.2rem 0.8rem 3rem;
            border: 2px solid rgba(255,255,255,0.2);
            border-radius: 25px;
            background: rgba(255,255,255,0.1);
            color: white;
            font-size: 0.95rem;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            outline: none;
        }

        .search-bar:focus {
            background: rgba(255,255,255,0.9);
            color: #333;
            border-color: #90c695;
        }

        .search-bar::placeholder {
            color: rgba(255,255,255,0.7);
        }

        .search-bar:focus::placeholder {
            color: #888;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.7);
            transition: color 0.3s ease;
            pointer-events: none;
        }

        .search-container:focus-within .search-icon {
            color: #4a7c23;
        }

        /* Search Dropdown */
        .search-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.15);
            z-index: 1000;
            display: none;
            max-height: 300px;
            overflow-y: auto;
        }

        .search-dropdown-header {
            padding: 1rem;
            border-bottom: 1px solid #e1e5e9;
            font-weight: 600;
            color: #333;
            background: #f8f9fa;
            border-radius: 10px 10px 0 0;
        }

        /* Secondary Navbar */
        .secondary-navbar {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            padding: 1rem 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0,0,0,0.06);
            position: sticky;
            top: 0;
            z-index: 999;
            flex-wrap: wrap;
        }

        .secondary-navbar .nav-button {
            background: #ffffff;
            border: 1px solid rgba(77, 124, 35, 0.15);
            color: #4a7c23;
            padding: 0.7rem 1.5rem;
            border-radius: 30px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            transition: all 0.3s ease;
            position: relative;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            min-width: 120px;
            justify-content: center;
            white-space: nowrap;
        }

        .secondary-navbar .nav-button:hover {
            background: rgba(77, 124, 35, 0.08);
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.12);
            border-color: rgba(77, 124, 35, 0.3);
        }

        .secondary-navbar .nav-button.active {
            background: rgba(77, 124, 35, 0.12);
            border-color: rgba(77, 124, 35, 0.4);
            color: #2d5016;
            font-weight: 700;
        }

        .secondary-navbar .nav-button i {
            font-size: 0.9rem;
        }

        /* Container */
        .container {
            max-width: 1400px;
            margin: 1rem auto;
            padding: 2rem 2rem 0 2rem;
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }

        /* Welcome Section */
        .welcome-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            padding: 2.5rem;
            border-radius: 16px;
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            position: relative;
            overflow: hidden;
        }

        .welcome-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4a7c23, #90c695, #4a7c23);
        }

        .welcome-card h1 {
            color: #2d5016;
            font-size: 2.2rem;
            margin-bottom: 0.8rem;
            font-weight: 700;
        }

        .welcome-card p {
            color: #666;
            font-size: 1.2rem;
        }

        /* Cards */
        .card {
            background: rgba(255,255,255,0.95);
            padding: 2rem;
            border-radius: 16px;
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.15);
        }

        .card h2 {
            color: #2d5016;
            font-size: 1.4rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            font-weight: 700;
        }

        .card h2 i {
            color: #4a7c23;
            font-size: 1.2rem;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.8rem;
            font-weight: 600;
            color: #333;
            font-size: 1rem;
        }

        input, textarea, select {
            width: 100%;
            padding: 1rem;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            font-family: inherit;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #fafbfc;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #4a7c23;
            box-shadow: 0 0 0 4px rgba(74, 124, 35, 0.1);
            background: white;
        }

        .btn {
            background: linear-gradient(135deg, #4a7c23 0%, #2d5016 100%);
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(74, 124, 35, 0.3);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(74, 124, 35, 0.4);
        }

        /* Posts */
        .post {
            padding: 1.8rem 0;
            border-bottom: 1px solid #f0f0f0;
            transition: all 0.3s ease;
        }

        .post:hover {
            background: rgba(74, 124, 35, 0.02);
            margin: 0 -1rem;
            padding: 1.8rem 1rem;
            border-radius: 12px;
        }

        .post:last-child {
            border-bottom: none;
        }

        .post-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2d5016;
            margin-bottom: 0.8rem;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .post-title:hover {
            color: #4a7c23;
        }

        .post-content {
            color: #666;
            margin-bottom: 1rem;
            line-height: 1.6;
        }

        .post-meta {
            display: flex;
            gap: 1.5rem;
            font-size: 0.9rem;
            color: #888;
            flex-wrap: wrap;
        }

        .post-meta span {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.3rem 0.8rem;
            background: rgba(74, 124, 35, 0.1);
            border-radius: 20px;
            transition: background 0.3s ease;
        }

        .post-meta span:hover {
            background: rgba(74, 124, 35, 0.15);
        }

        /* Post Images */
        .post-images {
            display: flex;
            gap: 0.5rem;
            margin: 1rem 0;
            flex-wrap: wrap;
        }

        .post-image {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 12px;
            border: 2px solid rgba(74, 124, 35, 0.2);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .post-image:hover {
            transform: scale(1.05);
            border-color: rgba(74, 124, 35, 0.4);
            box-shadow: 0 4px 16px rgba(74, 124, 35, 0.2);
        }

        .post-image:first-child:nth-last-child(1) {
            width: 200px;
            height: 150px;
        }

        .post-image:first-child:nth-last-child(2),
        .post-image:first-child:nth-last-child(2) ~ .post-image {
            width: 150px;
            height: 120px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: #888;
        }

        .empty-state h3 {
            color: #666;
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: #999;
            font-size: 1rem;
        }

        /* Alert Messages */
        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 8px;
            border-left: 4px solid;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #4a7c23;
            color: #2d5016;
        }

        .alert-error {
            background-color: #f8d7da;
            border-color: #dc3545;
            color: #721c24;
        }

        .alert ul {
            margin: 0;
            padding-left: 1.2rem;
        }

        .alert li {
            margin-bottom: 0.25rem;
        }

        /* Sidebar */
        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .sidebar-card {
            background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 12px 40px rgba(0,0,0,0.08), 0 4px 16px rgba(0,0,0,0.04);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.3);
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
            overflow: hidden;
        }

        .sidebar-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #4a7c23, #90c695, #4a7c23);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .sidebar-card:hover::before {
            transform: scaleX(1);
        }

        .sidebar-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 60px rgba(0,0,0,0.12), 0 8px 24px rgba(0,0,0,0.08);
        }

        .sidebar-card h3 {
            color: #2d5016;
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            font-weight: 700;
            position: relative;
        }

        .sidebar-card h3::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 2px;
            background: linear-gradient(90deg, #4a7c23, #90c695);
            border-radius: 1px;
        }

        .sidebar-card h3 i {
            color: #4a7c23;
            font-size: 1.1rem;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(74, 124, 35, 0.1), rgba(144, 198, 149, 0.1));
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .sidebar-card:hover h3 i {
            background: linear-gradient(135deg, rgba(74, 124, 35, 0.2), rgba(144, 198, 149, 0.2));
            transform: scale(1.1);
        }

        .sidebar-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .sidebar-list li {
            margin-bottom: 0;
        }

        .sidebar-list a {
            color: #555;
            text-decoration: none;
            padding: 1rem 1.2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            font-size: 0.95rem;
            font-weight: 500;
            position: relative;
            overflow: hidden;
            border: 1px solid transparent;
        }

        .sidebar-list a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(74, 124, 35, 0.05), transparent);
            transition: left 0.5s ease;
        }

        .sidebar-list a:hover::before {
            left: 100%;
        }

        .sidebar-list a:hover {
            background: linear-gradient(135deg, rgba(74, 124, 35, 0.08), rgba(144, 198, 149, 0.08));
            color: #2d5016;
            transform: translateX(8px);
            border-color: rgba(74, 124, 35, 0.2);
            box-shadow: 0 4px 12px rgba(74, 124, 35, 0.15);
        }

        .sidebar-list a i {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .sidebar-list a:hover i {
            background: linear-gradient(135deg, #4a7c23, #90c695);
            color: white;
            transform: rotate(5deg) scale(1.1);
        }

        /* Advanced Quick Actions Styling */
        .sidebar-card:last-child {
            background: linear-gradient(145deg, #f8f9fa 0%, #ffffff 100%);
        }

        .sidebar-card:last-child .sidebar-list a {
            position: relative;
        }

        .sidebar-card:last-child .sidebar-list a[onclick*="coming soon"] {
            opacity: 0.7;
        }

        .sidebar-card:last-child .sidebar-list a[onclick*="coming soon"]::after {
            content: 'Soon';
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: linear-gradient(135deg, #ffc107, #ff9800);
            color: white;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 0.2rem 0.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(255, 193, 7, 0.3);
        }

        /* Friends and Chat Sidebar Styles */
        .friend-avatar-small {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4a7c23, #90c695);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 0.8rem;
            margin-right: 0.8rem;
            flex-shrink: 0;
        }

        .friend-avatar-small img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .friend-info {
            display: flex;
            flex-direction: column;
            flex: 1;
            min-width: 0;
        }

        .friend-info strong {
            color: #2d5016;
            font-size: 0.9rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .friend-info small {
            color: #666;
            font-size: 0.75rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .unread-dot {
            width: 8px;
            height: 8px;
            background: #dc3545;
            border-radius: 50%;
            margin-left: 0.5rem;
            flex-shrink: 0;
        }

        /* DARK MODE */
        body.dark-mode {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            color: #e0e0e0;
        }

        body.dark-mode .navbar {
            background: linear-gradient(135deg, #0f1a0a 0%, #1a2e0f 100%);
        }

        body.dark-mode .search-bar {
            background: rgba(45, 45, 45, 0.8);
            border-color: rgba(144, 198, 149, 0.3);
            color: #e0e0e0;
        }

        body.dark-mode .search-bar::placeholder {
            color: rgba(224, 224, 224, 0.6);
        }

        body.dark-mode .search-bar:focus {
            background: rgba(45, 45, 45, 0.95);
            border-color: #90c695;
            color: #e0e0e0;
        }

        body.dark-mode .search-bar:focus::placeholder {
            color: rgba(224, 224, 224, 0.4);
        }

        body.dark-mode .search-icon {
            color: rgba(144, 198, 149, 0.7);
        }

        body.dark-mode .search-container:focus-within .search-icon {
            color: #90c695;
        }

        body.dark-mode .search-dropdown {
            background: #2d2d2d;
            border-color: rgba(144, 198, 149, 0.3);
        }

        body.dark-mode .search-dropdown-header {
            background: #3d3d3d;
            color: #90c695;
            border-bottom-color: rgba(144, 198, 149, 0.2);
        }

        body.dark-mode .card,
        body.dark-mode .welcome-card,
        body.dark-mode .sidebar-card {
            background: linear-gradient(145deg, #1e293b 0%, #334155 100%);
            border: 1px solid rgba(148, 163, 184, 0.1);
            box-shadow: 0 12px 40px rgba(0,0,0,0.3), 0 4px 16px rgba(0,0,0,0.2);
            color: #f0f0f0;
        }

        body.dark-mode .sidebar-card:hover {
            box-shadow: 0 20px 60px rgba(0,0,0,0.4), 0 8px 24px rgba(0,0,0,0.3);
        }

        body.dark-mode .sidebar-card h3 {
            color: #e2e8f0;
        }

        body.dark-mode .sidebar-card h3::after {
            background: linear-gradient(90deg, #90c695, #4a7c23);
        }

        body.dark-mode .sidebar-card h3 i {
            color: #90c695;
            background: linear-gradient(135deg, rgba(144, 198, 149, 0.15), rgba(74, 124, 35, 0.15));
        }

        body.dark-mode .sidebar-card:hover h3 i {
            background: linear-gradient(135deg, rgba(144, 198, 149, 0.25), rgba(74, 124, 35, 0.25));
        }

        body.dark-mode .sidebar-list a {
            color: #cbd5e1;
        }

        body.dark-mode .sidebar-list a:hover {
            background: linear-gradient(135deg, rgba(144, 198, 149, 0.12), rgba(74, 124, 35, 0.12));
            color: #e2e8f0;
            border-color: rgba(144, 198, 149, 0.25);
            box-shadow: 0 4px 12px rgba(144, 198, 149, 0.2);
        }

        body.dark-mode .sidebar-list a i {
            background: linear-gradient(135deg, #374151, #475569);
            color: #94a3b8;
        }

        body.dark-mode .sidebar-list a:hover i {
            background: linear-gradient(135deg, #90c695, #4a7c23);
            color: white;
        }

        /* Dark mode for second card */
        body.dark-mode .sidebar-card:last-child {
            background: linear-gradient(145deg, #334155 0%, #1e293b 100%);
        }

        body.dark-mode .sidebar-card:last-child .sidebar-list a[onclick*="coming soon"]::after {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            box-shadow: 0 2px 4px rgba(245, 158, 11, 0.4);
        }

        body.dark-mode input,
        body.dark-mode textarea,
        body.dark-mode select {
            background: #3d3d3d;
            border-color: #555;
            color: #f0f0f0;
        }

        body.dark-mode .post-title,
        body.dark-mode h1,
        body.dark-mode h2,
        body.dark-mode h3 {
            color: #a5d6aa;
        }

        body.dark-mode .post-content {
            color: #e0e0e0;
        }

        body.dark-mode .post-image {
            border-color: rgba(144, 198, 149, 0.3);
        }

        body.dark-mode .post-image:hover {
            border-color: rgba(144, 198, 149, 0.6);
            box-shadow: 0 4px 16px rgba(144, 198, 149, 0.3);
        }

        body.dark-mode .alert-success {
            background-color: rgba(144, 198, 149, 0.2);
            border-color: #90c695;
            color: #a5d6aa;
        }

        body.dark-mode .alert-error {
            background-color: rgba(220, 53, 69, 0.2);
            border-color: #dc3545;
            color: #f8d7da;
        }

        body.dark-mode p,
        body.dark-mode .form-label,
        body.dark-mode label,
        body.dark-mode span {
            color: #e0e0e0;
        }

        body.dark-mode .secondary-navbar {
            background: linear-gradient(135deg, #2d2d2d 0%, #1a1a1a 100%);
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        body.dark-mode .secondary-navbar .nav-button {
            background: #3d3d3d;
            border-color: rgba(144, 198, 149, 0.3);
            color: #90c695;
        }

        body.dark-mode .secondary-navbar .nav-button:hover {
            background: rgba(144, 198, 149, 0.15);
            border-color: rgba(144, 198, 149, 0.5);
        }

        body.dark-mode .secondary-navbar .nav-button.active {
            background: rgba(144, 198, 149, 0.25);
            border-color: rgba(144, 198, 149, 0.6);
            color: #a5d6aa;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
                padding: 0 1rem;
            }

            .navbar {
                padding: 1rem;
                flex-direction: column;
                gap: 1rem;
            }

            .nav-right {
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .nav-button span {
                display: none;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card, .sidebar-card {
            animation: fadeInUp 0.6s ease forwards;
        }

        .card:nth-child(2) { animation-delay: 0.1s; }
        .card:nth-child(3) { animation-delay: 0.2s; }
        .sidebar-card:nth-child(1) { animation-delay: 0.3s; }
        .sidebar-card:nth-child(2) { animation-delay: 0.4s; }
    </style>
</head>
<body>

    <!-- FIXED NAVBAR -->
    <nav class="navbar">
        <div class="nav-left">
            <a href="{{ url('/dashboard') }}">
                <img src="{{ asset('logo2.png') }}" alt="Farm Guide Logo" class="logo">
                <span class="nav-title">Farm Guide</span>
            </a>
        </div>

        <div class="nav-right">
            <!-- Search Bar moved to nav-right -->
            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-bar" id="searchInput" placeholder="Search farmers, topics, or questions...">

                <!-- Search Dropdown -->
                <div class="search-dropdown" id="searchDropdown">
                    <div class="search-dropdown-header">Farmers & Experts</div>
                    <div id="searchDropdownResults">
                        <!-- Search results will be populated here -->
                    </div>
                </div>
            </div>

            @auth
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-button logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            @endauth
        </div>
    </nav>

    <!-- Secondary Navbar -->
    <div class="secondary-navbar">
        <a href="{{ url('/dashboard') }}" class="nav-button active">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>
        <button id="darkModeToggle" class="nav-button">
            <i class="fas fa-moon"></i>
            <span>Dark Mode</span>
        </button>
        <a href="{{ route('friends') }}" class="nav-button">
            <i class="fas fa-users"></i>
            <span>Friends</span>
        </a>
        <a href="{{ url('/profile') }}" class="nav-button">
            <i class="fas fa-user"></i>
            <span>Profile</span>
        </a>
    </div>

    <div class="container">
        <div class="main-content">
            <!-- Welcome -->
            <div class="welcome-card">
                <h1>Welcome, {{ Auth::user()->name }}!</h1>
                <p>Connect with experts across all agricultural sectors - from traditional farming to modern aquaponics and everything in between.</p>
            </div>

            <!-- Ask Question Form -->
            <div class="card">
                <h2><i class="fas fa-question-circle"></i> Ask a Question</h2>

                @if($errors->any())
                    <div class="alert alert-error">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Your Question</label>
                        <input type="text" name="title" placeholder="What agricultural challenge can we help you solve?" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Details</label>
                        <textarea name="content" rows="4" placeholder="Provide specific details about your farming situation, location, current methods, or any other relevant information..." required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Add Photos (Optional - Max 5 photos, 5MB each)</label>
                        <input type="file" name="images[]" accept="image/*" multiple>
                        <small style="color: #666; font-size: 0.85rem;">You can select up to 5 photos (JPG, PNG, GIF). Maximum 5MB per photo.</small>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Category</label>
                        <select name="category" required>
                            <option value="">Choose your agricultural focus</option>
                            <option value="Aeroponics & Aquaponics">Aeroponics & Aquaponics</option>
                            <option value="Hydroponics">Hydroponics</option>
                            <option value="Azolla Farming">Azolla Farming</option>
                            <option value="Bangus and Tilapia Farming">Bangus and Tilapia Farming</option>
                            <option value="Cacao Production">Cacao Production</option>
                            <option value="Catfish Production">Catfish Production</option>
                            <option value="Chicken and Layer Poultry">Chicken and Layer Poultry</option>
                            <option value="Dragon Fruit Farming">Dragon Fruit Farming</option>
                            <option value="Duck Farming">Duck Farming</option>
                            <option value="Goat Production">Goat Production</option>
                            <option value="Herbs and Spices">Herbs and Spices</option>
                            <option value="Hog and Cattle Raising">Hog and Cattle Raising</option>
                            <option value="Horticulture">Horticulture</option>
                            <option value="Landscaping">Landscaping</option>
                            <option value="Mais Production">Mais Production</option>
                            <option value="Moringa">Moringa</option>
                            <option value="Mushroom Farming">Mushroom Farming</option>
                            <option value="Rabbit Production">Rabbit Production</option>
                            <option value="Shrimp Production">Shrimp Production</option>
                            <option value="Vegetables and Fruits">Vegetables and Fruits</option>
                            <option value="Vermiculture">Vermiculture</option>
                            <option value="Vermicomposting">Vermicomposting</option>
                            <option value="Equipment & Tools">Equipment & Tools</option>
                            <option value="Soil & Fertilizer">Soil & Fertilizer</option>
                            <option value="Weather & Climate">Weather & Climate</option>
                            <option value="General Farming">General Farming</option>
                        </select>
                    </div>
                    <button type="submit" class="btn">
                        <i class="fas fa-paper-plane"></i>
                        Ask Question
                    </button>
                </form>
            </div>

            <!-- Recent Questions -->
            <div class="card">
                <h2><i class="fas fa-comments"></i>
                    @if(isset($pageType) && $pageType === 'myQuestions')
                        My Questions
                    @else
                        Recent Questions
                    @endif
                </h2>

                @if(isset($pageType) && $pageType === 'myQuestions')
                    <p style="margin-bottom: 1rem; font-style: italic;" class="my-questions-info">
                        <i class="fas fa-info-circle"></i> Showing only questions you've posted
                    </p>
                @endif

                @if($posts->count() > 0)
                    @foreach($posts as $post)
                    <div class="post">
                        <h3 class="post-title">{{ $post->title }}</h3>
                        <p class="post-content">{{ Str::limit($post->content, 200) }}</p>

                        @if($post->imgSrc)
                            <div class="post-images">
                                @php
                                    $images = is_string($post->imgSrc) ? json_decode($post->imgSrc, true) : [$post->imgSrc];
                                    if (!is_array($images)) $images = [$post->imgSrc];
                                @endphp
                                @foreach($images as $image)
                                    @if($image)
                                    <img src="{{ asset('storage/' . $image) }}" alt="Post image" class="post-image">
                                    @endif
                                @endforeach
                            </div>
                        @endif

                        <div class="post-meta">
                            <span><i class="fas fa-tag"></i> {{ $post->category->name ?? 'General' }}</span>
                            <span><i class="fas fa-user"></i> {{ $post->user->name }}</span>
                            <span><i class="fas fa-comments"></i> {{ $post->comments->count() }} {{ $post->comments->count() == 1 ? 'answer' : 'answers' }}</span>
                            <span><i class="fas fa-clock"></i> {{ $post->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <p><i class="fas fa-comments" style="font-size: 3rem; color: #ccc; margin-bottom: 1rem;"></i></p>
                        <h3>No questions yet</h3>
                        <p>Be the first to ask a question and get help from the farming community!</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Browse Topics -->
            <div class="sidebar-card">
                <h3><i class="fas fa-list"></i> Browse Topics</h3>
                <ul class="sidebar-list">
                    <li><a href="{{ route('topics.show', 'aeroponics-aquaponics') }}"><i class="fas fa-microscope"></i> Aeroponics & Aquaponics</a></li>
                    <li><a href="{{ route('topics.show', 'aquaculture-systems') }}"><i class="fas fa-fish"></i> Aquaculture Systems</a></li>
                    <li><a href="{{ route('topics.show', 'azolla-farming') }}"><i class="fas fa-seedling"></i> Azolla Farming</a></li>
                    <li><a href="{{ route('topics.show', 'poultry-production') }}"><i class="fas fa-egg"></i> Poultry Production</a></li>
                    <li><a href="{{ route('topics.show', 'cacao-cash-crops') }}"><i class="fas fa-coffee"></i> Cacao & Cash Crops</a></li>
                    <li><a href="{{ route('topics.show', 'dragon-fruit-exotics') }}"><i class="fas fa-carrot"></i> Dragon Fruit & Exotics</a></li>
                    <li><a href="{{ route('topics.show', 'mushroom-cultivation') }}"><i class="fas fa-mountain"></i> Mushroom Cultivation</a></li>
                    <li><a href="{{ route('topics.show', 'vermiculture-systems') }}"><i class="fas fa-bug"></i> Vermiculture Systems</a></li>
                </ul>
            </div>

            <!-- Quick Actions -->
            <div class="sidebar-card">
                <h3><i class="fas fa-link"></i> Quick Actions</h3>
                <ul class="sidebar-list">
                    <li><a href="{{ route('profile.edit') }}"><i class="fas fa-user"></i> My Profile</a></li>
                    <li><a href="{{ route('my-questions') }}"><i class="fas fa-bookmark"></i> My Questions</a></li>
                    <li><a href="{{ route('friends') }}"><i class="fas fa-users"></i> Friends & Network</a></li>
                    <li><a href="#" onclick="alert('Feature coming soon!')"><i class="fas fa-heart"></i> Saved Answers</a></li>
                    <li><a href="#" onclick="alert('Feature coming soon!')"><i class="fas fa-calendar"></i> Farm Calendar</a></li>
                    <li><a href="#" onclick="alert('Feature coming soon!')"><i class="fas fa-chart-line"></i> Market Prices</a></li>
                </ul>
            </div>

            <!-- Recent Friends -->
            @if($recentFriends->count() > 0)
            <div class="sidebar-card">
                <h3><i class="fas fa-user-friends"></i> Recent Friends</h3>
                <ul class="sidebar-list">
                    @foreach($recentFriends as $friend)
                    <li>
                        <a href="{{ route('friends') }}">
                            <div class="friend-avatar-small">
                                @if($friend->profile_picture)
                                    <img src="{{ asset('storage/' . $friend->profile_picture) }}" alt="{{ $friend->name }}">
                                @else
                                    {{ strtoupper(substr($friend->name, 0, 1)) }}{{ strtoupper(substr(explode(' ', $friend->name)[1] ?? '', 0, 1)) }}
                                @endif
                            </div>
                            <span class="friend-info">
                                <strong>{{ $friend->name }}</strong>
                                <small>{{ $friend->farm_type ?? 'Agricultural Enthusiast' }}</small>
                            </span>
                        </a>
                    </li>
                    @endforeach
                    @if($recentFriends->count() >= 5)
                    <li><a href="{{ route('friends') }}"><i class="fas fa-plus"></i> View All Friends</a></li>
                    @endif
                </ul>
            </div>
            @endif

            <!-- Recent Chats -->
            @if($recentChats->count() > 0)
            <div class="sidebar-card">
                <h3><i class="fas fa-comments"></i> Recent Chats</h3>
                <ul class="sidebar-list">
                    @foreach($recentChats as $chat)
                    @php
                        $chatPartner = $chat->sender_id == Auth::id() ? $chat->receiver : $chat->sender;
                    @endphp
                    <li>
                        <a href="{{ route('friends') }}#chat-list">
                            <div class="friend-avatar-small">
                                @if($chatPartner->profile_picture)
                                    <img src="{{ asset('storage/' . $chatPartner->profile_picture) }}" alt="{{ $chatPartner->name }}">
                                @else
                                    {{ strtoupper(substr($chatPartner->name, 0, 1)) }}{{ strtoupper(substr(explode(' ', $chatPartner->name)[1] ?? '', 0, 1)) }}
                                @endif
                            </div>
                            <span class="friend-info">
                                <strong>{{ $chatPartner->name }}</strong>
                                <small>{{ Str::limit($chat->message, 30) }}</small>
                            </span>
                            @if(!$chat->is_read && $chat->receiver_id == Auth::id())
                                <div class="unread-dot"></div>
                            @endif
                        </a>
                    </li>
                    @endforeach
                    <li><a href="{{ route('friends') }}#chat-list"><i class="fas fa-plus"></i> View All Chats</a></li>
                </ul>
            </div>
            @endif
        </div>
    </div>

    <script>
        const darkModeToggle = document.getElementById('darkModeToggle');
        const body = document.body;

        // Load saved preference
        if (localStorage.getItem('darkMode') === 'true') {
            body.classList.add('dark-mode');
            darkModeToggle.innerHTML = '<i class="fas fa-sun"></i> <span>Light Mode</span>';
        }

        darkModeToggle.addEventListener('click', function() {
            body.classList.toggle('dark-mode');

            if (body.classList.contains('dark-mode')) {
                localStorage.setItem('darkMode', 'true');
                this.innerHTML = '<i class="fas fa-sun"></i> <span>Light Mode</span>';
            } else {
                localStorage.setItem('darkMode', 'false');
                this.innerHTML = '<i class="fas fa-moon"></i> <span>Dark Mode</span>';
            }
        });

        // Add smooth scrolling for internal links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // File upload validation and feedback
        const imageInput = document.getElementById('images');
        if (imageInput) {
            imageInput.addEventListener('change', function(e) {
                const files = Array.from(e.target.files);
                const maxFiles = 5;
                const maxSizeBytes = 5 * 1024 * 1024; // 5MB in bytes
                let valid = true;
                let errorMessage = '';

                // Check number of files
                if (files.length > maxFiles) {
                    errorMessage = `You can only upload up to ${maxFiles} images.`;
                    valid = false;
                }

                // Check file sizes and types
                if (valid) {
                    for (let file of files) {
                        if (file.size > maxSizeBytes) {
                            errorMessage = `Each image must be smaller than 5MB. "${file.name}" is too large.`;
                            valid = false;
                            break;
                        }

                        if (!file.type.startsWith('image/')) {
                            errorMessage = `Only image files are allowed. "${file.name}" is not an image.`;
                            valid = false;
                            break;
                        }
                    }
                }

                // Show feedback
                const existingError = document.querySelector('.file-upload-error');
                if (existingError) {
                    existingError.remove();
                }

                if (!valid) {
                    // Clear the input
                    e.target.value = '';

                    // Show error message
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'file-upload-error text-red-600 dark:text-red-400 text-sm mt-2';
                    errorDiv.textContent = errorMessage;
                    e.target.parentNode.appendChild(errorDiv);
                } else if (files.length > 0) {
                    // Show success message
                    const successDiv = document.createElement('div');
                    successDiv.className = 'file-upload-error text-green-600 dark:text-green-400 text-sm mt-2';
                    successDiv.textContent = `${files.length} image${files.length > 1 ? 's' : ''} selected successfully.`;
                    e.target.parentNode.appendChild(successDiv);
                }
            });
        }
    </script>
</body>
</html>
