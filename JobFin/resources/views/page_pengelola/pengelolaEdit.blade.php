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
        }
        .edit-container {
            padding: 2rem;
        }
        .edit-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <div class="edit-container">
        <div class="edit-card">
            <h2 class="mb-4" style="color: #F5642A;">Edit Data User</h2>

            <form action="{{ route('pengelola.update', $user->id) }}" method="POST">
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
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $user->tanggal_lahir }}">
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

                <div class="mb-3">
                    <label for="penempatan_kerja" class="form-label">Penempatan Kerja</label>
                    <input type="text" class="form-control" id="penempatan_kerja" name="penempatan_kerja" value="{{ $user->penempatan_kerja }}">
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Update Data</button>
                    <a href="{{ route('pengelola.home') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
