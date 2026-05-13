<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();

        return view('app', [
            'page' => 'user.index',
            'title' => 'Data User',
            'user' => $user
        ]);
    }

    // 🔹 Form tambah
    public function create()
    {
        return view('app', [
            'page' => 'user.create',
            'title' => 'Tambah Data User',
        ]);
    }

    // 🔹 Simpan data
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->username),
            'role' => $request->role,
        ]);

        return redirect()->route('user.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    // 🔹 Form edit
    public function edit($id)
    {
        $data = User::findOrFail($id);

        return view('app', [
            'page' => 'user.edit',
            'title' => 'Ubah Data User: ' . $data->username,
            'data' => $data
        ]);
    }

    // 🔹 Update data
    public function update(Request $request, $id)
    {
        $data = User::findOrFail($id);

        $request->validate([
            'username' => 'required',
            'password' => 'nullable',
            'role' => 'required',
        ]);

        $input = $request->only(['username', 'role']);

        if ($request->filled('password')) {
            $input['password'] = Hash::make($request->password);
        }

        $data->update($input);

        return redirect()->route('user.index')
            ->with('success', 'Data berhasil diupdate');
    }

    // 🔹 Hapus data
    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();

        return redirect()->route('user.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
