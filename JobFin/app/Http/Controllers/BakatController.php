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
                // Implementasi logika penilaian sesuai dengan kategori jawaban
                // Contoh sederhana:
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

        // Simpan skor ke session atau database
        session(['skor_bakat' => $skor]);

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
}
