<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Materi</title>
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
    <nav class="navbar navbar-expand-lg navbar-admin">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ URL('asset/logo.png') }}" alt="JobFin Logo" height="40">
                Edit Materi
            </a>
        </div>
    </nav>

    <div class="edit-container">
        <div class="edit-card">
            <h2 class="mb-4" style="color: #F5642A;">Edit Materi</h2>

            <form action="{{ route('admin.materi.update', $materi->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ $materi->judul }}" required>
                </div>

                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="4" required>{{ $materi->keterangan }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="link" class="form-label">Link</label>
                    <input type="url" class="form-control" id="link" name="link" value="{{ $materi->link }}" required>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Update Materi</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
