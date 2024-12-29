<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Test dan Penempatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #FFDFB3;
        }

        .wrapper {
            display: flex;
            min-height: calc(100vh - 76px);
        }

        .sidebar {
            width: 250px;
            background-color: #FFB39A;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            color: #F5642A;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .sidebar-link:hover {
            background-color: #F5642A;
            color: white;
        }

        .sidebar-link.active {
            background-color: #F5642A;
            color: white;
        }

        .hasil-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 20px;
        }
        .hasil-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        .hasil-section {
            margin: 1.5rem 0;
            padding: 1.5rem;
            border-radius: 8px;
            background: #f8f9fa;
        }
        .empty-result {
            color: #6c757d;
            font-style: italic;
        }
        .penempatan-section {
            background: #F5642A;
            color: white;
            padding: 2rem;
            border-radius: 8px;
            margin-top: 2rem;
        }
        .test-status {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.875rem;
            margin-left: 0.5rem;
        }
        .status-completed {
            background: #28a745;
            color: white;
        }
        .status-pending {
            background: #dc3545;
            color: white;
        }

        @media (max-width: 768px) {
            .wrapper {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    @include("component.navbarLogin")

    <div class="wrapper">
        <div class="sidebar">
            <a href="{{ route('profile.index') }}" class="sidebar-link">
                <i class="fas fa-user"></i>
                Profile
            </a>
            <a href="{{ route('profile.edit') }}" class="sidebar-link active">
                <i class="fas fa-edit"></i>
                Edit Profile
            </a>
            <a href="{{ route('hasil.penempatan') }}" class="sidebar-link">
                <i class="fas fa-chart-bar"></i>
                Hasil Test
            </a>
            <a href="{{ route('page.home') }}" class="sidebar-link">
                <i class="fas fa-home"></i>
                Kembali ke Beranda
            </a>
        </div>
    
    
        <div class="hasil-container">
            <div class="hasil-card">
                <h2 class="text-center mb-4">Hasil Test dan Penempatan</h2>
                
                <div class="hasil-section">
                    <h4>
                        Hasil Test Teknis
                        <span class="test-status {{ $statusTest['teknis'] ? 'status-completed' : 'status-pending' }}">
                            {{ $statusTest['teknis'] ? 'Selesai' : 'Belum Test' }}
                        </span>
                    </h4>
                    @if($statusTest['teknis'])
                        <p>{{ $user->tes_teknis }}</p>
                    @else
                        <p class="empty-result">Anda belum melakukan test teknis</p>
                    @endif
                </div>

                <div class="hasil-section">
                    <h4>
                        Hasil Test Bakat
                        <span class="test-status {{ $statusTest['bakat'] ? 'status-completed' : 'status-pending' }}">
                            {{ $statusTest['bakat'] ? 'Selesai' : 'Belum Test' }}
                        </span>
                    </h4>
                    @if($statusTest['bakat'])
                        <p>{{ $user->tes_bakat }}</p>
                    @else
                        <p class="empty-result">Anda belum melakukan test bakat</p>
                    @endif
                </div>

                <div class="penempatan-section">
                    <h3>Rekomendasi Penempatan Kerja</h3>
                    @if($statusTest['teknis'] && $statusTest['bakat'])
                        <p class="fs-5">{{ $user->penempatan_kerja }}</p>
                    @else
                        <p class="fs-5">Lakukan kedua test terlebih dahulu</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>