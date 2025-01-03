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
        .current-feedback {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #000;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
        }
        .form-control:focus {
            border-color: #F5642A;
            box-shadow: 0 0 0 0.2rem rgba(245, 100, 42, 0.25);
        }
        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            padding: 1rem;
            border-radius: 8px;
        }
        .list-group-item {
            margin-bottom: 1rem;
            border-radius: 8px !important;
        }
        .list-group-item h5 {
            color: #F5642A;
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>
    @include("component.navbarLogin")
    
    <div class="hasil-container">
        <div class="hasil-card">
            <h2 class="text-center mb-4">Hasil Tes Bakat</h2>
            
            <div class="chart-container" style="position: relative; height:60vh; width:100%">
                <canvas id="bakatChart"></canvas>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                const ctx = document.getElementById('bakatChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Kreatif', 'Sosial', 'Teknikal', 'Manajerial'],
                        datasets: [{
                            label: 'Skor Bakat',
                            data: [
                                {{ ($skor['kreatif'] / $totalSkor) * 100 }},
                                {{ ($skor['sosial'] / $totalSkor) * 100 }},
                                {{ ($skor['teknikal'] / $totalSkor) * 100 }},
                                {{ ($skor['manajerial'] / $totalSkor) * 100 }}
                            ],
                            backgroundColor: [
                                '#FF6384',
                                '#36A2EB',
                                '#FFCE56',
                                '#4BC0C0'
                            ]
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 100,
                                ticks: {
                                    callback: function(value) {
                                        return value + '%';
                                    }
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            </script>
        </div>

        <div class="hasil-card">
            <h3 class="mb-4">Hasil Kategori Bakat</h3>
            
            @php
                $hasilBakat = Auth::user()->tes_bakat;
            @endphp

            <div class="alert alert-success">
                <h4 class="alert-heading">Kategori Bakat Anda:</h4>
                <p class="mb-0">{{ $hasilBakat }}</p>
            </div>

            <div class="mt-4">
                <h4>Deskripsi Kategori:</h4>
                <ul class="list-group">
                    <li class="list-group-item">
                        <h5>Kreatif (Seni, Desain, dan Kreativitas)</h5>
                        <p>Anda memiliki bakat dalam bidang seni, desain, dan aktivitas kreatif. Cocok untuk pekerjaan yang membutuhkan kreativitas dan inovasi.</p>
                    </li>
                    <li class="list-group-item">
                        <h5>Sosial (Komunikasi dan Hubungan Interpersonal)</h5>
                        <p>Anda memiliki bakat dalam berkomunikasi dan menjalin hubungan dengan orang lain. Cocok untuk pekerjaan yang melibatkan interaksi sosial.</p>
                    </li>
                    <li class="list-group-item">
                        <h5>Teknikal (Teknik dan Analisis)</h5>
                        <p>Anda memiliki bakat dalam bidang teknis dan analitis. Cocok untuk pekerjaan yang membutuhkan pemecahan masalah dan analisis.</p>
                    </li>
                    <li class="list-group-item">
                        <h5>Manajerial (Kepemimpinan dan Manajemen)</h5>
                        <p>Anda memiliki bakat dalam memimpin dan mengelola. Cocok untuk pekerjaan yang membutuhkan kemampuan kepemimpinan dan pengambilan keputusan.</p>
                    </li>
                </ul>
            </div>
        </div>

        <div class="hasil-card">
            <h3 class="mb-4">Feedback Test Bakat</h3>
            
            @if(Auth::user()->feedback_bakat)
                <div class="current-feedback mb-4">
                    <h5>Feedback Anda:</h5>
                    <p class="p-3 bg-light rounded">{{ Auth::user()->feedback_bakat }}</p>
                    
                    <div class="mt-2">
                        <button class="btn btn-warning btn-sm" onclick="showEditForm()">Edit Feedback</button>
                        <form action="{{ route('bakat.feedback.delete') }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus feedback?')">
                                Hapus Feedback
                            </button>
                        </form>
                    </div>
                </div>
            @endif

            <form id="feedbackForm" action="{{ route('bakat.feedback.submit') }}" method="POST" 
                  style="{{ Auth::user()->feedback_bakat ? 'display:none;' : '' }}">
                @csrf
                <div class="mb-3">
                    <label for="feedback_bakat" class="form-label">Berikan feedback Anda tentang test bakat ini:</label>
                    <textarea class="form-control" id="feedback_bakat" name="feedback_bakat" rows="4" 
                              placeholder="Bagaimana pendapat Anda tentang test ini? Apa yang perlu diperbaiki?">{{ Auth::user()->feedback_bakat }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Feedback</button>
            </form>
        </div>

        <div class="text-center">
            <a href="{{ route('page.home') }}" class="btn btn-primary">Kembali ke Beranda</a>
        </div>
    </div>

    <script>
    function showEditForm() {
        document.querySelector('.current-feedback').style.display = 'none';
        document.getElementById('feedbackForm').style.display = 'block';
    }
    </script>
</body>
</html>