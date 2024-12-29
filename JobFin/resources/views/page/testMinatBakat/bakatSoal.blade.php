<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Bakat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bakat-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 20px;
        }
        .soal-card {
            margin-bottom: 2rem;
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: rgb(228, 221, 221);
        }
        .opsi-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 1rem;
        }
        .opsi-button {
            padding: 10px;
            text-align: left;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: white;
            cursor: pointer;
        }
        .opsi-button:hover {
            background: #f0f0f0;
        }
        .opsi-button.selected {
            background: #007bff;
            color: white;
        }
        .gambarwajahboi{
            width: 100px;
        }
        .gambarwajahboi img{
            width: 100px;
        }
    </style>
</head>
<body>
    @include("component.navbarLogin")
    <div class="bakat-container">
        <form action="{{ route('submit.bakat') }}" method="POST">
            @csrf
            @foreach($soalBakat as $index => $soal)
            <div class="soal-card">
                <h5>Soal {{ $index + 1 }}</h5>
                <?php if($index == 0){?>
                <p>{{ $soal->pertanyaan }}</p>
                <div class="gambarwajahboi">
                    <img src="/asset/gambar_wajah.png" alt="">
                </div>
                <div class="opsi-group">
                    <button type="button" class="opsi-button" onclick="selectOption({{ $index }}, 1)">
                        {{ $soal->opsi_1 }}
                    </button>
                    <button type="button" class="opsi-button" onclick="selectOption({{ $index }}, 2)">
                        {{ $soal->opsi_2 }}
                    </button>
                    <button type="button" class="opsi-button" onclick="selectOption({{ $index }}, 3)">
                        {{ $soal->opsi_3 }}
                    </button>
                    <button type="button" class="opsi-button" onclick="selectOption({{ $index }}, 4)">
                        {{ $soal->opsi_4 }}
                    </button>
                    <input type="hidden" name="jawaban_{{ $index }}" id="jawaban_{{ $index }}">
                </div>
                <?php } else{?>
                    <p>{{ $soal->pertanyaan }}</p>
                    <div class="opsi-group">
                        <button type="button" class="opsi-button" onclick="selectOption({{ $index }}, 1)">
                            {{ $soal->opsi_1 }}
                        </button>
                        <button type="button" class="opsi-button" onclick="selectOption({{ $index }}, 2)">
                            {{ $soal->opsi_2 }}
                        </button>
                        <button type="button" class="opsi-button" onclick="selectOption({{ $index }}, 3)">
                            {{ $soal->opsi_3 }}
                        </button>
                        <button type="button" class="opsi-button" onclick="selectOption({{ $index }}, 4)">
                            {{ $soal->opsi_4 }}
                        </button>
                        <input type="hidden" name="jawaban_{{ $index }}" id="jawaban_{{ $index }}">
                    </div>
                <?php }?>
            </div>
            @endforeach
            <button type="submit" class="btn btn-primary">Submit Jawaban</button>
        </form>
    </div>

    <script>
        function selectOption(soalIndex, opsiIndex) {
            // Hapus kelas selected dari semua opsi dalam soal yang sama
            const soalCard = document.querySelector(`#jawaban_${soalIndex}`).closest('.soal-card');
            soalCard.querySelectorAll('.opsi-button').forEach(button => {
                button.classList.remove('selected');
            });
            
            // Tambah kelas selected ke opsi yang dipilih
            const selectedButton = soalCard.querySelector(`.opsi-button:nth-child(${opsiIndex})`);
            selectedButton.classList.add('selected');
            
            // Set nilai input hidden
            document.querySelector(`#jawaban_${soalIndex}`).value = `opsi_${opsiIndex}`;
        }
    </script>
</body>
</html>