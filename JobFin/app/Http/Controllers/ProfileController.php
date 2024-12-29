<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $user = DB::select('SELECT * FROM users WHERE id = ?', [$userId])[0];
        return view('page.profile.profile', ['user' => $user]);
    }

    public function edit()
    {
        return view('page.profile.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'alamat' => 'nullable',
            'tanggal_lahir' => 'nullable|date',
            'no_telpon' => 'nullable',
            'pendidikan_terakhir' => 'nullable',
            'prodi' => 'nullable'
        ]);

        $userId = auth()->id();
        DB::update('UPDATE users SET 
            name = ?,
            email = ?,
            alamat = ?,
            tanggal_lahir = ?,
            no_telpon = ?,
            pendidikan_terakhir = ?,
            prodi = ?
            WHERE id = ?',
            [
                $request->name,
                $request->email,
                $request->alamat,
                $request->tanggal_lahir,
                $request->no_telpon,
                $request->pendidikan_terakhir,
                $request->prodi,
                $userId
            ]
        );

        return redirect()->route('profile.index')->with('success', 'Profile berhasil diperbarui!');
    }
}
