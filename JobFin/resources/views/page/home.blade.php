<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>Home</title>
    <style>
        .container-home-body {
            text-align: center;
            margin-top: 50px;
        }
        .logo-besar {
            margin-bottom: 30px;
        }
        .body-card {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .card {
            width: 300px;
            border: none;
            border-radius: 25px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.05);
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .minatbakat {
            margin-top: 22px
        }




        .container-home-bottom {
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* border: red solid; */
        }

        .penjelasan-teknis, .penjelasan-minatbakat {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 15px;
            /* flex: 1; */
            width: 60%;
        }

        .text h4 {
            font-weight: bold;
        }

        .quotes h2 {
            font-style: italic;
            color: #F5642A;
        }

        .penjelasan-minatbakat .text{
            text-align: right;
            margin-right: 15px;
        }

        .materi-section {
            margin-top: 50px;
            padding: 20px;
        }

        .materi-title {
            color: #F5642A;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }

        .materi-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            padding: 0 20px;
        }

        .materi-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            text-decoration: none;
            color: inherit;
        }

        .materi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .materi-card h3 {
            color: #F5642A;
            margin-bottom: 10px;
            font-size: 1.25rem;
        }

        .materi-card p {
            color: #666;
            margin-bottom: 0;
        }

        @media (max-width: 768px) {
            .materi-grid {
                grid-template-columns: 1fr;
            }
        }
        
    </style>
</head>
<body>
    @include("component.navbarLogin")
    <div class="container-home-body">
        <div class="logo-besar">
            <img src="asset/logo.png" alt="JobFin Logo" class="img-fluid">
        </div>

        <div class="body-card">
            <div class="card">
                <img src="asset/testeknis.png" class="card-img-top" alt="Tes Teknis">
                <div class="card-body teknis">
                    <h5 class="card-title">Tes Teknis</h5>
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('page.testTeknis.teknisHome') }}'">Tes Teknis!</button>
                </div>
            </div>
            <div class="card">
                <img src="asset/tesminatbkat.png" class="card-img-top" alt="Tes Minat Bakat">
                <div class="card-body minatbakat">
                    <h5 class="card-title">Tes Minat Bakat</h5>
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('page.testMinatBakat.bakatHome') }}'">Tes Minat Bakat!</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-home-bottom d-flex flex-column mt-5">
        <div class="penjelasan-teknis d-flex align-items-start mb-4">
            <img src="asset/testeknis.png" alt="Tes Teknis" class="img-fluid me-3" style="width: 250px;">
            <div class="text">
                <h4>Apa itu tes teknis?</h4>
                <p>Tes teknis adalah sebuah proses evaluasi yang dirancang untuk mengukur kemampuan teknis seseorang dalam bidang tertentu, seperti pemrograman, analisis data, desain, atau keterampilan teknis lainnya yang relevan dengan pekerjaan atau proyek tertentu.</p>
            </div>
        </div>
        <div class="d-flex flex-column align-items-end">
            <div class="penjelasan-minatbakat d-flex align-items-end mb-4">
                <div class="text">
                    <h4>Apa itu tes minat dan bakat?</h4>
                    <p>Tes minat dan bakat adalah jenis evaluasi yang bertujuan untuk membantu seseorang memahami minat, kepribadian, serta bakat atau kemampuan alami yang dimilikinya. Tes ini biasanya digunakan untuk panduan dalam pengambilan keputusan penting, seperti pemilihan jurusan pendidikan, karier, atau pengembangan diri.</p>
                </div>
                <img src="asset/tesminatbkat.png" alt="Tes Minat Bakat" class="img-fluid me-3" style="width: 250px;">
            </div>
        </div>
        <div class="quotes text-center mt-4">
            <h2>"Believe in yourself, even when no one else does."</h2>
        </div>
    </div>

    <div class="materi-section">
        <h2 class="materi-title">Materi Pembelajaran</h2>
        <div class="materi-grid">
            @foreach($materis as $materi)
                <a href="{{ $materi->link }}" target="_blank" class="materi-card">
                    <h3>{{ $materi->judul }}</h3>
                    <p>{{ $materi->keterangan }}</p>
                </a>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil Login!',
                    text: 'Selamat datang {{ auth()->user()->name }}',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>
</body>
</html>