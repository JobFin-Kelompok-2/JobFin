<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TeknisController extends Controller
{
    public function index()
    {
        $soalTeknis = DB::select('SELECT * FROM tes_teknis');
        return view('page.testTeknis.teknisSoal', ['soalTeknis' => $soalTeknis]);
    }

    public function submit(Request $request)
    {
        $jawaban = $request->input('jawaban');
        
        // Inisialisasi skor RIASEC
        $skor = [
            'realistic' => 0,
            'investigative' => 0,
            'artistic' => 0,
            'social' => 0,
            'enterprising' => 0,
            'conventional' => 0
        ];

        // Hitung skor berdasarkan kategori soal
        foreach ($jawaban as $soalId => $nilai) {
            $kategori = $this->getKategoriSoal($soalId);
            $skor[$kategori] += $nilai;
        }

        // Urutkan skor dari tertinggi ke terendah
        arsort($skor);

        // Ambil 3 skor tertinggi
        $topThree = array_slice($skor, 0, 3, true);

        // Dapatkan kode RIASEC yang diurutkan
        $orderedCode = $this->getOrderedRiasecCode($topThree);

        // Simpan ke database
        $userId = Auth::id();
        $tesTeknis = implode(', ', array_keys($topThree));
        DB::update('UPDATE users SET tes_teknis = ? WHERE id = ?', [$tesTeknis, $userId]);

        // Update penempatan kerja jika kedua tes sudah dilakukan
        $user = DB::select('SELECT tes_bakat FROM users WHERE id = ?', [$userId])[0];
        if ($user->tes_bakat) {
            $penempatanController = new PenempatanController();
            $penempatan = $penempatanController->updatePenempatan($orderedCode, $user->tes_bakat);
            DB::update('UPDATE users SET penempatan_kerja = ? WHERE id = ?', [$penempatan, $userId]);
        }

        // Simpan skor ke session
        session([
            'skor_riasec' => $skor,
            'top_three' => $topThree
        ]);

        return redirect()->route('teknis.hasil');
    }

    private function getKategoriSoal($soalId)
    {
        if ($soalId >= 1 && $soalId <= 5) {
            return 'realistic';
        } elseif ($soalId >= 6 && $soalId <= 10) {
            return 'investigative';
        } elseif ($soalId >= 11 && $soalId <= 15) {
            return 'artistic';
        } elseif ($soalId >= 16 && $soalId <= 20) {
            return 'social';
        } elseif ($soalId >= 21 && $soalId <= 25) {
            return 'enterprising';
        } elseif ($soalId >= 26 && $soalId <= 30) {
            return 'conventional';
        }
        
        return 'realistic'; // default fallback
    }

    public function hasil()
    {
        $skor = session('skor_riasec');
        $topThree = session('top_three');

        // Deskripsi untuk setiap tipe RIASEC
        $deskripsi = [
            'realistic' => 'Tipe Realistis - Anda menyukai pekerjaan yang melibatkan penggunaan alat, mesin, atau aktivitas fisik.',
            'investigative' => 'Tipe Investigatif - Anda menyukai pekerjaan yang melibatkan analisis, penelitian, dan pemecahan masalah.',
            'artistic' => 'Tipe Artistik - Anda menyukai pekerjaan yang melibatkan kreativitas dan ekspresi diri.',
            'social' => 'Tipe Sosial - Anda menyukai pekerjaan yang melibatkan interaksi dengan orang lain dan membantu orang.',
            'enterprising' => 'Tipe Wirausaha - Anda menyukai pekerjaan yang melibatkan kepemimpinan dan pengambilan keputusan.',
            'conventional' => 'Tipe Konvensional - Anda menyukai pekerjaan yang terstruktur dan mengikuti prosedur yang jelas.'
        ];

        // Rekomendasi karir untuk setiap kombinasi 3 huruf teratas
        $rekomendasi = $this->getRekomendasiKarir(array_keys($topThree));

        return view('page.testTeknis.hasilTeknis', compact('skor', 'topThree', 'deskripsi', 'rekomendasi'));
    }

    private function getRekomendasiKarir($topThreeTypes)
    {
        $kode = implode('', array_map(function($type) {
            return strtoupper(substr($type, 0, 1));
        }, $topThreeTypes));

        $rekomendasiKarir = [
            'RIA' => ['Insinyur', 'Peneliti Teknis', 'Arsitek'],
            'RIS' => ['Dokter Hewan', 'Teknisi Medis', 'Perawat'],
            'RIE' => ['Insinyur Industri', 'Manajer Teknis', 'Konsultan IT'],
            'IRC' => ['Pemain basket', 'Manajer australia', 'Konsultan hewan']
        ];

        return $rekomendasiKarir[$kode] ?? ['Belum ada rekomendasi spesifik untuk kombinasi ini'];
    }

    private function getOrderedRiasecCode($topThree)
    {
        $riasecOrder = ['realistic', 'investigative', 'artistic', 'social', 'enterprising', 'conventional'];
        $types = array_keys($topThree);
        $orderedTypes = array_filter($riasecOrder, function($type) use ($types) {
            return in_array($type, $types);
        });

        $code = implode('', array_map(function($type) {
            return strtoupper(substr($type, 0, 1));
        }, $orderedTypes));

        return $code;
    }
}
