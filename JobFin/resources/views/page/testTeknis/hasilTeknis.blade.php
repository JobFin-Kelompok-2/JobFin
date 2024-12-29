<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Test RIASEC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #FFDFB3;
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
        .kategori-item {
            margin: 1.5rem 0;
            padding: 1rem;
            border-radius: 8px;
            background: #f8f9fa;
        }
        .progress {
            height: 25px;
            margin-top: 10px;
        }
        .rekomendasi {
            margin-top: 2rem;
            padding: 1.5rem;
            background: #F5642A;
            border-radius: 8px;
            color: white;
        }
    </style>
</head>
<body>
    @include("component.navbarLogin")
    
    <div class="hasil-container">
        <div class="hasil-card">
            <h2 class="text-center mb-4">Hasil Test RIASEC</h2>
            
            @foreach($skor as $tipe => $nilai)
            <div class="kategori-item">
                <h4>{{ ucfirst($tipe) }}</h4>
                <div class="progress">
                    <div class="progress-bar" 
                         role="progressbar" 
                         style="width: {{ ($nilai/25) * 100 }}%; background-color: #F5642A;" 
                         aria-valuenow="{{ ($nilai/25) * 100 }}" 
                         aria-valuemin="0" 
                         aria-valuemax="100">
                        {{ $nilai }} poin
                    </div>
                </div>
            </div>
            @endforeach

            <div class="rekomendasi">
                <h3>Tipe Kepribadian Dominan Anda</h3>
                <div class="top-three">
                    @foreach($topThree as $tipe => $nilai)
                        <div class="mb-3">
                            <h4>{{ ucfirst($tipe) }}</h4>
                            <p>{{ $deskripsi[$tipe] }}</p>
                        </div>
                    @endforeach
                </div>

                <h3 class="mt-4">Rekomendasi Karir</h3>
                <ul>
                    @foreach($rekomendasi as $karir)
                        <li>{{ $karir }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('page.home') }}" class="btn btn-primary">Kembali ke Beranda</a>
        </div>
    </div>
</body>
</html>
