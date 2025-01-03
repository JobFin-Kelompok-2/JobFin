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

        .chart-container {
            position: relative;
            height: 300px;
            margin-bottom: 2rem;
            padding: 1rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .row {
            margin: 0 -15px;
        }

        .col-md-6 {
            padding: 0 15px;
        }

        @media (max-width: 768px) {
            .wrapper {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                margin-bottom: 20px;
            }

            .chart-container {
                height: 250px;
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
            <a href="{{ route('profile.edit') }}" class="sidebar-link">
                <i class="fas fa-edit"></i>
                Edit Profile
            </a>
            <a href="{{ route('hasil.penempatan') }}" class="sidebar-link active">
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
                
                <!-- Chart Container -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="chart-container mb-4">
                            <h4 class="text-center">
                                Hasil Test Teknis
                                <span class="test-status {{ $statusTest['teknis'] ? 'status-completed' : 'status-pending' }}">
                                    {{ $statusTest['teknis'] ? 'Selesai' : 'Belum Test' }}
                                </span>
                            </h4>
                            <canvas id="teknisChart"></canvas>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="chart-container mb-4">
                            <h4 class="text-center">
                                Hasil Test Bakat
                                <span class="test-status {{ $statusTest['bakat'] ? 'status-completed' : 'status-pending' }}">
                                    {{ $statusTest['bakat'] ? 'Selesai' : 'Belum Test' }}
                                </span>
                            </h4>
                            <canvas id="bakatChart"></canvas>
                        </div>
                    </div>
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

    <!-- Add Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Konfigurasi umum untuk chart
        const chartOptions = {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        };

        // Chart untuk Test Teknis
        @if($statusTest['teknis'])
            const teknisCtx = document.getElementById('teknisChart').getContext('2d');
            const teknisData = '{{ $user->tes_teknis }}'.split(', ');
            new Chart(teknisCtx, {
                type: 'pie',
                data: {
                    labels: teknisData,
                    datasets: [{
                        data: teknisData.map(() => 1), // Equal portions
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
                    }]
                },
                options: chartOptions
            });
        @endif

        // Chart untuk Test Bakat
        @if($statusTest['bakat'])
            const bakatCtx = document.getElementById('bakatChart').getContext('2d');
            const bakatData = ['{{ $user->tes_bakat }}'];
            new Chart(bakatCtx, {
                type: 'pie',
                data: {
                    labels: bakatData,
                    datasets: [{
                        data: [1], // Single portion
                        backgroundColor: ['#4BC0C0']
                    }]
                },
                options: chartOptions
            });
        @endif
    </script>
</body>
</html>