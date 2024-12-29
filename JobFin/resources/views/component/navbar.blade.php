
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/Navbar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        body{
            background-color: #FFDFB3;
            background-image: url("asset/circle.png");
            background-size: 300px;
            background-repeat: no-repeat; 
            background-position: bottom right;
        }

        body::before {
            content: "";
            background-image: url("asset/upper.png"); 
            background-size: auto; 
            background-repeat: no-repeat; 
            background-position: top right; 
            position: absolute; 
            top: -50px;
            right: 0;
            width: 600px;
            height: 600px;
            z-index: -1; 
        }

        .navbar {
            background-color: #FFB39A;
            padding: 1rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .left {
            display: flex;
            align-items: center;
            gap: 3rem;
        }

        .left img {
            height: 40px;
        }

        .option {
            display: flex;
            gap: 2rem;
        }

        .option a {
            color: #F5642A;
            font-weight: 500;
        }

        .option a:hover {
            color: #d14718;
        }

        .right {
            display: flex;
            gap: 1rem;
        }

        .right button {
            padding: 0.5rem 1.5rem;
            border-radius: 20px;
            border: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .right button:first-child {
            background-color: white;
            color: #F5642A;
        }

        .right button:last-child {
            background-color: #F5642A;
            color: white;
        }

        .right button:hover {
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 1rem;
            }
            
            .left {
                flex-direction: column;
                gap: 1rem;
            }
            
            .option {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="left">
                <img src="{{ URL('asset/logo.png') }}" alt="JobFin Logo">
                <div class="option">
                    <a href="#" class="nav-link">Tentang Kami</a>
                    <a href="#" class="nav-link">Layanan</a>
                    <a href="#" class="nav-link">Informasi Lanjut</a>
                </div>
            </div>
            <div class="right">
                <button class="register-btn" onclick="window.location.href='{{ route('register') }}'">Register</button>
                <button class="login-btn" onclick="window.location.href='{{ route('login') }}'">Login</button>
            </div>
        </nav>
    </header>
</body>