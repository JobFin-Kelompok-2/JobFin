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
    </style>
</head>
<body>
    @include("component.navbarLogin")
    
    <div class="hasil-container">
        <div class="hasil-card">
            <h2 class="text-center mb-4">Hasil Test RIASEC</h2>
            
            <div class="chart-container" style="position: relative; height:60vh; width:100%">
                <canvas id="riasecChart"></canvas>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                const ctx = document.getElementById('riasecChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Realistic', 'Investigative', 'Artistic', 'Social', 'Enterprising', 'Conventional'],
                        datasets: [{
                            label: 'Skor RIASEC',
                            data: [
                                {{ ($skor['realistic'] / $totalSkor) * 100 }},
                                {{ ($skor['investigative'] / $totalSkor) * 100 }},
                                {{ ($skor['artistic'] / $totalSkor) * 100 }},
                                {{ ($skor['social'] / $totalSkor) * 100 }},
                                {{ ($skor['enterprising'] / $totalSkor) * 100 }},
                                {{ ($skor['conventional'] / $totalSkor) * 100 }}
                            ],
                            backgroundColor: [
                                '#FF6384',
                                '#36A2EB',
                                '#FFCE56',
                                '#4BC0C0',
                                '#9966FF',
                                '#FF9F40'
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

            <div class="hasil-card">
                <h3 class="mb-4">Feedback Test Teknis</h3>
                
                @if(Auth::user()->feedback_teknis)
                    <div class="current-feedback mb-4">
                        <h5>Feedback Anda:</h5>
                        <p class="p-3 bg-light rounded">{{ Auth::user()->feedback_teknis }}</p>
                        
                        <div class="mt-2">
                            <button class="btn btn-warning btn-sm" onclick="showEditForm()">Edit Feedback</button>
                            <form action="{{ route('teknis.feedback.delete') }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus feedback?')">
                                    Hapus Feedback
                                </button>
                            </form>
                        </div>
                    </div>
                @endif

                <form id="feedbackForm" action="{{ route('teknis.feedback.submit') }}" method="POST" 
                      style="{{ Auth::user()->feedback_teknis ? 'display:none;' : '' }}">
                    @csrf
                    <div class="mb-3">
                        <label for="feedback_teknis" class="form-label">Berikan feedback Anda tentang test teknis ini:</label>
                        <textarea class="form-control" id="feedback_teknis" name="feedback_teknis" rows="4" 
                                  placeholder="Bagaimana pendapat Anda tentang test ini? Apa yang perlu diperbaiki?">{{ Auth::user()->feedback_teknis }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Feedback</button>
                </form>
            </div>
        </div>

        <div class="text-center mt-4">
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
