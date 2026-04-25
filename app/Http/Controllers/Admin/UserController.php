<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
       
        return view('admin.user.index');
    }

    // Jika Anda ingin tombol "Simpan" atau "Hapus" tidak error saat diklik:
    public function store(Request $request) { return redirect()->back(); }
    public function update(Request $request, $id) { return redirect()->back(); }
    public function destroy($id) { return redirect()->back(); }
}