<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #FFDFB3;
            background-image: url("../asset/circle.png");
            background-size: 300px;
            background-repeat: no-repeat; 
            background-position: bottom right;
        }

        .edit-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 20px;
        }

        .edit-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            padding: 2rem;
        }

        .form-label {
            color: #F5642A;
            font-weight: 500;
        }

        .form-control:focus {
            border-color: #F5642A;
            box-shadow: 0 0 0 0.25rem rgba(245, 100, 42, 0.25);
        }

        .btn-primary {
            background-color: #F5642A;
            border-color: #F5642A;
        }

        .btn-primary:hover {
            background-color: #d14718;
            border-color: #d14718;
        }

        .navbar-admin {
            background-color: #FFB39A;
            padding: 1rem 5%;
        }

        .navbar-brand {
            color: #F5642A !important;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-admin">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ URL('asset/logo.png') }}" alt="JobFin Logo" height="40">
                Edit User
            </a>
        </div>
    </nav>

    <div class="edit-container">
        <div class="edit-card">
            <h2 class="mb-4" style="color: #F5642A;">Edit Data User</h2>

            <form action="{{ route('admin.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $user->alamat }}">
                </div>

                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $user->tanggal_lahir }}">
                </div>

                <div class="mb-3">
                    <label for="no_telpon" class="form-label">No. Telpon</label>
                    <input type="text" class="form-control" id="no_telpon" name="no_telpon" value="{{ $user->no_telpon }}">
                </div>

                <div class="mb-3">
                    <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                    <input type="text" class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir" value="{{ $user->pendidikan_terakhir }}">
                </div>

                <div class="mb-3">
                    <label for="prodi" class="form-label">Program Studi</label>
                    <input type="text" class="form-control" id="prodi" name="prodi" value="{{ $user->prodi }}">
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Update Data</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
