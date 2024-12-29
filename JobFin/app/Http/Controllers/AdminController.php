<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $users = DB::select('SELECT * FROM users');
        $materis = DB::select('SELECT * FROM materi');
        return view('page_admin.adminHome', compact('users', 'materis'));
    }

    public function edit($id)
    {
        $user = DB::select('SELECT * FROM users WHERE id = ?', [$id]);
        if (empty($user)) {
            abort(404);
        }
        return view('page_admin.adminEdit', ['user' => $user[0]]);
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
        ]);

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
                $id
            ]
        );

        return redirect()->route('admin.dashboard')->with('success', 'Data user berhasil diupdate!');
    }

    public function delete($id)
    {
        DB::delete('DELETE FROM users WHERE id = ?', [$id]);
        return redirect()->route('admin.dashboard')->with('success', 'User berhasil dihapus!');
    }

    // Fungsi untuk materi
    public function createMateri()
    {
        return view('page_admin.adminCreateMateri');
    }

    public function storeMateri(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'keterangan' => 'required',
            'link' => 'required|url'
        ]);

        DB::insert('INSERT INTO materi (judul, keterangan, link) VALUES (?, ?, ?)', [
            $request->judul,
            $request->keterangan,
            $request->link
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Materi berhasil ditambahkan!');
    }

    public function editMateri($id)
    {
        $materi = DB::select('SELECT * FROM materi WHERE id = ?', [$id]);
        if (empty($materi)) {
            abort(404);
        }
        return view('page_admin.adminEditMateri', ['materi' => $materi[0]]);
    }

    public function updateMateri(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'keterangan' => 'required',
            'link' => 'required|url'
        ]);

        DB::update('UPDATE materi SET judul = ?, keterangan = ?, link = ? WHERE id = ?', [
            $request->judul,
            $request->keterangan,
            $request->link,
            $id
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Materi berhasil diupdate!');
    }

    public function deleteMateri($id)
    {
        DB::delete('DELETE FROM materi WHERE id = ?', [$id]);
        return redirect()->route('admin.dashboard')->with('success', 'Materi berhasil dihapus!');
    }
}
