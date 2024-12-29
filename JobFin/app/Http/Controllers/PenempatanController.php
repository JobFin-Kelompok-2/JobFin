<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PenempatanController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $user = DB::select('SELECT * FROM users WHERE id = ?', [$userId])[0];
        
        $statusTest = [
            'teknis' => !empty($user->tes_teknis),
            'bakat' => !empty($user->tes_bakat)
        ];
        
        return view('page.profile.hasilPenempatan', compact('user', 'statusTest'));
    }

    public function updatePenempatan($tesTeknis, $tesBakat)
    {
        if (empty($tesTeknis) || empty($tesBakat)) {
            return 'Lakukan kedua test terlebih dahulu';
        }

        // Mapping rekomendasi penempatan berdasarkan kombinasi hasil tes
        $penempatanMap = [
            'Kreatif (Seni, Desain, dan Kreativitas)' => [
                'RIA' => 'PT. Creative Solutions di bidang Design Engineering',
                'RIS' => 'PT. Digital Arts di bidang UI/UX Design',
                'ASE' => 'PT. Innovation Hub di bidang Creative Director',
            ],
            'Teknikal (Teknik dan Analisis)' => [
                'RIA' => 'PT. Tech Innovate di bidang Software Engineering',
                'RIE' => 'PT. System Solutions di bidang System Architecture',
                'RIC' => 'PT. Data Solutions di bidang Data Engineering',
            ],
            'Sosial (Komunikasi dan Hubungan Interpersonal)' => [
                'SEC' => 'PT. People Connect di bidang Human Resources',
                'SAR' => 'PT. Community Hub di bidang Community Management',
                'SER' => 'PT. Social Impact di bidang Public Relations',
            ],
            'Manajerial (Kepemimpinan dan Manajemen)' => [
                'ERS' => 'PT. Leadership First di bidang Project Management',
                'ESC' => 'PT. Business Solutions di bidang Business Development',
                'EIS' => 'PT. Strategic Management di bidang Strategic Planning',
            ]
        ];

        $penempatan = $penempatanMap[$tesBakat][$tesTeknis] ?? 'PT. General Company di bidang Professional Staff';

        // Update penempatan kerja di database
        $userId = Auth::id();
        DB::update('UPDATE users SET penempatan_kerja = ? WHERE id = ?', [$penempatan, $userId]);

        return $penempatan;
    }
}