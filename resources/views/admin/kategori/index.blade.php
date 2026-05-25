@extends('layouts.admin')

@section('title', 'Kelola Kategori - Admin Lenscape')

@section('content')

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Kelola Kategori</h2>
            <p class="text-sm text-gray-500 mt-1">
                Daftar kategori barang yang tersedia di Lenscape.
            </p>
        </div>

        <div class="flex items-center gap-4">
            <div
                class="hidden sm:block text-sm text-gray-400 bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-100">
                <i class="far fa-calendar-alt mr-2"></i> {{ date('d F Y') }}
            </div>

            <button type="button" onclick="openModal('modalTambah')"
                class="bg-[#0f172a] hover:bg-gray-800 text-white px-5 py-2 rounded-lg shadow-sm font-semibold transition flex items-center gap-2 text-sm">
                <i class="fas fa-plus text-[#f3a933]"></i>
                Tambah Kategori
            </button>
        </div>
    </div>

    <div class="mb-6 relative max-w-md">
        <form action="{{ route('admin.kategori.index') }}" method="GET">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <i class="fas fa-search text-gray-400"></i>
            </span>

            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kategori..."
                class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-[#f3a933] text-sm">
        </form>
    </div>

    @if(session('success'))
        <div
            class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-xl shadow-sm mb-6 flex items-center gap-3">
            <i class="fas fa-check-circle"></i>
            <p class="font-medium text-sm">{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-xl shadow-sm mb-6 flex items-center gap-3">
            <i class="fas fa-exclamation-circle"></i>
            <p class="font-medium text-sm">{{ session('error') }}</p>
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-xl shadow-sm mb-6 mt-4">
            <div class="flex items-center gap-2 font-bold mb-2 text-sm">
                <i class="fas fa-exclamation-triangle"></i>
                Oops! Gagal memproses data:
            </div>

            <ul class="list-disc pl-5 text-xs font-medium space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6 overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-50 border-b border-gray-100 text-gray-600 whitespace-nowrap">
                <tr>
                    <th class="px-6 py-4 font-semibold">No</th>
                    <th class="px-6 py-4 font-semibold">Nama Kategori</th>
                    <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-50">
                @forelse ($kategori as $item)
                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-6 py-4 text-gray-500">
                            {{ ($kategori->currentPage() - 1) * $kategori->perPage() + $loop->iteration }}
                        </td>

                        <td class="px-6 py-4">
                            <div class="font-bold text-gray-800">
                                {{ $item->nama_kategori }}
                            </div>
                        </td>
                        
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">

                                <button type="button" onclick="openModal('modalEdit-{{ $item->id }}')"
                                    class="bg-[#f3a933]/10 text-[#f3a933] hover:bg-[#f3a933] hover:text-white px-3 py-2 rounded-lg font-bold transition text-xs flex items-center gap-1">
                                    <i class="fas fa-pen"></i>
                                    <span class="hidden sm:inline">Edit</span>
                                </button>

                                <form action="{{ route('admin.kategori.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="bg-red-50 text-red-600 hover:bg-red-500 hover:text-white px-3 py-2 rounded-lg font-bold transition text-xs flex items-center gap-1">
                                        <i class="fas fa-trash"></i>
                                        <span class="hidden sm:inline">Hapus</span>
                                    </button>

                                </form>
                            </div>
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                            <i class="fas fa-folder-open text-3xl mb-3 block text-gray-300"></i>
                            Belum ada data kategori.
                        </td>
                    </tr>

                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mb-8">
        {{ $kategori->withQueryString()->links() }}
    </div>

    <!-- MODAL TAMBAH -->
    <div id="modalTambah" class="fixed inset-0 z-50 hidden overflow-y-auto">

        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" onclick="closeModal('modalTambah')"></div>

        <div class="flex items-center justify-center min-h-screen p-4">

            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">

                <div class="bg-[#0f172a] p-5 flex justify-between items-center">
                    <h3 class="text-white font-bold flex items-center gap-3">
                        <i class="fas fa-folder-plus text-[#f3a933]"></i>
                        Tambah Kategori
                    </h3>

                    <button type="button" onclick="closeModal('modalTambah')"
                        class="text-gray-400 hover:text-white transition">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form action="{{ route('admin.kategori.store') }}" method="POST" class="p-8">

                    @csrf

                    <div class="space-y-5">

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">
                                Nama Kategori
                            </label>

                            <input type="text" name="nama_kategori" required placeholder="Contoh: Kamera DSLR"
                                class="w-full bg-gray-50 border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#f3a933]">
                        </div>

                    </div>

                    <div class="mt-8 flex justify-end gap-3">

                        <button type="button" onclick="closeModal('modalTambah')"
                            class="px-6 py-2 bg-gray-100 text-gray-600 rounded-xl text-xs font-bold transition hover:bg-gray-200">
                            Batal
                        </button>

                        <button type="submit"
                            class="px-8 py-2 bg-[#f3a933] hover:bg-yellow-500 text-[#0f172a] rounded-xl text-xs font-bold shadow-lg transition">
                            Simpan
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT -->
    @foreach ($kategori as $item)

        <div id="modalEdit-{{ $item->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto">

            <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" onclick="closeModal('modalEdit-{{ $item->id }}')"></div>

            <div class="flex items-center justify-center min-h-screen p-4">

                <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">

                    <div class="bg-[#0f172a] p-5 flex justify-between items-center">

                        <h3 class="text-white font-bold flex items-center gap-3">
                            <i class="fas fa-pen text-[#f3a933]"></i>
                            Edit Kategori
                        </h3>

                        <button type="button" onclick="closeModal('modalEdit-{{ $item->id }}')"
                            class="text-gray-400 hover:text-white transition">
                            <i class="fas fa-times"></i>
                        </button>

                    </div>

                    <form action="{{ route('admin.kategori.update', $item->id) }}" method="POST" class="p-8">

                        @csrf
                        @method('PUT')

                        <div class="space-y-5">

                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">
                                    Nama Kategori
                                </label>

                                <input type="text" name="nama_kategori" value="{{ $item->nama_kategori }}" required
                                    class="w-full bg-gray-50 border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#f3a933]">
                            </div>
                        </div>
                        <div class="mt-8 flex justify-end gap-3">

                            <button type="button" onclick="closeModal('modalEdit-{{ $item->id }}')"
                                class="px-6 py-2 bg-gray-100 text-gray-600 rounded-xl text-xs font-bold transition hover:bg-gray-200">
                                Batal
                            </button>

                            <button type="submit"
                                class="px-8 py-2 bg-[#f3a933] hover:bg-yellow-500 text-[#0f172a] rounded-xl text-xs font-bold shadow-lg transition">
                                Update
                            </button>
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
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

    </script>
@endpush