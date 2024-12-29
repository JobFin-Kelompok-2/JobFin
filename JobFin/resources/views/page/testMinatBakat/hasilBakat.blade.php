<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Tes Bakat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
        .score-item {
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
            background: #e9ecef;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    @include("component.navbarLogin")
    
    <div class="hasil-container">
        <div class="hasil-card">
            <h2 class="text-center mb-4">Hasil Tes Bakat</h2>
            
            @php
                $skor = session('skor_bakat');
                $totalSkor = array_sum($skor);
                $kategoriTertinggi = array_search(max($skor), $skor);
            @endphp

            <div class="score-item">
                <h4>Aspek Kreatif</h4>
                <div class="progress">
                    <div class="progress-bar bg-primary" 
                         role="progressbar" 
                         style="width: {{ ($skor['kreatif'] / $totalSkor) * 100 }}%" 
                         aria-valuenow="{{ ($skor['kreatif'] / $totalSkor) * 100 }}" 
                         aria-valuemin="0" 
                         aria-valuemax="100">
                        {{ round(($skor['kreatif'] / $totalSkor) * 100) }}%
                    </div>
                </div>
            </div>

            <div class="score-item">
                <h4>Aspek Sosial</h4>
                <div class="progress">
                    <div class="progress-bar bg-success" 
                         role="progressbar" 
                         style="width: {{ ($skor['sosial'] / $totalSkor) * 100 }}%" 
                         aria-valuenow="{{ ($skor['sosial'] / $totalSkor) * 100 }}" 
                         aria-valuemin="0" 
                         aria-valuemax="100">
                        {{ round(($skor['sosial'] / $totalSkor) * 100) }}%
                    </div>
                </div>
            </div>

            <div class="score-item">
                <h4>Aspek Teknikal</h4>
                <div class="progress">
                    <div class="progress-bar bg-warning" 
                         role="progressbar" 
                         style="width: {{ ($skor['teknikal'] / $totalSkor) * 100 }}%" 
                         aria-valuenow="{{ ($skor['teknikal'] / $totalSkor) * 100 }}" 
                         aria-valuemin="0" 
                         aria-valuemax="100">
                        {{ round(($skor['teknikal'] / $totalSkor) * 100) }}%
                    </div>
                </div>
            </div>

            <div class="score-item">
                <h4>Aspek Manajerial</h4>
                <div class="progress">
                    <div class="progress-bar bg-info" 
                         role="progressbar" 
                         style="width: {{ ($skor['manajerial'] / $totalSkor) * 100 }}%" 
                         aria-valuenow="{{ ($skor['manajerial'] / $totalSkor) * 100 }}" 
                         aria-valuemin="0" 
                         aria-valuemax="100">
                        {{ round(($skor['manajerial'] / $totalSkor) * 100) }}%
                    </div>
                </div>
            </div>

            <div class="rekomendasi">
                <h3>Rekomendasi Bidang</h3>
                <p>Berdasarkan hasil tes, Anda memiliki kecenderungan yang kuat di bidang 
                    <strong>
                    @switch($kategoriTertinggi)
                        @case('kreatif')
                            Kreatif (Seni, Desain, dan Kreativitas)
                            @break
                        @case('sosial')
                            Sosial (Komunikasi dan Hubungan Interpersonal)
                            @break
                        @case('teknikal')
                            Teknikal (Teknologi dan Engineering)
                            @break
                        @case('manajerial')
                            Manajerial (Kepemimpinan dan Organisasi)
                            @break
                    @endswitch
                    </strong>
                </p>
                <p>Anda disarankan untuk mengembangkan karir di bidang tersebut.</p>
            </div>
        </div>  

        <div class="text-center">
            <a href="{{ route('page.home') }}" class="btn btn-primary">Kembali ke Beranda</a>
        </div>
    </div>
</body>
</html>