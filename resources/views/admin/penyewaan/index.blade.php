@extends('layouts.admin')

@section('title', 'Kelola Penyewaan - Lenscape')

@push('styles')
<style>
    /* Sembunyikan scrollbar tapi tetap bisa scroll */
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endpush

@section('content')

@php
    // Simulasi data user yang login
    if(!Auth::check()) {
        $user = new stdClass();
        $user->name = "Admin Lenscape";
        auth()->loginUsingId(1); // Hanya jika di lingkungan Laravel
    }

    // Simulasi data Barang untuk Dropdown Modal
    $barang = collect([
        (object)['id' => 1, 'nama' => 'Sony A7III', 'harga_sewa' => 250000],
        (object)['id' => 2, 'nama' => 'Canon EOS R6', 'harga_sewa' => 300000],
        (object)['id' => 3, 'nama' => 'Fujifilm X-T4', 'harga_sewa' => 200000],
    ]);

    // Simulasi data Penyewaan untuk Tabel
    $penyewaan = collect([
        (object)[
            'id' => 1,
            'nama_penyewa' => 'Ahmad Zarkasi',
            'barang' => (object)['nama' => 'Sony A7III', 'kategori' => (object)['nama_kategori' => 'Kamera']],
            'no_hp' => '081234567890',
            'lama_sewa' => 2,
            'tanggal_sewa' => '2023-10-25',
            'total_harga' => 500000,
            'status' => 'disewa'
        ],
        (object)[
            'id' => 2,
            'nama_penyewa' => 'Siti Sarah',
            'barang' => (object)['nama' => 'Tripod Beike', 'kategori' => (object)['nama_kategori' => 'Aksesoris']],
            'no_hp' => '085711223344',
            'lama_sewa' => 1,
            'tanggal_sewa' => '2023-10-24',
            'total_harga' => 50000,
            'status' => 'kembali'
        ],
        (object)[
            'id' => 3,
            'nama_penyewa' => 'Budi Doremi',
            'barang' => (object)['nama' => 'Lensa 50mm f1.8', 'kategori' => (object)['nama_kategori' => 'Lensa']],
            'no_hp' => '089988776655',
            'lama_sewa' => 3,
            'tanggal_sewa' => '2023-10-20',
            'total_harga' => 300000,
            'status' => 'kembali'
        ]
    ]);
@endphp

<div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-8">
    <div>
        <h2 class="text-xl md:text-2xl font-bold text-gray-800">Kelola Penyewaan</h2>
        <p class="text-xs md:text-sm text-gray-500 mt-1">Daftar transaksi penyewaan alat Lenscape</p>
    </div>
    
    <div class="flex flex-wrap items-center gap-3 w-full lg:w-auto">
        <div class="text-[11px] md:text-sm text-gray-400 bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-100 flex-grow lg:flex-grow-0 text-center">
            <i class="far fa-calendar-alt mr-2"></i> {{ date('d F Y') }}
        </div>
        
        <button onclick="openModal()" class="bg-[#0f172a] hover:bg-gray-800 text-white px-5 py-2 rounded-lg shadow-sm font-semibold transition flex items-center justify-center gap-2 text-sm flex-grow lg:flex-grow-0">
            <i class="fas fa-plus text-[#f3a933]"></i> <span class="whitespace-nowrap">Tambah Penyewa</span>
        </button>
    </div>
</div>

<div class="mb-6 relative w-full lg:max-w-2xl">
    <form action="{{ route('admin.penyewaan.index') }}" method="GET">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <i class="fas fa-search text-gray-400 text-sm"></i>
        </span>
        <input type="text" name="search" value="{{ request('search') }}" 
            placeholder="Cari Nama Penyewa..." 
            class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-[#f3a933] text-sm transition-all">
    </form>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-50 border-b border-gray-100 text-gray-600 whitespace-nowrap">
                <tr>
                    <th class="px-6 py-4 font-semibold">Penyewa</th>
                    <th class="px-6 py-4 font-semibold">Alat</th>
                    <th class="px-6 py-4 font-semibold hidden lg:table-cell">Kategori</th>
                    <th class="px-6 py-4 font-semibold">No HP</th>
                    <th class="px-6 py-4 font-semibold">Tanggal</th>
                    <th class="px-6 py-4 font-semibold">Total</th>
                    <th class="px-6 py-4 font-semibold text-center">Status</th>
                    <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($penyewaan as $item)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4 font-bold text-gray-800 whitespace-nowrap">{{ $item->nama_penyewa }}</td>
                        <td class="px-6 py-4 text-gray-600 whitespace-nowrap">{{ $item->barang->nama }}</td>
                        <td class="px-6 py-4 text-gray-600 hidden lg:table-cell">{{ $item->barang->kategori->nama_kategori ?? '-' }}</td>
                        <td class="px-6 py-4 text-gray-600 whitespace-nowrap">{{ $item->no_hp }}</td>
                        <td class="px-6 py-4 text-gray-600 whitespace-nowrap">
                            <div class="text-[10px] text-gray-400 uppercase font-bold">{{ $item->lama_sewa }} Hari</div>
                            {{ $item->tanggal_sewa }}
                        </td>
                        <td class="px-6 py-4 font-bold text-gray-800 whitespace-nowrap">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($item->status == 'disewa')
                                <form action="{{ route('admin.penyewaan.update', $item->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="kembali">
                                    <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-1 rounded-full text-[9px] font-black uppercase tracking-wider shadow-sm transition">Kembali</button>
                                </form>
                            @else
                                <span class="px-4 py-1 bg-gray-100 text-gray-400 rounded-full text-[9px] font-black uppercase tracking-wider">Selesai</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center items-center space-x-2">
                                <button onclick="openEditModal({{ json_encode([
                                    'id' => $item->id,
                                    'nama_penyewa' => $item->nama_penyewa,
                                    'barang_id' => $item->barang_id ?? ($item->barang->id ?? null),
                                    'no_hp' => $item->no_hp,
                                    'tanggal_sewa' => $item->tanggal_sewa,
                                    'tanggal_kembali' => $item->tanggal_kembali ?? ''
                                ]) }})" 
                                class="text-blue-500 hover:text-blue-700 transition-colors p-2">
                                    <i class="fas fa-edit text-xs"></i>
                                </button>
                                <form action="{{ route('admin.penyewaan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 transition-colors p-2">
                                        <i class="fas fa-trash-alt text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center text-gray-400">Belum ada transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<footer class="mt-12 pb-8 text-center text-[10px] text-gray-400 uppercase tracking-widest">
    <p>&copy; {{ date('Y') }} Lenscape Team | PBL Informatics</p>
