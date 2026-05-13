@extends('layouts.admin')

@section('title', 'Kelola User - Admin Lenscape')

@push('styles')
<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endpush

@section('content')

@php
    // Simulasi data User untuk Tabel
    $users = collect([
        (object)[
            'id' => 1,
            'nama_lengkap' => 'Fariel',
            'username' => 'fariel_admin',
            'no_hp' => '08123456789',
            'email' => 'fariel@lenscape.com',
            'status' => 'Aktif'
        ],
        (object)[
            'id' => 2,
            'nama_lengkap' => 'Admin Dua',
            'username' => 'admin2',
            'no_hp' => '085711223344',
            'email' => 'admin2@lenscape.com',
            'status' => 'Aktif'
        ]
    ]);
@endphp

<div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-8">
    <div>
        <h2 class="text-xl md:text-2xl font-bold text-gray-800">Kelola User</h2>
        <p class="text-xs md:text-sm text-gray-500 mt-1">Daftar semua user/pelanggan yang tersedia di Lenscape</p>
    </div>
    
    <button onclick="openUserModal('modalTambah')" class="bg-[#f3a933] hover:bg-[#d98e1d] text-[#0f172a] px-5 py-2.5 rounded-lg shadow-md font-bold transition flex items-center justify-center gap-2 text-sm w-full lg:w-auto">
        <i class="fas fa-plus"></i> <span>Tambah User</span>
    </button>
</div>

<div class="mb-6 relative w-full lg:max-w-2xl">
    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
        <i class="fas fa-search text-gray-400 text-sm"></i>
    </span>
    <input type="text" placeholder="Cari User (contoh: Nama)..." 
        class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-[#f3a933] text-sm">
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-50 border-b border-gray-100 text-gray-600">
                <tr>
                    <th class="px-6 py-4 font-semibold">Nama Lengkap</th>
                    <th class="px-6 py-4 font-semibold">Username</th>
                    <th class="px-6 py-4 font-semibold">No Hp</th>
                    <th class="px-6 py-4 font-semibold">Email</th>
                    <th class="px-6 py-4 font-semibold text-center">Status</th>
                    <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach ($users as $user)
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="px-6 py-4 font-bold text-gray-800">{{ $user->nama_lengkap }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $user->username }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $user->no_hp }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-3 py-1 bg-emerald-100 text-emerald-600 rounded-full text-[10px] font-black uppercase tracking-wider">
                            {{ $user->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center space-x-2">
                            <button onclick="openEditUser({{ json_encode($user) }})" class="bg-[#f3a933] text-[#0f172a] px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-[#d98e1d] transition">
                                Edit
                            </button>
                            <form action="#" method="POST" class="inline" onsubmit="return confirm('Hapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-red-600 transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<footer class="mt-12 pb-8 text-center text-[10px] text-gray-400 uppercase tracking-widest">
    <p>&copy; {{ date('Y') }} Lenscape Team | Server Time: {{ date('Y-m-d H:i') }}</p>
</footer>

@endsection


{{-- BAGIAN MODALS --}}
@push('modals')
<div id="modalTambah" class="fixed inset-0 z-[100] hidden overflow-y-auto">
    <div class="fixed inset-0 bg-[#0f172a]/60 backdrop-blur-sm"></div>
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl overflow-hidden">
            <div class="bg-gray-50 p-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-gray-800 font-bold text-sm">Tambah User Baru</h3>
                <button onclick="closeUserModal('modalTambah')" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
            </div>
            <form action="#" method="POST" class="p-6 md:p-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#f3a933] outline-none">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Username</label>
                            <input type="text" name="username" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#f3a933] outline-none">
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">No HP</label>
                            <input type="text" name="no_hp" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#f3a933] outline-none">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Email</label>
                            <input type="email" name="email" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#f3a933] outline-none">
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Password</label>
                        <input type="password" name="password" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#f3a933] outline-none">
                    </div>
                </div>
                <div class="mt-8 flex justify-end gap-3">
                    <button type="button" onclick="closeUserModal('modalTambah')" class="px-6 py-2 bg-gray-100 text-gray-600 rounded-xl text-xs font-bold transition">Batal</button>
                    <button type="submit" class="px-8 py-2 bg-[#f3a933] text-[#0f172a] rounded-xl text-xs font-black uppercase tracking-widest shadow-lg transition">Simpan User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modalEdit" class="fixed inset-0 z-[100] hidden overflow-y-auto">
    <div class="fixed inset-0 bg-[#0f172a]/60 backdrop-blur-sm"></div>
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl overflow-hidden">
            <div class="bg-gray-50 p-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-gray-800 font-bold text-sm">Edit Data User</h3>
                <button onclick="closeUserModal('modalEdit')" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
            </div>
            <form id="formEditUser" action="#" method="POST" class="p-6 md:p-8">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Nama Lengkap</label>
                            <input type="text" id="edit_nama_lengkap" name="nama_lengkap" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Username</label>
                            <input type="text" id="edit_username" name="username" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none">
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">No HP</label>
                            <input type="text" id="edit_no_hp" name="no_hp" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Email</label>
                            <input type="email" id="edit_email" name="email" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none">
                        </div>
                    </div>
                </div>
                <div class="mt-8 flex justify-end gap-3">
                    <button type="button" onclick="closeUserModal('modalEdit')" class="px-6 py-2 bg-gray-100 text-gray-600 rounded-xl text-xs font-bold transition">Batal</button>
                    <button type="submit" class="px-8 py-2 bg-[#0f172a] text-white rounded-xl text-xs font-black uppercase tracking-widest shadow-lg transition">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endpush


{{-- BAGIAN JAVASCRIPT --}}
@push('scripts')
<script>
    // Sengaja dikasih nama openUserModal biar ga bentrok dengan function openModal bawaan layout kalau ada
    function openUserModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeUserModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function openEditUser(user) {
        // Set values ke input form edit
        document.getElementById('edit_nama_lengkap').value = user.nama_lengkap;
        document.getElementById('edit_username').value = user.username;
        document.getElementById('edit_no_hp').value = user.no_hp;
        document.getElementById('edit_email').value = user.email;
        
        // Atur url route action untuk form edit jika sudah tersambung controller
        // document.getElementById('formEditUser').action = `/admin/user/${user.id}`;
        
        openUserModal('modalEdit');
    }
</script>
@endpush