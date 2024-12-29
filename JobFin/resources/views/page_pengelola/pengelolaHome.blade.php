<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelola Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #FFDFB3;
        }

        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .nav-link {
            font-size: 1rem;
            padding: 0.5rem 1rem;
        }
        .nav-link:hover {
            color: #D95D00; /* Warna saat hover */
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
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Pengelola Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
</body>
</html>
