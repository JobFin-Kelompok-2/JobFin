<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BakatController extends Controller
{
    public function showSoal()
    {
        $soalBakat = DB::table('tes_bakat')->get();
        return view('page.testMinatBakat.bakatSoal', ['soalBakat' => $soalBakat]);
    }

    public function submitJawaban(Request $request)
    {
        $jawaban = $request->all();
        $skor = [
            'kreatif' => 0,
            'sosial' => 0,
            'teknikal' => 0,
            'manajerial' => 0
        ];
        
        // Logika penilaian berdasarkan jawaban
        foreach($jawaban as $key => $value) {
            if(strpos($key, 'jawaban_') === 0) {
                switch($value) {
                    case 'opsi_1':
                        $skor['kreatif'] += 1;
                        break;
                    case 'opsi_2':
                        $skor['sosial'] += 1;
                        break;
                    case 'opsi_3':
                        $skor['teknikal'] += 1;
                        break;
                    case 'opsi_4':
                        $skor['manajerial'] += 1;
                        break;
                }
            }
        }

        $totalSkor = array_sum($skor);

        // Simpan skor ke session
        session(['skor_bakat' => $skor]);
        session(['total_skor_bakat' => $totalSkor]);

        $user = Auth::user();
        $kategoriTertinggi = array_search(max($skor), $skor);
        $hasilBakat = $this->getKategoriBakat($kategoriTertinggi);
        $user->tes_bakat = $hasilBakat;
        $user->save();

        // Update penempatan kerja jika kedua tes sudah dilakukan
        if ($user->tes_teknis) {
            $penempatan = app(PenempatanController::class)->updatePenempatan($user->tes_teknis, $hasilBakat);
            $user->penempatan_kerja = $penempatan;
            $user->save();
        }
        
        return redirect()->route('hasil.bakat');
    }

    public function showHasil()
    {
        $skor = session('skor_bakat');
        $totalSkor = session('total_skor_bakat');

        if (!$skor || !$totalSkor) {
            return redirect()->route('bakat.soal')->with('error', 'Anda belum mengerjakan tes bakat');
        }

        return view('page.testMinatBakat.hasilBakat', compact('skor', 'totalSkor'));
    }

    private function getKategoriBakat($kategori)
    {
        $kategoriBakat = [
            'kreatif' => 'Kreatif (Seni, Desain, dan Kreativitas)',
            'sosial' => 'Sosial (Komunikasi dan Hubungan Interpersonal)',
            'teknikal' => 'Teknikal (Teknik dan Analisis)',
            'manajerial' => 'Manajerial (Kepemimpinan dan Manajemen)'
        ];

        return $kategoriBakat[$kategori] ?? 'Belum dapat ditentukan';
    }

    public function submitFeedback(Request $request)
    {
        $request->validate([
            'feedback_bakat' => 'required|string|max:1000'
        ]);

        $userId = Auth::id();
        DB::update('UPDATE users SET feedback_bakat = ? WHERE id = ?', [$request->feedback_bakat, $userId]);

        return redirect()->back()->with('success', 'Feedback berhasil disimpan!');
    }

    public function deleteFeedback()
    {
        $userId = Auth::id();
        DB::update('UPDATE users SET feedback_bakat = NULL WHERE id = ?', [$userId]);

        return redirect()->back()->with('success', 'Feedback berhasil dihapus!');
    }
}
