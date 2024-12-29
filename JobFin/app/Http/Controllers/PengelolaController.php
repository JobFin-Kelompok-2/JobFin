<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengelolaController extends Controller
{
    public function index()
    {
        $users = DB::select('SELECT * FROM users');
        return view('page_pengelola.pengelolaHome', compact('users'));
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
}