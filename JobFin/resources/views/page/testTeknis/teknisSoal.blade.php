<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test RIASEC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #FFDFB3;
        }
        .teknis-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 20px;
        }
        .soal-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        .options-container {
            display: flex;
            justify-content: space-between;
            margin-top: 1.5rem;
            gap: 10px;
        }
        .option-button {
            flex: 1;
            padding: 10px;
            border: 2px solid #FFB39A;
            border-radius: 8px;
            background: white;
            color: #F5642A;
            transition: all 0.3s ease;
        }
        .option-button:hover {
            background: #FFB39A;
            color: white;
        }
        .option-button.selected {
            background: #F5642A;
            color: white;
            border-color: #F5642A;
        }
    </style>
</head>
<body>
    @include("component.navbarLogin")
    
    <div class="teknis-container">
        <form action="{{ route('teknis.submit') }}" method="POST" id="teknisForm">
            @csrf
            @foreach($soalTeknis as $index => $soal)
            <div class="soal-card">
                <h5>Pertanyaan {{ $index + 1 }}</h5>
                <p>{{ $soal->pertanyaan }}</p>
                <div class="options-container">
                    <input type="hidden" name="jawaban[{{ $soal->id }}]" id="jawaban_{{ $soal->id }}">
                    <button type="button" class="option-button" onclick="selectOption({{ $soal->id }}, 1)">
                        Sangat Tidak Sesuai
                    </button>
                    <button type="button" class="option-button" onclick="selectOption({{ $soal->id }}, 2)">
                        Tidak Sesuai
                    </button>
                    <button type="button" class="option-button" onclick="selectOption({{ $soal->id }}, 3)">
                        Netral
                    </button>
                    <button type="button" class="option-button" onclick="selectOption({{ $soal->id }}, 4)">
                        Sesuai
                    </button>
                    <button type="button" class="option-button" onclick="selectOption({{ $soal->id }}, 5)">
                        Sangat Sesuai
                    </button>
                </div>
            </div>
            @endforeach

            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg">Submit Jawaban</button>
            </div>
        </form>
    </div>

    <script>
        function selectOption(soalId, nilai) {
            document.getElementById(`jawaban_${soalId}`).value = nilai;
            
            // Reset semua button dalam soal yang sama
            const soalCard = event.target.closest('.soal-card');
            soalCard.querySelectorAll('.option-button').forEach(btn => {
                btn.classList.remove('selected');
            });
            
            // Tambah class selected ke button yang dipilih
            event.target.classList.add('selected');
        }

        document.getElementById('teknisForm').onsubmit = function(e) {
            let answered = true;
            document.querySelectorAll('input[type=hidden]').forEach(input => {
                if (!input.value) {
                    answered = false;
                }
            });

            if (!answered) {
                e.preventDefault();
                alert('Mohon jawab semua pertanyaan!');
            }
        };
    </script>
</body>
</html>