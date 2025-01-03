<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengelolaController extends Controller
{
    public function index()
    {
        $users = DB::select('SELECT * FROM users');
        
        // Prepare analytics data
        $analytics = [
            'totalTesTeknis' => 0,
            'totalTesBakat' => 0,
            'totalPenempatan' => 0,
            'teknisLabels' => [],
            'teknisData' => [],
            'bakatLabels' => [],
            'bakatData' => []
        ];
        
        // Array kosong buat hitung tes teknis dan tes bakat
        $teknisResults = [];
        $bakatResults = [];
        
        foreach ($users as $user) {
            if (!empty($user->tes_teknis)) {
                $analytics['totalTesTeknis']++;
                $teknisResults[$user->tes_teknis] = ($teknisResults[$user->tes_teknis] ?? 0) + 1;
            }
            
            if (!empty($user->tes_bakat)) {
                $analytics['totalTesBakat']++;
                $bakatResults[$user->tes_bakat] = ($bakatResults[$user->tes_bakat] ?? 0) + 1;
            }
            
            if (!empty($user->penempatan_kerja)) {
                $analytics['totalPenempatan']++;
            }
        }
        
        // Untuk chart data
        $analytics['teknisLabels'] = array_keys($teknisResults);
        $analytics['teknisData'] = array_values($teknisResults);
        $analytics['bakatLabels'] = array_keys($bakatResults);
        $analytics['bakatData'] = array_values($bakatResults);
        
        return view('page_pengelola.pengelolaHome', compact('users', 'analytics'));
    }

    public function edit($id)
    {
        $user = DB::select('SELECT * FROM users WHERE id = ?', [$id]);
        if (empty($user)) {
            abort(404);
        }
        return view('page_pengelola.pengelolaEdit', ['user' => $user[0]]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'alamat' => 'nullable',
            'tanggal_lahir' => 'nullable',
            'no_telpon' => 'nullable',
            'pendidikan_terakhir' => 'nullable',
            'prodi' => 'nullable',
            'penempatan_kerja' => 'nullable',
        ]);

        DB::update('UPDATE users SET 
            name = ?, 
            email = ?,
            alamat = ?,
            tanggal_lahir = ?,
            no_telpon = ?,
            pendidikan_terakhir = ?,
            prodi = ?,
            penempatan_kerja = ?
            WHERE id = ?', 
            [
                $request->name,
                $request->email,
                $request->alamat,
                $request->tanggal_lahir,
                $request->no_telpon,
                $request->pendidikan_terakhir,
                $request->prodi,
                $request->penempatan_kerja,
                $id
            ]
        );

        return redirect()->route('pengelola.home')->with('success', 'Data user berhasil diupdate!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string',
        ]);

        DB::insert('INSERT INTO users (name, email, password, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())', [
            $request->name,
            $request->email,
            bcrypt($request->password)
        ]);

        return redirect()->route('pengelola.home')->with('success', 'User berhasil ditambahkan!');
    }

    public function delete($id)
    {
        DB::delete('DELETE FROM users WHERE id = ?', [$id]);
        return redirect()->route('pengelola.home')->with('success', 'User berhasil dihapus!');
    }
}