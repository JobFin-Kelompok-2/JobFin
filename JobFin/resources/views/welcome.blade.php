<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>JobFin - Aplikasi Kepegawaian</title>
    <style>
        body {
            background-color: #FFDFB3;
            overflow-x: hidden;
        }

        .hero-section {
            display: flex;
            align-items: center;
            padding: 80px 5%;
            min-height: 100vh;
            position: relative;
        }

        .hero-content {
            flex: 1;
            padding-right: 50px;
        }

        .hero-image {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
        }
        
        .hero-image img {
            max-width: 100%;
            height: auto;
            border-radius: 20px;
        }

        .hero-title {
            color: #F5642A;
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .hero-subtitle {
            color: #333;
            font-size: 1.2rem;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn-primary {
            background-color: #F5642A;
            border: none;
            padding: 12px 30px;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #d14718;
        }

        .btn-outline {
            border: 2px solid #F5642A;
            color: #F5642A;
            padding: 12px 30px;
            font-weight: 600;
        }

        .btn-outline:hover {
            background-color: #F5642A;
            color: white;
        }

        .features-section {
            background-color: #FFB39A;
            padding: 80px 5%;
        }

        .feature-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .feature-icon {
            color: #F5642A;
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .hero-section {
                flex-direction: column;
                text-align: center;
                padding: 40px 20px;
            }

            .hero-content {
                padding-right: 0;
                margin-bottom: 40px;
            }

            .cta-buttons {
                justify-content: center;
            }

            .hero-title {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    @include('component.navbar')

    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">What is JobFin?</h1>
            <p class="hero-subtitle">
            JobFin merupakan platform inovatif yang dirancang untuk membantu individu menemukan karir yang sesuai dengan minat, bakat, dan tujuan hidup mereka. Kami percaya bahwa setiap orang memiliki potensi unik yang harus dikembangkan, dan kami ada untuk mendukung perjalanan tersebut
            </p>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('login') }}'">Get Started!</button>
        </div>
        <div class="hero-image">
            <img src="../asset/people.png" alt="JobFin Hero Image">
        </div>
    </section>

    <section class="features-section">
        <div class="container">
            <h2 class="text-center mb-5" style="color: #F5642A; font-weight: 700;">Fitur Unggulan Kami</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">🎯</div>
                        <h3 style="color: #F5642A;">Tes Teknis</h3>
                        <p>Temukan jalur karier yang sesuai dengan kepribadian Anda melalui assessment komprehensif yang dirancang khusus untuk mengidentifikasi potensi dan karakteristik unik Anda.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">🌟</div>
                        <h3 style="color: #F5642A;">Tes Minat & Bakat</h3>
                        <p>Eksplorasi potensi terbaik Anda melalui analisis mendalam tentang minat dan bakat, membantu Anda menemukan bidang pekerjaan yang paling sesuai dengan passion Anda.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">🏙</div>
                        <h3 style="color: #F5642A;">Penempatan Kerja</h3>
                        <p>Dapatkan rekomendasi penempatan kerja yang tepat di perusahaan-perusahaan terkemuka, sesuai dengan hasil tes dan kompetensi Anda untuk memaksimalkan potensi karier.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Di bagian bawah body, sebelum closing tag -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#F5642A'
            });
        @endif
    });
</script>
</body>
</html>