<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view('admin.user.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' =>   'required|string|max:255',
            'email' =>  'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,pelanggan', // Disamakan dengan enum database Anda ('admin', 'pelanggan')
            'no_hp' => 'nullable|string|max:15',
        ]);

        // PERBAIKAN: Huruf U besar pada User, dan hapus '$request->' sebelum Hash::make
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
            'role' => $request->role,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->back()->with('success', 'User Berhasil Ditambahkan');
    }
    
    public function update(Request $request, int $id) // PERBAIKAN: Menambahkan type-hinting 'int'
    {
        // Cari user berdasarkan ID, jika tidak ketemu langsung return error 404
        $user = User::findOrFail($id);

        // 1. Validasi data (abaikan keunikan email untuk user itu sendiri)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8', // Password boleh kosong saat update
            'role' => 'required|string',
            'no_hp' => 'nullable|string|max:15',
        ]);

        // 2. Siapkan data yang akan diupdate
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'no_hp' => $request->no_hp,
        ];

        // Jika admin mengisi password baru, enkripsi dan masukkan ke data update
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // 3. Jalankan perintah update
        $user->update($data);

        return redirect()->back()->with('success', 'User berhasil diperbarui!');
    }

    /**
     * DELETE: Menghapus data user
     */
    public function destroy(int $id) // PERBAIKAN: Menambahkan type-hinting 'int'
    {
        // Cari user, lalu hapus
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus!');
    }
}