<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SKINMARKET') | Торговая площадка скинов</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --primary: #0a0e17;
            --primary-light: #1a2332;
            --accent: #ff4655;
            --accent-hover: #ff6b77;
            --accent-secondary: #5c8aff;
            --light-bg: #0f141f;
            --card-bg: #151e2b;
            --dark: #ffffff;
            --text: #b5c2d9;
            --text-light: #7a8ba8;
            --border: #2a3548;
            --success: #00c853;
            --warning: #ffb300;
            --rarity-common: #b0c4de;
            --rarity-rare: #4b7bec;
            --rarity-mythical: #885ef8;
            --rarity-legendary: #f7b731;
            --rarity-ancient: #eb3b5a;
            --rarity-immortal: #e6c300;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            color: var(--text);
            background: linear-gradient(135deg, #0a0e17 0%, #0f141f 100%);
            line-height: 1.6;
            font-weight: 400;
            min-height: 100vh;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-weight: 700;
            color: var(--dark);
            letter-spacing: -0.01em;
            line-height: 1.3;
        }
        
        a {
            color: var(--dark);
            transition: all 0.25s ease;
            text-decoration: none;
        }
        
        a:hover {
            color: var(--accent);
        }
        
        .btn {
            font-weight: 600;
            letter-spacing: 0.3px;
            padding: 0.7rem 1.8rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            font-size: 0.9rem;
            border: none;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--accent) 0%, #ff2d40 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(255, 70, 85, 0.3);
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #ff2d40 0%, var(--accent) 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 70, 85, 0.4);
        }
        
        .btn-outline-primary {
            background: transparent;
            color: var(--dark);
            border: 1px solid var(--border);
        }
        
        .btn-outline-primary:hover {
            background: var(--card-bg);
            color: var(--accent);
            border-color: var(--accent);
        }
        
        .btn-accent {
            background: linear-gradient(135deg, var(--accent-secondary) 0%, #3d6eff 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(92, 138, 255, 0.3);
        }
        
        .card {
            border: none;
            border-radius: 12px;
            background: var(--card-bg);
            transition: all 0.3s ease;
            border: 1px solid var(--border);
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
            border-color: var(--accent);
        }
        
        .bg-light-custom {
            background-color: var(--card-bg);
        }
        
        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            text-align: center;
            letter-spacing: -0.02em;
            color: var(--dark);
            text-transform: uppercase;
        }
        
        .section-subtitle {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 4px;
            color: var(--accent);
            margin-bottom: 1rem;
            text-align: center;
            font-weight: 600;
        }
        
        .badge-custom {
            background: var(--primary-light);
            color: var(--text);
            padding: 0.4rem 1rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        
        .price-tag {
            color: var(--accent);
            font-weight: 700;
            font-size: 1.4rem;
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid var(--border);
            padding: 0.7rem 1.2rem;
            background-color: var(--primary-light);
            color: var(--dark);
            font-size: 0.95rem;
        }
        
        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 3px rgba(255, 70, 85, 0.2);
            border-color: var(--accent);
            background-color: var(--primary-light);
            color: var(--dark);
        }
        
        .form-control::placeholder {
            color: var(--text-light);
        }
        
        .form-label {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.5rem;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-bottom: 1.5rem;
        }
        
        .breadcrumb-item a {
            color: var(--text-light);
        }
        
        .breadcrumb-item.active {
            color: var(--accent);
        }
        
        .pagination .page-link {
            border: 1px solid var(--border);
            border-radius: 8px !important;
            margin: 0 5px;
            padding: 0.6rem 1rem;
            color: var(--text);
            background-color: var(--card-bg);
        }
        
        .pagination .page-item.active .page-link {
            background: var(--accent);
            color: white;
            border-color: var(--accent);
        }
        
        .pagination .page-link:hover {
            background: var(--primary-light);
            color: var(--accent);
            border-color: var(--accent);
        }
        
        .alert {
            border-radius: 8px;
            border: 1px solid var(--border);
            padding: 1rem 1.5rem;
            background: var(--card-bg);
        }
        
        .alert-success {
            border-color: var(--success);
            color: var(--success);
        }
        
        .alert-danger {
            border-color: var(--accent);
            color: var(--accent);
        }
        
        /* Анимации */
        @keyframes glow {
            0%, 100% { box-shadow: 0 0 20px rgba(255, 70, 85, 0.3); }
            50% { box-shadow: 0 0 40px rgba(255, 70, 85, 0.5); }
        }
        
        .glow-effect {
            animation: glow 2s ease-in-out infinite;
        }
        
        .rarity-common { color: var(--rarity-common); }
        .rarity-rare { color: var(--rarity-rare); }
        .rarity-mythical { color: var(--rarity-mythical); }
        .rarity-legendary { color: var(--rarity-legendary); }
        .rarity-ancient { color: var(--rarity-ancient); }
        .rarity-immortal { color: var(--rarity-immortal); }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <main>
        @yield('content')
    </main>

    @include('layouts.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>