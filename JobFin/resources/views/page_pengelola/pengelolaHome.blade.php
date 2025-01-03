<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelola Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <style>
        body {
            background-color: #FFDFB3;
            background-image: url("asset/circle.png");
            background-size: 300px;
            background-repeat: no-repeat; 
            background-position: bottom right;
        }

        .admin-container {
            padding: 2rem;
        }
        .admin-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        .table-responsive {
            margin-top: 1rem;
        }
        .status-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.875rem;
        }
        .status-completed {
            background: #28a745;
            color: white;
        }
        .status-pending {
            background: #dc3545;
            color: white;
        }
        .navbar-admin {
            background-color: #FFB39A;
            padding: 1rem 5%;
        }
        .navbar-brand {
            color: #F5642A !important;
            font-weight: bold;
        }
        .nav-link {
            color: #F5642A !important;
            font-weight: 500;
        }
        .nav-link:hover {
            color: #d14718 !important;
        }
        .table th {
            background-color: #FFB39A;
            color: white !important;
            text-align: center !important;
            vertical-align: middle !important;
            padding: 15px !important;
            font-weight: 500;
            white-space: nowrap;
        }
        .table td {
            text-align: center;
            vertical-align: middle;
        }
        .analytics-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            height: 300px; /* Mengatur tinggi tetap */
        }
        .stat-card {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
            margin-bottom: 1rem;
        }
        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #F5642A;
            margin: 0;
        }
        .chart-container {
            position: relative;
            height: 200px; /* Mengatur tinggi chart */
            width: 100%;
        }
        .btn-danger {
            margin-left: 5px;
        }
        .form-control:focus {
            border-color: #F5642A;
            box-shadow: 0 0 0 0.2rem rgba(245, 100, 42, 0.25);
        }
        .btn-primary {
            background-color: #F5642A;
            border-color: #F5642A;
        }
        .btn-primary:hover {
            background-color: #d54e1f;
            border-color: #d54e1f;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-admin">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ URL('asset/logo.png') }}" alt="JobFin Logo" height="40">
                Pengelola Dashboard
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link" style="background: none; border: none; color: #F5642A;">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="admin-container">
        <!-- Analytics Section -->
        <div class="admin-card">
            <h2 class="mb-4" style="color: #F5642A;">Analytics Hasil Test</h2>
            <div class="row">
                <!-- Statistik Umum -->
                <div class="col-12 mb-4">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="stat-card">
                                <h5>Total User</h5>
                                <p class="stat-number">{{ count($users) }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card">
                                <h5>Sudah Test Teknis</h5>
                                <p class="stat-number">{{ $analytics['totalTesTeknis'] }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card">
                                <h5>Sudah Test Bakat</h5>
                                <p class="stat-number">{{ $analytics['totalTesBakat'] }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card">
                                <h5>Sudah Ditempatkan</h5>
                                <p class="stat-number">{{ $analytics['totalPenempatan'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts -->
                <div class="col-md-6">
                    <div class="analytics-card">
                        <h4 class="text-center mb-3">Distribusi Hasil Test Teknis</h4>
                        <div class="chart-container">
                            <canvas id="teknisChart"></canvas>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="analytics-card">
                        <h4 class="text-center mb-3">Distribusi Hasil Test Bakat</h4>
                        <div class="chart-container">
                            <canvas id="bakatChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create User Section -->
        <div class="admin-card mb-4">
            <h2 class="mb-4" style="color: #F5642A;">Tambah User Baru</h2>
            <form action="{{ route('pengelola.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Tambah User</button>
            </form>
        </div>

        <!-- User Table Section -->
        <div class="admin-card">
            <h2 class="mb-4" style="color: #F5642A;">Daftar User Terdaftar</h2>
            <div class="table-responsive">
                <table class="table table-striped" id="userTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Tanggal Lahir</th>
                            <th>No. Telpon</th>
                            <th>Pendidikan</th>
                            <th>Prodi</th>
                            <th>Test Teknis</th>
                            <th>Test Bakat</th>
                            <th>Hasil Penempatan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->alamat ?? '-' }}</td>
                            <td>{{ $user->tanggal_lahir ?? '-' }}</td>
                            <td>{{ $user->no_telpon ?? '-' }}</td>
                            <td>{{ $user->pendidikan_terakhir ?? '-' }}</td>
                            <td>{{ $user->prodi ?? '-' }}</td>
                            <td>{{ $user->tes_teknis ?? 'Belum ada' }}</td>
                            <td>{{ $user->tes_bakat ?? 'Belum ada' }}</td>
                            <td>{{ $user->penempatan_kerja ?? 'Belum ada' }}</td>
                            <td>
                                <a href="{{ route('pengelola.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('pengelola.delete', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus user ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            $('#userTable').DataTable({
                responsive: true,
                pageLength: 2,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    zeroRecords: "Tidak ada data yang ditemukan",
                    info: "",
                    infoEmpty: "",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                }
            });
        });

        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12,
                        padding: 10
                    }
                }
            }
        };

        const teknisCtx = document.getElementById('teknisChart').getContext('2d');
        new Chart(teknisCtx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($analytics['teknisLabels']) !!},
                datasets: [{
                    data: {!! json_encode($analytics['teknisData']) !!},
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40']
                }]
            },
            options: chartOptions
        });

        const bakatCtx = document.getElementById('bakatChart').getContext('2d');
        new Chart(bakatCtx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($analytics['bakatLabels']) !!},
                datasets: [{
                    data: {!! json_encode($analytics['bakatData']) !!},
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0']
                }]
            },
            options: chartOptions
        });
    </script>
</body>
</html>