</footer>

@endsection

{{-- MODALS KITA MASUKIN KE PUSH --}}
@push('modals')
<!-- Modal Tambah -->
<div id="modalTambah" class="fixed inset-0 z-[100] hidden overflow-y-auto">
    <div class="fixed inset-0 bg-[#0f172a]/60 backdrop-blur-sm"></div>
    <div class="flex items-center justify-center min-h-screen p-4 md:p-6">
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl overflow-hidden">
            <div class="bg-gray-50 p-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-gray-800 font-bold text-sm">Form Transaksi Baru</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
            </div>

            <form action="{{ route('admin.penyewaan.store') }}" method="POST" class="p-6 md:p-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Nama Penyewa</label>
                            <input type="text" name="nama_penyewa" required class="w-full bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#f3a933]/20 focus:border-[#f3a933] outline-none">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Pilih Alat</label>
                            <select name="barang_id" required class="w-full bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-[#f3a933]">
                                <option value="">Pilih Barang...</option>
                                @foreach($barang as $b)
                                    <option value="{{ $b->id }}">{{ $b->nama }} (Rp{{ number_format($b->harga_sewa) }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Tanggal Mulai</label>
                            <input type="date" name="tanggal_sewa" required class="w-full bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none">
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">No Handphone</label>
                            <input type="text" name="no_hp" required class="w-full bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Tanggal Kembali</label>
                            <input type="date" name="tanggal_kembali" required class="w-full bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Estimasi Total</label>
                            <div class="w-full bg-gray-50 border border-dashed border-gray-300 rounded-lg px-3 py-2 text-xs text-gray-400 font-semibold italic">
                                Dihitung otomatis oleh sistem
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex flex-col md:flex-row justify-end gap-3">
                    <button type="button" onclick="closeModal()" class="w-full md:w-auto px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-xl text-xs font-bold transition">Batal</button>
                    <button type="submit" class="w-full md:w-auto px-8 py-2.5 bg-[#f3a933] hover:bg-[#d98e1d] text-[#0f172a] rounded-xl text-xs font-black uppercase tracking-widest shadow-lg transition">Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit (Gua tambahin biar script edit lu jalan) -->
<div id="modalEdit" class="fixed inset-0 z-[100] hidden overflow-y-auto">
    <div class="fixed inset-0 bg-[#0f172a]/60 backdrop-blur-sm"></div>
    <div class="flex items-center justify-center min-h-screen p-4 md:p-6">
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl overflow-hidden">
            <div class="bg-gray-50 p-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-gray-800 font-bold text-sm">Edit Transaksi</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
            </div>

            <form id="formEdit" method="POST" class="p-6 md:p-8">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Nama Penyewa</label>
                            <input type="text" id="edit_nama_penyewa" name="nama_penyewa" required class="w-full bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Pilih Alat</label>
                            <select id="edit_barang_id" name="barang_id" required class="w-full bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none">
                                <option value="">Pilih Barang...</option>
                                @foreach($barang as $b)
                                    <option value="{{ $b->id }}">{{ $b->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">No Handphone</label>
                            <input type="text" id="edit_no_hp" name="no_hp" required class="w-full bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Tanggal Mulai</label>
                            <input type="date" id="edit_tanggal_sewa" name="tanggal_sewa" required class="w-full bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none">
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex flex-col md:flex-row justify-end gap-3">
                    <button type="button" onclick="closeEditModal()" class="w-full md:w-auto px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-xl text-xs font-bold transition">Batal</button>
                    <button type="submit" class="w-full md:w-auto px-8 py-2.5 bg-blue-500 hover:bg-blue-600 text-white rounded-xl text-xs font-black uppercase tracking-widest shadow-lg transition">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endpush

{{-- SCRIPT KITA MASUKIN KE PUSH JUGA --}}
@push('scripts')
<script>
    function openModal() {
        document.getElementById('modalTambah').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('modalTambah').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function openEditModal(data) {
        const modal = document.getElementById('modalEdit');
        const form = document.getElementById('formEdit');
        
        form.action = `/admin/penyewaan/${data.id}`;
        
        document.getElementById('edit_nama_penyewa').value = data.nama_penyewa;
        document.getElementById('edit_barang_id').value = data.barang_id;
        document.getElementById('edit_no_hp').value = data.no_hp;
        document.getElementById('edit_tanggal_sewa').value = data.tanggal_sewa;

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    // Fungsi close modal edit
    function closeEditModal() {
        document.getElementById('modalEdit').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
</script>
@endpush