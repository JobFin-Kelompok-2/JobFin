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
            align-items: center;
            gap: 10px;
        }

        .right .profile{
            width: 30px;
        }

        .right h3{
            font-size: 14px;
            font-weight: 600;
        }

        .right .profile:hover {
            transform: scale(1.05);
            cursor: pointer;
        }

        .right-link {
            text-decoration: none;
            color: inherit;
            cursor: pointer;
            position: relative;
        }

        .right-link:hover {
            color: inherit;
        }

        .profile-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: none;
            min-width: 200px;
            z-index: 1000;
        }

        .profile-dropdown.show {
            display: block;
        }

        .dropdown-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #333;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .dropdown-item:hover {
            background-color: #FFB39A;
            color: #F5642A;
        }

        .dropdown-divider {
            border-top: 1px solid #eee;
            margin: 0;
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
                <a href="{{ route('page.home') }}" class="logoini">
                    <img src="/asset/logo.png" alt="JobFin Logo">
                </a>
                <div class="option">
                    <a href="#" class="nav-link">Tentang Kami</a>
                    <a href="#" class="nav-link">Layanan</a>
                    <a href="#" class="nav-link">Informasi Lanjut</a>
                </div>
            </div>
            
            <div class="right" onclick="toggleDropdown(event)">
                <img class="profile" src="/asset/user-filled.png" alt="">
                <h3>{{ auth()->user()->name }}</h3>
                <div class="profile-dropdown" id="profileDropdown">
                    <a href="{{ route('profile.index') }}" class="dropdown-item">
                        <i class="fas fa-user"></i>
                        Lihat Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            
        </nav>
    </header> 

    <script>
    function toggleDropdown(event) {
        event.stopPropagation();
        const dropdown = document.getElementById('profileDropdown');
        dropdown.classList.toggle('show');
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('profileDropdown');
        if (dropdown.classList.contains('show')) {
            dropdown.classList.remove('show');
        }
    });
    </script>
</body>
