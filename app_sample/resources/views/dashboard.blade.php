<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farm Guide Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('logo2.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            /* Light theme variables */
            --bg-color: #f5f7fa;
            --bg-gradient: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            --navbar-bg: linear-gradient(135deg, #2d5016 0%, #4a7c23 100%);
            --text-color: #333;
            --card-bg: rgba(255,255,255,0.95);
            --card-border: rgba(255,255,255,0.2);
            --card-shadow: rgba(0,0,0,0.1);
            --card-hover-shadow: rgba(0,0,0,0.15);
            --welcome-bg: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            --welcome-text: #2d5016;
            --welcome-subtext: #666;
            --search-bg: rgba(255,255,255,0.2);
            --search-text: #fff;
            --search-placeholder: rgba(255,255,255,0.7);
            --search-focus-bg: rgba(255,255,255,0.3);
            --search-icon: rgba(255,255,255,0.8);
            --heading-color: #2d5016;
            --subheading-color: #4a7c23;
            --input-bg: #fff;
            --input-border: #ddd;
            --input-text: #333;
            --secondary-navbar-bg: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            --secondary-nav-button-bg: #ffffff;
            --secondary-nav-button-border: rgba(77, 124, 35, 0.15);
            --secondary-nav-button-color: #4a7c23;
            --secondary-nav-button-hover-bg: rgba(77, 124, 35, 0.08);
            --secondary-nav-button-active-bg: rgba(77, 124, 35, 0.12);
            --secondary-nav-shadow: rgba(0,0,0,0.08);
            --post-border: #f0f0f0;
            --post-hover-bg: rgba(74, 124, 35, 0.02);
            --post-meta-bg: rgba(74, 124, 35, 0.1);
            --post-meta-hover-bg: rgba(74, 124, 35, 0.15);
            --empty-state-color: #888;
            --empty-state-heading: #666;
            --empty-state-text: #999;
            --empty-state-icon: #ccc;
            --search-dropdown-bg: white;
            --search-dropdown-border: #e1e5e9;
            --search-dropdown-header-bg: #f8f9fa;
            --search-dropdown-header-color: #333;
            --secondary-text: #666;
        }

        [data-theme="dark"] {
            /* Dark theme variables */
            --bg-color: #1a1a1a;
            --bg-gradient: linear-gradient(135deg, #1a1a1a 0%, #2d3748 100%);
            --navbar-bg: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
            --text-color: #e2e8f0;
            --card-bg: rgba(45, 55, 72, 0.9);
            --card-border: rgba(255,255,255,0.1);
            --card-shadow: rgba(0,0,0,0.3);
            --card-hover-shadow: rgba(0,0,0,0.4);
            --welcome-bg: linear-gradient(135deg, #2d3748 0%, #4a5568 100%);
            --welcome-text: #90c695;
            --welcome-subtext: #a0aec0;
            --search-bg: rgba(45, 55, 72, 0.6);
            --search-text: #e2e8f0;
            --search-placeholder: rgba(226, 232, 240, 0.7);
            --search-focus-bg: rgba(45, 55, 72, 0.8);
            --search-icon: rgba(226, 232, 240, 0.8);
            --heading-color: #90c695;
            --subheading-color: #a5d6aa;
            --input-bg: #2d3748;
            --input-border: #4a5568;
            --input-text: #e2e8f0;
            --secondary-navbar-bg: linear-gradient(135deg, #2d3748 0%, #4a5568 100%);
            --secondary-nav-button-bg: #4a5568;
            --secondary-nav-button-border: rgba(144, 198, 149, 0.2);
            --secondary-nav-button-color: #90c695;
            --secondary-nav-button-hover-bg: rgba(144, 198, 149, 0.15);
            --secondary-nav-button-active-bg: rgba(144, 198, 149, 0.25);
            --secondary-nav-shadow: rgba(0,0,0,0.3);
            --post-border: #4a5568;
            --post-hover-bg: rgba(144, 198, 149, 0.05);
            --post-meta-bg: rgba(144, 198, 149, 0.15);
            --post-meta-hover-bg: rgba(144, 198, 149, 0.25);
            --empty-state-color: #a0aec0;
            --empty-state-heading: #cbd5e0;
            --empty-state-text: #718096;
            --empty-state-icon: #4a5568;
            --search-dropdown-bg: #2d3748;
            --search-dropdown-border: #4a5568;
            --search-dropdown-header-bg: #4a5568;
            --search-dropdown-header-color: #e2e8f0;
            --secondary-text: #a0aec0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            background: var(--bg-gradient);
            color: var(--text-color);
            line-height: 1.6;
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background: var(--navbar-bg);
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

        /* Notifications Dropdown */
        .notifications-container {
            position: relative;
            display: inline-block;
        }

        .notifications-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15), 0 0 0 1px rgba(255,255,255,0.1);
            width: 350px;
            max-height: 450px;
            overflow: hidden;
            z-index: 1000;
            display: none;
            margin-top: 0.75rem;
            backdrop-filter: blur(25px);
            transform: translateY(-10px) scale(0.95);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .notifications-dropdown::before {
            content: '';
            position: absolute;
            top: -8px;
            right: 20px;
            width: 16px;
            height: 16px;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-bottom: none;
            border-right: none;
            transform: rotate(45deg);
            z-index: -1;
        }

        .notifications-dropdown.show {
            display: block;
            transform: translateY(0) scale(1);
            opacity: 1;
        }

        .notifications-header {
            padding: 1.25rem 1.75rem;
            border-bottom: 1px solid var(--card-border);
            font-weight: 700;
            color: var(--heading-color);
            font-size: 1.1rem;
            background: linear-gradient(135deg, var(--card-bg), rgba(74, 124, 35, 0.02));
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .notifications-header i {
            color: var(--subheading-color);
            font-size: 1.2rem;
        }

        .empty-notifications {
            text-align: center;
            padding: 3rem 2rem;
            color: var(--empty-state-text);
        }

        .empty-notifications i {
            font-size: 3rem;
            color: var(--empty-state-icon);
            margin-bottom: 1rem;
            opacity: 0.6;
        }

        .empty-notifications > div:first-child {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 0.6; }
            50% { opacity: 0.3; }
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
            background: var(--search-bg);
            color: var(--search-text);
            font-size: 0.95rem;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            outline: none;
        }

        .search-bar:focus {
            background: var(--search-focus-bg);
            color: var(--input-text);
            border-color: #90c695;
        }

        .search-bar::placeholder {
            color: var(--search-placeholder);
        }

        .search-bar:focus::placeholder {
            color: var(--search-placeholder);
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--search-icon);
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
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.15);
            z-index: 999;
            display: none;
            margin-top: 0.5rem;
            backdrop-filter: blur(20px);
            max-height: 400px;
            overflow-y: auto;
        }

        .search-dropdown.show {
            display: block;
        }

        .search-section {
            border-bottom: 1px solid var(--card-border);
        }

        .search-section:last-child {
            border-bottom: none;
        }

        .search-section-header {
            padding: 0.75rem 1rem;
            background: rgba(74, 124, 35, 0.05);
            font-weight: 600;
            color: var(--subheading-color);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .search-result-item {
            padding: 0.75rem 1rem;
            cursor: pointer;
            transition: background 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .search-result-item:hover {
            background: var(--post-hover-bg);
        }

        .search-result-icon {
            color: var(--subheading-color);
            width: 20px;
            text-align: center;
        }

        .search-result-content {
            flex: 1;
        }

        .search-result-title {
            font-weight: 600;
            color: var(--text-color);
            font-size: 0.95rem;
        }

        .search-result-description {
            color: var(--secondary-text);
            font-size: 0.8rem;
            margin-top: 0.2rem;
        }

        .search-empty {
            padding: 1.25rem 1rem;
            font-size: 0.9rem;
            color: var(--empty-state-text);
        }

        /* Secondary Navbar */
        .secondary-navbar {
            background: var(--secondary-navbar-bg);
            padding: 1rem 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 2px 8px var(--secondary-nav-shadow);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--card-border);
            position: sticky;
            top: 0;
            z-index: 999;
            flex-wrap: wrap;
        }

        .secondary-navbar .nav-button {
            background: var(--secondary-nav-button-bg);
            border: 1px solid var(--secondary-nav-button-border);
            color: var(--secondary-nav-button-color);
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
            box-shadow: 0 2px 8px var(--secondary-nav-shadow);
            min-width: 120px;
            justify-content: center;
            white-space: nowrap;
        }

        .secondary-navbar .nav-button:hover {
            background: var(--secondary-nav-button-hover-bg);
            transform: translateY(-1px);
            box-shadow: 0 6px 16px var(--secondary-nav-shadow);
            border-color: var(--secondary-nav-button-border);
        }

        .secondary-navbar .nav-button.active {
            background: var(--secondary-nav-button-active-bg);
            border-color: var(--secondary-nav-button-border);
            color: var(--heading-color);
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
            background: var(--welcome-bg);
            padding: 2.5rem;
            border-radius: 16px;
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px var(--card-shadow);
            border: 1px solid var(--card-border);
            position: relative;
            overflow: hidden;
        }

        /* Weather Card */
        .weather-card {
            background: var(--card-bg);
            padding: 1.25rem 1.5rem;
            border-radius: 16px;
            margin-bottom: 1.25rem;
            box-shadow: 0 8px 32px var(--card-shadow);
            border: 1px solid var(--card-border);
            display: grid;
            grid-template-columns: 1fr auto;
            align-items: center;
            gap: 1rem;
        }
        .weather-left {
            display: flex;
            align-items: center;
            gap: 0.9rem;
            min-width: 0;
        }
        .weather-icon {
            width: 44px;
            height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(74,124,35,0.15), rgba(144,198,149,0.15));
            color: var(--heading-color);
        }
        .weather-title {
            font-weight: 700;
            color: var(--heading-color);
            line-height: 1.2;
        }
        .weather-location {
            font-size: 0.9rem;
            color: var(--welcome-subtext);
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .weather-controls {
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .weather-relocate {
            background: var(--secondary-nav-button-bg);
            border: 1px solid var(--secondary-nav-button-border);
            color: var(--secondary-nav-button-color);
            border-radius: 20px;
            padding: .25rem .55rem;
            font-size: .8rem;
            cursor: pointer;
            transition: all .2s ease;
        }
        .weather-relocate:hover {
            background: var(--secondary-nav-button-hover-bg);
        }
        .weather-setloc, .weather-clearloc {
            background: transparent;
            border: 1px dashed var(--secondary-nav-button-border);
            color: var(--secondary-nav-button-color);
            border-radius: 20px;
            padding: .25rem .55rem;
            font-size: .8rem;
            cursor: pointer;
        }
        .weather-setloc:hover, .weather-clearloc:hover{
            background: var(--secondary-nav-button-hover-bg);
        }
        .weather-right {
            text-align: right;
        }
        .weather-temp {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--welcome-text);
            line-height: 1;
        }
        .weather-meta {
            font-size: 0.9rem;
            color: var(--welcome-subtext);
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
            color: var(--welcome-text);
            font-size: 2.2rem;
            margin-bottom: 0.8rem;
            font-weight: 700;
        }

        .welcome-card p {
            color: var(--welcome-subtext);
            font-size: 1.2rem;
        }

        /* Cards */
        .card {
            background: var(--card-bg);
            padding: 2rem;
            border-radius: 16px;
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px var(--card-shadow);
            backdrop-filter: blur(10px);
            border: 1px solid var(--card-border);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px var(--card-hover-shadow);
        }

        .card h2 {
            color: var(--heading-color);
            font-size: 1.4rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            font-weight: 700;
        }

        .card h2 i {
            color: var(--subheading-color);
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
            color: var(--text-color);
            font-size: 1rem;
        }

        input, textarea, select {
            width: 100%;
            padding: 1rem;
            border: 2px solid var(--input-border);
            border-radius: 12px;
            font-family: inherit;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: var(--input-bg);
            color: var(--input-text);
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #4a7c23;
            box-shadow: 0 0 0 4px rgba(74, 124, 35, 0.1);
            background: var(--input-bg);
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
            border-bottom: 1px solid var(--post-border);
            transition: all 0.3s ease;
        }

        .post:hover {
            background: var(--post-hover-bg);
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
            color: var(--heading-color);
            margin-bottom: 0.8rem;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .post-title:hover {
            color: var(--subheading-color);
        }

        .post-content {
            color: var(--text-color);
            margin-bottom: 1rem;
            line-height: 1.6;
        }

        .post-meta {
            display: flex;
            gap: 1.5rem;
            font-size: 0.9rem;
            color: var(--welcome-subtext);
            flex-wrap: wrap;
        }

        .post-meta span {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.3rem 0.8rem;
            background: var(--post-meta-bg);
            border-radius: 20px;
            transition: background 0.3s ease;
        }

        .post-meta span:hover {
            background: var(--post-meta-hover-bg);
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
            color: var(--empty-state-color);
        }

        .empty-state h3 {
            color: var(--empty-state-heading);
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: var(--empty-state-text);
            font-size: 1rem;
        }

        .empty-state i {
            color: var(--empty-state-icon);
        }

        /* Alert Messages */
        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 8px;
            border-left: 4px solid;
        }

        .alert-success {
            background-color: rgba(74, 124, 35, 0.1);
            border-color: #4a7c23;
            color: var(--heading-color);
        }

        .alert-error {
            background-color: rgba(220, 53, 69, 0.1);
            border-color: #dc3545;
            color: #dc3545;
        }

        [data-theme="dark"] .alert-success {
            background-color: rgba(144, 198, 149, 0.15);
            border-color: #90c695;
            color: var(--subheading-color);
        }

        [data-theme="dark"] .alert-error {
            background-color: rgba(248, 113, 113, 0.15);
            border-color: #f87171;
            color: #f87171;
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
            background: var(--card-bg);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 12px 40px var(--card-shadow), 0 4px 16px var(--card-shadow);
            backdrop-filter: blur(20px);
            border: 1px solid var(--card-border);
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
            box-shadow: 0 20px 60px var(--card-hover-shadow), 0 8px 24px var(--card-hover-shadow);
        }

        .sidebar-card h3 {
            color: var(--heading-color);
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

        [data-theme="dark"] .sidebar-card h3 i {
            color: var(--subheading-color);
            background: linear-gradient(135deg, rgba(144, 198, 149, 0.15), rgba(144, 198, 149, 0.1));
        }

        .sidebar-card:hover h3 i {
            background: linear-gradient(135deg, rgba(74, 124, 35, 0.2), rgba(144, 198, 149, 0.2));
            transform: scale(1.1);
        }

        [data-theme="dark"] .sidebar-card:hover h3 i {
            background: linear-gradient(135deg, rgba(144, 198, 149, 0.25), rgba(144, 198, 149, 0.2));
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
            color: var(--text-color);
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

        [data-theme="dark"] .sidebar-list a::before {
            background: linear-gradient(90deg, transparent, rgba(144, 198, 149, 0.08), transparent);
        }

        .sidebar-list a:hover::before {
            left: 100%;
        }

        .sidebar-list a:hover {
            background: linear-gradient(135deg, rgba(74, 124, 35, 0.08), rgba(144, 198, 149, 0.08));
            color: var(--heading-color);
            transform: translateX(8px);
            border-color: rgba(74, 124, 35, 0.2);
            box-shadow: 0 4px 12px rgba(74, 124, 35, 0.15);
        }

        [data-theme="dark"] .sidebar-list a:hover {
            background: linear-gradient(135deg, rgba(144, 198, 149, 0.12), rgba(144, 198, 149, 0.08));
            border-color: rgba(144, 198, 149, 0.3);
            box-shadow: 0 4px 12px rgba(144, 198, 149, 0.2);
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

        [data-theme="dark"] .sidebar-list a i {
            background: linear-gradient(135deg, #4a5568, #2d3748);
            color: var(--text-color);
        }

        .sidebar-list a:hover i {
            background: linear-gradient(135deg, #4a7c23, #90c695);
            color: white;
            transform: rotate(5deg) scale(1.1);
        }

        /* Advanced Quick Actions Styling */
        .sidebar-card:last-child {
            background: var(--card-bg);
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
            color: var(--heading-color);
            font-size: 0.9rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .friend-info small {
            color: var(--welcome-subtext);
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

        /* My Questions Info */
        .my-questions-info {
            color: var(--welcome-subtext);
        }

        .my-questions-info i {
            color: var(--subheading-color);
            margin-right: 0.5rem;
        }

        /* File Upload Error Messages */
        .file-upload-error {
            margin-top: 0.5rem;
            font-size: 0.85rem;
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

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: var(--empty-state-color);
        }

        .empty-state i {
            font-size: 4rem;
            color: var(--empty-state-icon);
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            color: var(--empty-state-heading);
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: var(--empty-state-text);
        }

        /* Pagination */
        .pagination-wrapper {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>

    <!-- FIXED NAVBAR -->
    <nav class="navbar">
        <div class="nav-left">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('logo2.png') }}" alt="Farm Guide Logo" class="logo">
                <span class="nav-title">Farm Guide</span>
            </a>
        </div>

        <div class="nav-right">
            <!-- Search Bar moved to nav-right -->
            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-bar" id="searchInput" placeholder="Search anything...">

                <!-- Global Search Dropdown -->
                <div class="search-dropdown" id="searchDropdown">
                    <div class="search-section">
                        <div class="search-section-header">Search Users</div>
                        <div class="search-empty">No recent searches</div>
                    </div>
                    <div class="search-section">
                        <div class="search-section-header">Recent Posts</div>
                        <div class="search-empty">No recent searches</div>
                    </div>
                    <div class="search-section">
                        <div class="search-section-header">Navigation</div>
                        <div class="search-result-item" onclick="window.location.href='{{ route('friends') }}'">
                            <i class="fas fa-users search-result-icon"></i>
                            <div class="search-result-content">
                                <div class="search-result-title">Friends & Network</div>
                                <div class="search-result-description">Connect with other farmers and experts</div>
                            </div>
                        </div>
                        <div class="search-result-item" onclick="window.location.href='{{ route('profile.edit') }}'">
                            <i class="fas fa-user search-result-icon"></i>
                            <div class="search-result-content">
                                <div class="search-result-title">Profile Settings</div>
                                <div class="search-result-description">Manage your account and preferences</div>
                            </div>
                        </div>
                    </div>
                    <div class="search-section">
                        <div class="search-section-header">Dashboard Actions</div>
                        <div class="search-result-item" onclick="document.getElementById('postsSection').scrollIntoView({behavior: 'smooth'})">
                            <i class="fas fa-comments search-result-icon"></i>
                            <div class="search-result-content">
                                <div class="search-result-title">Community Posts</div>
                                <div class="search-result-description">View and interact with farming discussions</div>
                            </div>
                        </div>
                        <div class="search-result-item" onclick="document.getElementById('createPost').scrollIntoView({behavior: 'smooth'})">
                            <i class="fas fa-plus search-result-icon"></i>
                            <div class="search-result-content">
                                <div class="search-result-title">Create New Post</div>
                                <div class="search-result-description">Share your farming knowledge and questions</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="notifications-container">
                <button type="button" class="nav-button" id="notificationsToggle">
                    <i class="fas fa-bell"></i>
                </button>
                <div class="notifications-dropdown" id="notificationsDropdown">
                    <div class="notifications-header">
                        <i class="fas fa-bell"></i> Notifications
                    </div>
                    <div class="empty-notifications">
                        <div><i class="fas fa-bell-slash"></i></div>
                        <div>No notifications yet</div>
                        <div style="font-size: 0.8rem; margin-top: 0.5rem;">You'll see notifications here when you have them</div>
                    </div>
                </div>
            </div>

            <a href="{{ route('logout.get') }}" class="nav-button logout" title="Sign out">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </div>
    </nav>

    <!-- Secondary Navbar -->
    <div class="secondary-navbar">
        <a href="{{ route('dashboard') }}" class="nav-button active">
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
        <a href="{{ route('profile.edit') }}" class="nav-button">
            <i class="fas fa-user"></i>
            <span>Profile</span>
        </a>
    </div>

    <div class="container">
        <div class="main-content">
            <!-- Weather (Today) -->
            <div id="weatherCard" class="weather-card" aria-live="polite">
                <div class="weather-left">
                    <div class="weather-icon"><i id="weatherIcon" class="fa-solid fa-cloud-sun"></i></div>
                    <div>
                        <div class="weather-title">Today's Weather</div>
                        <div class="weather-controls">
                            <div id="weatherLocation" class="weather-location">Detecting location…</div>
                            <button id="weatherRelocate" class="weather-relocate" type="button" title="Use precise location">
                                <i class="fa-solid fa-location-crosshairs"></i>
                            </button>
                            <button id="weatherSetLoc" class="weather-setloc" type="button" title="Set location (city or lat,lon)">
                                <i class="fa-solid fa-thumbtack"></i>
                            </button>
                            <button id="weatherClearLoc" class="weather-clearloc" type="button" title="Clear saved location">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="weather-right">
                    <div id="weatherTemp" class="weather-temp">--°C</div>
                    <div class="weather-meta">
                        <span id="weatherDesc">Loading…</span>
                        <span id="weatherRange" style="margin-left:.5rem">H:--° L:--°</span>
                        <span id="weatherExtra" style="margin-left:.5rem">Rain: --% · Wind: -- km/h</span>
                    </div>
                </div>
            </div>
            <!-- Welcome -->
            <div class="welcome-card">
                <h1>Welcome, {{ Auth::user()->name }}!</h1>
                <p>Connect with experts across all agricultural sectors - from traditional farming to modern aquaponics and everything in between.</p>
            </div>

            <!-- Ask Question Form -->
            <div class="card">
                <h2><i class="fas fa-question-circle"></i> Ask a Question</h2>

                <!-- Demo Form -->
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Your Question</label>
                        <input type="text" name="title" placeholder="What agricultural challenge can we help you solve?" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Details</label>
                        <textarea name="content" rows="4" placeholder="Provide specific details about your farming situation, location, current methods, or any other relevant information..." required>asdasd</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Add Photos (Optional - Max 5 photos, 5MB each)</label>
                        <input type="file" name="images[]" accept="image/*" multiple id="images">
                        <small style="color: var(--welcome-subtext); font-size: 0.85rem;">You can select up to 5 photos (JPG, PNG, GIF). Maximum 5MB per photo.</small>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Category</label>
                        <select name="category_id" required>
                            <option value="">Choose your agricultural focus</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->CategoryID }}">{{ $category->name }}</option>
                            @endforeach
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
                <h2><i class="fas fa-comments"></i> Recent Questions</h2>

                @forelse($posts as $post)
                    <div class="post">
                        <h3 class="post-title">{{ $post->title }}</h3>
                        <p class="post-content">{{ Str::limit($post->content, 200) }}</p>

                        @if($post->imgSrc && count(json_decode($post->imgSrc, true)) > 0)
                            <div class="post-images">
                                @foreach(array_slice(json_decode($post->imgSrc, true), 0, 3) as $image)
                                    <img src="{{ asset('storage/' . $image) }}" alt="Post image" class="post-image">
                                @endforeach
                            </div>
                        @endif

                        <div class="post-meta">
                            <span><i class="fas fa-tag"></i> {{ $post->category->name ?? 'General' }}</span>
                            <span><i class="fas fa-user"></i> {{ $post->user->name }}</span>
                            <span><i class="fas fa-comments"></i> {{ $post->comments->count() }} answers</span>
                            <span><i class="fas fa-clock"></i> {{ $post->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fas fa-comments"></i>
                        <h3>No questions yet</h3>
                        <p>Be the first to ask a question and get expert advice!</p>
                    </div>
                @endforelse

                @if($posts->hasPages())
                    <div class="pagination-wrapper">
                        {{ $posts->links() }}
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
                    @foreach($categories->take(8) as $category)
                        <li><a href="{{ route('topics.show', \Illuminate\Support\Str::slug($category->name)) }}"><i class="fas fa-seedling"></i> {{ $category->name }}</a></li>
                    @endforeach
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
        </div>
    </div>

    <script>
        const darkModeToggle = document.getElementById('darkModeToggle');

        // Load saved preference
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);

        // Update toggle button text based on current theme
        if (savedTheme === 'dark') {
            darkModeToggle.innerHTML = '<i class="fas fa-sun"></i> <span>Light Mode</span>';
        } else {
            darkModeToggle.innerHTML = '<i class="fas fa-moon"></i> <span>Dark Mode</span>';
        }

        darkModeToggle.addEventListener('click', function() {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);

            if (newTheme === 'dark') {
                this.innerHTML = '<i class="fas fa-sun"></i> <span>Light Mode</span>';
            } else {
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

        // Weather widget (client-side, no API key; uses Open-Meteo)
        (function initWeather(){
            const el = {
                card: document.getElementById('weatherCard'),
                icon: document.getElementById('weatherIcon'),
                temp: document.getElementById('weatherTemp'),
                desc: document.getElementById('weatherDesc'),
                range: document.getElementById('weatherRange'),
                extra: document.getElementById('weatherExtra'),
                loc: document.getElementById('weatherLocation'),
                locateBtn: document.getElementById('weatherRelocate'),
            };

            if (!el.card) return;

            const fallback = { lat: 14.5995, lon: 120.9842, name: 'Manila, PH' };

            // Restore last known data immediately to avoid flicker
            try {
                const cached = JSON.parse(localStorage.getItem('weather:last'));
                if (cached && Date.now() - cached.time < 30 * 60 * 1000) { // 30 mins
                    el.temp.textContent = cached.temp;
                    el.desc.textContent = cached.desc;
                    el.range.textContent = cached.range || '';
                    el.extra.textContent = cached.extra || '';
                    el.loc.textContent = cached.loc || '';
                    if (cached.icon) el.icon.className = 'fa-solid ' + cached.icon;
                    if (cached.title) el.loc.title = cached.title;
                }
            } catch {}

            // If user saved a manual location, use it first
            try {
                const manual = JSON.parse(localStorage.getItem('weather:manual'));
                if (manual && typeof manual.lat === 'number' && typeof manual.lon === 'number'){
                    el.loc.textContent = manual.label || 'Saved location';
                    update(manual.lat, manual.lon, manual.label);
                }
            } catch {}

            const codeMap = {
                0: {t:'Clear sky', i:'fa-sun'},
                1: {t:'Mainly clear', i:'fa-sun'},
                2: {t:'Partly cloudy', i:'fa-cloud-sun'},
                3: {t:'Overcast', i:'fa-cloud'},
                45:{t:'Fog', i:'fa-smog'},
                48:{t:'Depositing rime fog', i:'fa-smog'},
                51:{t:'Light drizzle', i:'fa-cloud-rain'},
                53:{t:'Drizzle', i:'fa-cloud-rain'},
                55:{t:'Heavy drizzle', i:'fa-cloud-showers-heavy'},
                56:{t:'Freezing drizzle', i:'fa-snowflake'},
                57:{t:'Freezing drizzle', i:'fa-snowflake'},
                61:{t:'Light rain', i:'fa-cloud-rain'},
                63:{t:'Rain', i:'fa-cloud-rain'},
                65:{t:'Heavy rain', i:'fa-cloud-showers-heavy'},
                66:{t:'Freezing rain', i:'fa-snowflake'},
                67:{t:'Freezing rain', i:'fa-snowflake'},
                71:{t:'Light snow', i:'fa-snowflake'},
                73:{t:'Snow', i:'fa-snowflake'},
                75:{t:'Heavy snow', i:'fa-snowflake'},
                77:{t:'Snow grains', i:'fa-snowflake'},
                80:{t:'Rain showers', i:'fa-cloud-showers-heavy'},
                81:{t:'Rain showers', i:'fa-cloud-showers-heavy'},
                82:{t:'Violent rain showers', i:'fa-cloud-showers-heavy'},
                85:{t:'Snow showers', i:'fa-snowflake'},
                86:{t:'Snow showers', i:'fa-snowflake'},
                95:{t:'Thunderstorm', i:'fa-cloud-bolt'},
                96:{t:'Thunderstorm w/ hail', i:'fa-cloud-bolt'},
                99:{t:'Thunderstorm w/ hail', i:'fa-cloud-bolt'}
            };

            function setIcon(code){
                const item = codeMap[code] || {t:'Weather', i:'fa-cloud'};
                el.icon.className = 'fa-solid ' + item.i;
                return item.t;
            }

            async function reverseGeocode(lat, lon){
                // Try BigDataCloud for precise admin/locality naming. No API key for this endpoint.
                try {
                    const url = `https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${lat}&longitude=${lon}&localityLanguage=en`; // no key
                    const r = await fetch(url, { cache: 'no-store' });
                    if (r.ok) {
                        const j = await r.json();
                        // Prefer municipality/city then province; normalize Cotabato naming
                        let city = j.localityInfo?.locality?.name || j.city || j.locality || j.localityInfo?.administrative?.[0]?.name;
                        let province = j.principalSubdivision || j.localityInfo?.administrative?.find(a => a.adminLevel === 4)?.name;
                        if (province) {
                            // Normalize 'North Cotabato'/'Cotabato' variants
                            province = province.replace(/^Cotabato \(North Cotabato\)$/i, 'Cotabato')
                                               .replace(/^North Cotabato$/i, 'Cotabato');
                        }
                        const parts = [city, province, j.countryCode].filter(Boolean);
                        const name = parts.filter(Boolean).join(', ');
                        if (name) return name;
                    }
                } catch {}
                // Fallback to Open‑Meteo geocoder
                try {
                    const url = `https://geocoding-api.open-meteo.com/v1/reverse?latitude=${lat}&longitude=${lon}&language=en&format=json`;
                    const r = await fetch(url, { cache: 'no-store' });
                    const j = await r.json();
                    if (j && Array.isArray(j.results) && j.results.length){
                        const best = j.results[0];
                        let city = best.city || best.name;
                        let admin = best.admin1;
                        if (admin) admin = admin.replace(/^Cotabato \(North Cotabato\)$/i, 'Cotabato').replace(/^North Cotabato$/i, 'Cotabato');
                        const parts = [city, admin, best.country_code].filter(Boolean);
                        return parts.slice(0,2).join(', ') + (best.country_code ? ` ${best.country_code}` : '');
                    }
                } catch {}
                return null;
            }

            async function fetchWeather(lat, lon){
                const base = `https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&timezone=auto&daily=temperature_2m_max,temperature_2m_min,precipitation_probability_max`;
                try {
                    // Prefer new API fields
                    let url = base + `&current=temperature_2m,relative_humidity_2m,apparent_temperature,weather_code,wind_speed_10m`;
                    let r = await fetch(url, { cache: 'no-store' });
                    if (!r.ok) throw new Error('bad status');
                    let j = await r.json();
                    if (!j.current) throw new Error('missing current');
                    return {
                        temp: j.current.temperature_2m,
                        code: j.current.weather_code,
                        wind: j.current.wind_speed_10m,
                        humidity: j.current.relative_humidity_2m,
                        tMax: j.daily?.temperature_2m_max?.[0],
                        tMin: j.daily?.temperature_2m_min?.[0],
                        rain: j.daily?.precipitation_probability_max?.[0]
                    };
                } catch {
                    // Fallback to legacy current_weather
                    const url = base + `&current_weather=true`;
                    const r = await fetch(url, { cache: 'no-store' });
                    const j = await r.json();
                    return {
                        temp: j.current_weather?.temperature,
                        code: j.current_weather?.weathercode,
                        wind: j.current_weather?.windspeed,
                        humidity: undefined,
                        tMax: j.daily?.temperature_2m_max?.[0],
                        tMin: j.daily?.temperature_2m_min?.[0],
                        rain: j.daily?.precipitation_probability_max?.[0]
                    };
                }
            }

            function showError(msg){
                el.desc.textContent = msg || 'Weather unavailable';
                el.temp.textContent = '--°C';
                el.range.textContent = 'H:--° L:--°';
                el.extra.textContent = 'Rain: --% · Wind: -- km/h';
            }

            async function update(lat, lon, label, accuracy){
                try {
                    const data = await fetchWeather(lat, lon);
                    const desc = setIcon(Number(data.code));
                    el.temp.textContent = (Math.round(Number(data.temp)) || Math.round(Number(data.temp))) + '°C';
                    el.desc.textContent = desc;
                    const tMax = Number(data.tMax);
                    const tMin = Number(data.tMin);
                    el.range.textContent = (isFinite(tMax) && isFinite(tMin)) ? `H:${Math.round(tMax)}° L:${Math.round(tMin)}°` : '';
                    const wind = Number(data.wind);
                    const rain = Number(data.rain);
                    const extras = [];
                    if (isFinite(rain)) extras.push(`Rain: ${Math.round(rain)}%`);
                    if (isFinite(wind)) extras.push(`Wind: ${Math.round(wind)} km/h`);
                    el.extra.textContent = extras.join(' · ');
                    el.loc.textContent = label || 'Your location';
                    // Put coordinates/accuracy as title for advanced users
                    el.loc.title = `Lat: ${lat.toFixed(4)}, Lon: ${lon.toFixed(4)}${accuracy ? ` · ±${Math.round(accuracy)}m` : ''}`;

                    // Cache for 30 minutes
                    const iconClass = (el.icon.className || '').replace('fa-solid ', '');
                    localStorage.setItem('weather:last', JSON.stringify({
                        time: Date.now(),
                        temp: el.temp.textContent,
                        desc: el.desc.textContent,
                        range: el.range.textContent,
                        extra: el.extra.textContent,
                        loc: el.loc.textContent,
                        title: el.loc.title,
                        icon: iconClass
                    }));
                } catch (e){
                    showError('Unable to load weather');
                    if (label) el.loc.textContent = label;
                }
            }

            function withLocation(pos){
                const { latitude: lat, longitude: lon, accuracy } = pos.coords;
                update(lat, lon, undefined, accuracy);
                // Try to resolve a friendly location name, but don't block UI
                reverseGeocode(lat, lon).then(name => {
                    if (name) el.loc.textContent = name;
                });
            }

            function useFallback(){
                el.loc.textContent = fallback.name + ' (default)';
                update(fallback.lat, fallback.lon, fallback.name);
            }

            function locate(highAccuracy){
                if ('geolocation' in navigator){
                    navigator.geolocation.getCurrentPosition(withLocation, useFallback, {
                        enableHighAccuracy: !!highAccuracy,
                        timeout: 8000,
                        maximumAge: highAccuracy ? 0 : 5 * 60 * 1000
                    });
                } else {
                    useFallback();
                }
            }

            // Initial locate (balanced accuracy)
            locate(true);

            // Relocate on demand with high accuracy
            if (el.locateBtn){
                el.locateBtn.addEventListener('click', function(e){
                    e.preventDefault();
                    el.loc.textContent = 'Locating…';
                    locate(true);
                });
            }

            // Manual location set/clear
            const setBtn = document.getElementById('weatherSetLoc');
            const clearBtn = document.getElementById('weatherClearLoc');

            async function geocodeCity(q){
                try {
                    const url = `https://geocoding-api.open-meteo.com/v1/search?name=${encodeURIComponent(q)}&count=1&language=en&format=json`;
                    const r = await fetch(url, { cache: 'no-store' });
                    const j = await r.json();
                    const res = j && Array.isArray(j.results) && j.results[0];
                    if (res){
                        const label = [res.name, res.admin1, res.country_code].filter(Boolean).join(', ');
                        return { lat: res.latitude, lon: res.longitude, label };
                    }
                } catch {}
                return null;
            }

            if (setBtn){
                setBtn.addEventListener('click', async () => {
                    const value = prompt('Enter city (e.g., Kabacan) or coordinates (lat,lon):');
                    if (!value) return;
                    let latLonMatch = value.match(/^\s*(-?\d+(?:\.\d+)?)\s*,\s*(-?\d+(?:\.\d+)?)\s*$/);
                    if (latLonMatch){
                        const lat = parseFloat(latLonMatch[1]);
                        const lon = parseFloat(latLonMatch[2]);
                        const label = (await reverseGeocode(lat, lon)) || `${lat.toFixed(3)}, ${lon.toFixed(3)}`;
                        localStorage.setItem('weather:manual', JSON.stringify({ lat, lon, label }));
                        update(lat, lon, label);
                        return;
                    }
                    const g = await geocodeCity(value);
                    if (g){
                        localStorage.setItem('weather:manual', JSON.stringify(g));
                        update(g.lat, g.lon, g.label);
                    } else {
                        alert('Could not find that location. Try a nearby city or specify coordinates like 7.105,124.828');
                    }
                });
            }

            if (clearBtn){
                clearBtn.addEventListener('click', () => {
                    localStorage.removeItem('weather:manual');
                    alert('Saved location cleared. Using device location.');
                    locate(true);
                });
            }
        })();

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
                    errorDiv.className = 'file-upload-error';
                    errorDiv.style.color = '#dc3545';
                    errorDiv.textContent = errorMessage;
                    e.target.parentNode.appendChild(errorDiv);
                } else if (files.length > 0) {
                    // Show success message
                    const successDiv = document.createElement('div');
                    successDiv.className = 'file-upload-error';
                    successDiv.style.color = '#4a7c23';
                    successDiv.textContent = `${files.length} image${files.length > 1 ? 's' : ''} selected successfully.`;
                    e.target.parentNode.appendChild(successDiv);
                }
            });
        }

        // Notifications dropdown functionality
        const notificationsToggle = document.getElementById('notificationsToggle');
        const notificationsDropdown = document.getElementById('notificationsDropdown');

        notificationsToggle.addEventListener('click', function(e) {
            e.stopPropagation();

            if (notificationsDropdown.classList.contains('show')) {
                // Closing
                notificationsDropdown.style.transform = 'translateY(-10px) scale(0.95)';
                notificationsDropdown.style.opacity = '0';
                setTimeout(() => {
                    notificationsDropdown.classList.remove('show');
                }, 200);
            } else {
                // Opening
                notificationsDropdown.classList.add('show');
                // Trigger reflow
                notificationsDropdown.offsetHeight;
                notificationsDropdown.style.transform = 'translateY(0) scale(1)';
                notificationsDropdown.style.opacity = '1';
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!notificationsToggle.contains(e.target) && !notificationsDropdown.contains(e.target)) {
                if (notificationsDropdown.classList.contains('show')) {
                    notificationsDropdown.style.transform = 'translateY(-10px) scale(0.95)';
                    notificationsDropdown.style.opacity = '0';
                    setTimeout(() => {
                        notificationsDropdown.classList.remove('show');
                    }, 200);
                }
            }
        });

        // Prevent dropdown from closing when clicking inside it
        notificationsDropdown.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        // Global Search functionality
        const searchInput = document.getElementById('searchInput');
        const searchDropdown = document.getElementById('searchDropdown');

        searchInput.addEventListener('focus', function() {
            searchDropdown.classList.add('show');
        });

        searchInput.addEventListener('blur', function() {
            // Delay hiding to allow clicks on dropdown items
            setTimeout(() => {
                searchDropdown.classList.remove('show');
            }, 200);
        });

        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const items = searchDropdown.querySelectorAll('.search-result-item');

            items.forEach(item => {
                const title = item.querySelector('.search-result-title').textContent.toLowerCase();
                const description = item.querySelector('.search-result-description').textContent.toLowerCase();

                if (title.includes(query) || description.includes(query) || query === '') {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        // Close search dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchDropdown.contains(e.target)) {
                searchDropdown.classList.remove('show');
            }
        });
    </script>
</body>
</html>
