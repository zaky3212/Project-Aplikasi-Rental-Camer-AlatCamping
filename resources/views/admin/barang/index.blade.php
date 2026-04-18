@extends('layouts.admin')

@section('title', 'Kelola Barang - Admin Lenscape')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Daftar Barang</h2>
        <p class="text-sm text-gray-500 mt-1">Kelola inventaris alat camping dan kamera.</p>
    </div>
    <div class="flex items-center gap-4">
        <div class="hidden sm:block text-sm text-gray-400 bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-100">
            <i class="far fa-calendar-alt mr-2"></i> {{ date('d F Y') }}
        </div>
        <button type="button" onclick="openModal('modalTambah')" class="bg-[#0f172a] hover:bg-gray-800 text-white px-5 py-2 rounded-lg shadow-sm font-semibold transition flex items-center gap-2 text-sm">
            <i class="fas fa-plus text-[#f3a933]"></i> Tambah Barang
        </button>
    </div>
</div>

<div class="mb-6 relative max-w-2xl">
    <form action="{{ route('admin.barang.index') }}" method="GET">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <i class="fas fa-search text-gray-400"></i>
        </span>
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Cari Barang (contoh: Tenda)..."
            class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-[#f3a933] text-sm">
    </form>
</div>

@if(session('success'))
<div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-xl shadow-sm mb-6 flex items-center gap-3">
    <i class="fas fa-check-circle"></i>
    <p class="font-medium text-sm">{{ session('success') }}</p>
</div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6 overflow-x-auto">
    <table class="min-w-full text-sm text-left">
        <thead class="bg-gray-50 border-b border-gray-100 text-gray-600 whitespace-nowrap">
            <tr>
                <th class="px-6 py-4 font-semibold">Foto</th>
                <th class="px-6 py-4 font-semibold">Nama Barang</th>
                <th class="px-6 py-4 font-semibold">Kategori</th>
                <th class="px-6 py-4 font-semibold">Harga/Hari</th>
                <th class="px-6 py-4 font-semibold text-center">Stok</th>
                <th class="px-6 py-4 font-semibold text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse ($barang as $item)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4">
                    @if($item->gambar)
                    <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama }}" class="w-12 h-12 object-cover rounded-lg border border-gray-200 shadow-sm">
                    @else
                    <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-xs text-gray-400 border border-gray-200"><i class="fas fa-image"></i></div>
                    @endif
                </td>
                <td class="px-6 py-4 font-bold text-gray-800">{{ $item->nama }}</td>
                <td class="px-6 py-4">
                    <span class="bg-gray-100 text-gray-600 px-2.5 py-1.5 rounded-md border border-gray-200 text-xs font-semibold whitespace-nowrap">
                        {{ $item->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                    </span>
                </td>
                <td class="px-6 py-4 font-bold text-emerald-600 whitespace-nowrap">Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}</td>
                <td class="px-6 py-4 font-bold text-gray-700 text-center">{{ $item->stok }}</td>
                <td class="px-6 py-4">
                    <div class="flex items-center justify-center gap-2">
                        <button type="button" onclick="openModal('modalEdit-{{ $item->id }}')" class="bg-[#f3a933]/10 text-[#f3a933] hover:bg-[#f3a933] hover:text-white px-3 py-2 rounded-lg font-bold transition text-xs flex items-center gap-1">
                            <i class="fas fa-pen"></i> <span class="hidden sm:inline">Edit</span>
                        </button>
                        <form action="{{ route('admin.barang.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus barang ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-500 hover:text-white px-3 py-2 rounded-lg font-bold transition text-xs flex items-center gap-1">
                                <i class="fas fa-trash"></i> <span class="hidden sm:inline">Hapus</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-20 text-center text-gray-500 font-medium">
                    <i class="fas fa-box-open text-4xl text-gray-300 mb-3 block"></i>
                    Belum Ada Data Barang
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if ($barang->hasPages())
<div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-8">
    {{ $barang->withQueryString()->links() }}
</div>
@else
<div class="mb-8"></div>
@endif


<div id="modalTambah" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" onclick="closeModal('modalTambah')"></div>
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden">
            <div class="bg-[#0f172a] p-5 flex justify-between items-center">
                <h3 class="text-white font-bold flex items-center gap-3">
                    <i class="fas fa-plus-circle text-[#f3a933]"></i> Tambah Barang Baru
                </h3>
                <button type="button" onclick="closeModal('modalTambah')" class="text-gray-400 hover:text-white transition"><i class="fas fa-times"></i></button>
            </div>

            <form action="{{ route('admin.barang.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf
                <div class="space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Nama Barang</label>
                            <input type="text" name="nama" required class="w-full bg-gray-50 border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#f3a933]">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Kategori</label>
                            <select name="kategori_id" required class="w-full bg-gray-50 border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#f3a933]">
                                <option value="">Pilih Kategori</option>
                                @foreach($kategori as $kat)
                                <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Harga Sewa / Hari (Rp)</label>
                            <input type="number" name="harga_sewa" required class="w-full bg-gray-50 border rounded-xl px-4 py-2.5 text-sm">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Stok Unit</label>
                            <input type="number" name="stok" required class="w-full bg-gray-50 border rounded-xl px-4 py-2.5 text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Deskripsi</label>
                        <textarea name="deskripsi" required class="w-full bg-gray-50 border rounded-xl px-4 py-2.5 text-sm" rows="3"></textarea>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Foto Barang</label>
                        <input type="file" name="gambar" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-xs file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-[10px] file:font-semibold file:bg-[#f3a933]/10 file:text-[#f3a933] hover:file:bg-[#f3a933]/20">
                    </div>
                </div>
                <div class="mt-8 flex justify-end gap-3">
                    <button type="button" onclick="closeModal('modalTambah')" class="px-6 py-2 bg-gray-100 text-gray-600 rounded-xl text-xs font-bold transition hover:bg-gray-200">Batal</button>
                    <button type="submit" class="px-8 py-2 bg-[#f3a933] hover:bg-yellow-500 text-[#0f172a] rounded-xl text-xs font-bold shadow-lg transition">Simpan Barang</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach ($barang as $item)
<div id="modalEdit-{{ $item->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" onclick="closeModal('modalEdit-{{ $item->id }}')"></div>
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden">
            <div class="bg-[#0f172a] p-5 flex justify-between items-center">
                <h3 class="text-white font-bold flex items-center gap-3">
                    <i class="fas fa-pen text-[#f3a933]"></i> Edit Barang
                </h3>
                <button type="button" onclick="closeModal('modalEdit-{{ $item->id }}')" class="text-gray-400 hover:text-white transition"><i class="fas fa-times"></i></button>
            </div>

            <form action="{{ route('admin.barang.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf
                @method('PUT')
                <div class="space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Nama Barang</label>
                            <input type="text" name="nama" value="{{ $item->nama }}" required class="w-full bg-gray-50 border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#f3a933]">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Kategori</label>
                            <select name="kategori_id" required class="w-full bg-gray-50 border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#f3a933]">
                                @foreach($kategori as $kat)
                                <option value="{{ $kat->id }}" {{ $item->kategori_id == $kat->id ? 'selected' : '' }}>
                                    {{ $kat->nama_kategori }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Harga Sewa / Hari (Rp)</label>
                            <input type="number" name="harga_sewa" value="{{ $item->harga_sewa }}" required class="w-full bg-gray-50 border rounded-xl px-4 py-2.5 text-sm">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Stok Unit</label>
                            <input type="number" name="stok" value="{{ $item->stok }}" required class="w-full bg-gray-50 border rounded-xl px-4 py-2.5 text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Deskripsi</label>
                        <textarea name="deskripsi" required class="w-full bg-gray-50 border rounded-xl px-4 py-2.5 text-sm" rows="3">{{ $item->deskripsi }}</textarea>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Ganti Foto (Opsional)</label>
                        <input type="file" name="gambar" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-xs file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-[10px] file:font-semibold file:bg-[#f3a933]/10 file:text-[#f3a933] hover:file:bg-[#f3a933]/20">
                        @if($item->gambar)
                        <p class="text-[10px] text-emerald-600 mt-1">* Barang ini sudah memiliki foto. Kosongkan jika tidak ingin diganti.</p>
                        @endif
                    </div>
                </div>
                <div class="mt-8 flex justify-end gap-3">
                    <button type="button" onclick="closeModal('modalEdit-{{ $item->id }}')" class="px-6 py-2 bg-gray-100 text-gray-600 rounded-xl text-xs font-bold transition hover:bg-gray-200">Batal</button>
                    <button type="submit" class="px-8 py-2 bg-[#f3a933] hover:bg-yellow-500 text-[#0f172a] rounded-xl text-xs font-bold shadow-lg transition">Update Barang</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection

@push('scripts')
<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
</script>
@endpush