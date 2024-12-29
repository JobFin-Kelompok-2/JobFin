<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
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

        .main-content {
            flex: 1;
            padding: 20px;
            background-color: #FFDFB3;
        }

        .profile-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .profile-field {
            margin-bottom: 1.5rem;
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

        <div class="main-content">
            <div class="profile-card">
                <div class="profile-header">
                    <h2>Edit Profile</h2>
                </div>
                
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="profile-field">
                        <label class="form-label fw-bold">Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}">
                    </div>

                    <div class="profile-field">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}">
                    </div>

                    <div class="profile-field">
                        <label class="form-label fw-bold">Alamat</label>
                        <input type="text" name="alamat" class="form-control" value="{{ auth()->user()->alamat }}">
                    </div>

                    <div class="profile-field">
                        <label class="form-label fw-bold">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ auth()->user()->tanggal_lahir }}">
                    </div>

                    <div class="profile-field">
                        <label class="form-label fw-bold">No. Telepon</label>
                        <input type="text" name="no_telpon" class="form-control" value="{{ auth()->user()->no_telpon }}">
                    </div>

                    <div class="profile-field">
                        <label class="form-label fw-bold">Pendidikan Terakhir</label>
                        <select name="pendidikan_terakhir" class="form-control">
                            <option value="">Pilih Pendidikan</option>
                            <option value="SMA" {{ auth()->user()->pendidikan_terakhir == 'SMA' ? 'selected' : '' }}>SMA/SMK</option>
                            <option value="D3" {{ auth()->user()->pendidikan_terakhir == 'D3' ? 'selected' : '' }}>D3</option>
                            <option value="S1" {{ auth()->user()->pendidikan_terakhir == 'S1' ? 'selected' : '' }}>S1</option>
                            <option value="S2" {{ auth()->user()->pendidikan_terakhir == 'S2' ? 'selected' : '' }}>S2</option>
                        </select>
                    </div>

                    <div class="profile-field">
                        <label class="form-label fw-bold">Program Studi</label>
                        <input type="text" name="prodi" class="form-control" value="{{ auth()->user()->prodi }}">
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html> 