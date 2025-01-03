<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
            padding-bottom: 23px !important;
        }
        .table td {
            text-align: center;
            vertical-align: middle;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #F5642A !important;
            color: white !important;
            border: 1px solid #F5642A !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #d14718 !important;
            color: white !important;
            border: 1px solid #d14718 !important;
        }
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #F5642A;
            border-radius: 5px;
        }
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #F5642A;
            border-radius: 5px;
        }
        #feedbackTable td {
            max-width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        #feedbackTable td:hover {
            white-space: normal;
            overflow: visible;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-admin">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ URL('asset/logo.png') }}" alt="JobFin Logo" height="40">
                Admin Dashboard
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarAdmin">
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
        <!-- Tabel User -->
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
                            <th>Test RIASEC</th>
                            <th>Test Bakat</th>
                            <th>Penempatan Kerja</th>
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
                            <td>
                                <span class="status-badge {{ $user->tes_teknis ? 'status-completed' : 'status-pending' }}">
                                    {{ $user->tes_teknis ?: 'Belum Test' }}
                                </span>
                            </td>
                            <td>
                                <span class="status-badge {{ $user->tes_bakat ? 'status-completed' : 'status-pending' }}">
                                    {{ $user->tes_bakat ?: 'Belum Test' }}
                                </span>
                            </td>
                            <td>{{ $user->penempatan_kerja ?: 'Belum ada penempatan' }}</td>
                            <td>
                                <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.delete', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Feedback Section -->
        <div class="admin-card mt-4">
            <h2 class="mb-4" style="color: #F5642A;">Daftar Feedback User</h2>
            <div class="table-responsive">
                <table class="table table-striped" id="feedbackTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Feedback Test Teknis</th>
                            <th>Feedback Test Bakat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)
                            @if($user->feedback_teknis || $user->feedback_bakat)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->feedback_teknis ?? 'Belum ada feedback' }}</td>
                                    <td>{{ $user->feedback_bakat ?? 'Belum ada feedback' }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabel Materi -->
        <div class="admin-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 style="color: #F5642A;">Daftar Materi</h2>
                <button class="btn btn-primary" style="background-color: #F5642A; border: none;" 
                        onclick="window.location.href='{{ route('admin.materi.create') }}'">
                    Tambah Materi
                </button>
            </div>
            
            <div class="table-responsive">
                <table class="table table-striped" id="materiTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Keterangan</th>
                            <th>Link</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($materis as $index => $materi)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $materi->judul }}</td>
                            <td>{{ $materi->keterangan }}</td>
                            <td>
                                <a href="{{ $materi->link }}" target="_blank">{{ $materi->link }}</a>
                            </td>
                            <td>
                                <a href="{{ route('admin.materi.edit', $materi->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.materi.delete', $materi->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus materi ini?')">
                                        Delete
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
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

            $('#materiTable').DataTable({
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

            $('#feedbackTable').DataTable({
                "pageLength": 2,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Tidak ada data yang ditemukan",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data yang tersedia",
                    "infoFiltered": "(difilter dari _MAX_ total data)",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });
        });
    </script>
</body>
</html>