@extends('layouts.pelanggan')

@section('title', 'Katalog Lengkap - Lenscape')

@section('content')
<div class="max-w-7xl mx-auto px-4 md:px-6 py-8 md:py-12 space-y-12">

    <!-- HEADER & SEARCH BAR -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-gray-200 pb-6">
        <div class="flex items-center gap-4">
            <a href="{{ url()->previous() }}"
                class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-[#0f172a] hover:text-white hover:border-[#0f172a] transition duration-300 shadow-sm group"
                title="Kembali">
                <i class="fas fa-arrow-left text-sm transition-transform group-hover:-translate-x-1"></i>
            </a>

            <div>
                <h1 class="text-2xl md:text-4xl font-extrabold text-gray-900 tracking-tight">Katalog Lengkap</h1>
                <p class="text-xs md:text-sm text-gray-500 mt-1">Menampilkan seluruh daftar barang yang kami sewakan.</p>
            </div>
        </div>

        <!-- SEARCH INPUT -->
        <div class="w-full md:w-80 relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                <i class="fas fa-search text-xs"></i>
            </span>
            <input type="text" id="searchInput" placeholder="Cari Nama atau Merk Barang..." class="w-full pl-9 pr-4 py-2 text-xs rounded-xl border border-gray-300 focus:outline-none focus:border-[#f3a933] bg-white text-gray-700 shadow-sm transition">
        </div>
    </div>

    <!-- DAFTAR KATEGORI & BARANG -->
    @foreach($categories as $cat)
    <section class="category-section bg-white rounded-3xl p-6 shadow-sm border border-gray-100">

        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-lg md:text-xl font-bold text-gray-800 tracking-tight">{{ $cat->nama_kategori }}</h2>
                <div class="h-1 w-12 bg-[#f3a933] mt-1.5 rounded-full"></div>
            </div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 md:gap-5 item-container">
            @foreach($cat->barang as $item)
            <div class="barang-item bg-gray-50/60 rounded-2xl border border-gray-100 p-3 flex flex-col justify-between hover:shadow-md transition duration-300 group relative text-left"
                data-name="{{ strtolower($item->nama) }}"
                data-merk="{{ strtolower($item->merk) }}">

                <div class="absolute top-5 right-5 z-10">
                    @if($item->stok > 0)
                    <span class="px-2 py-0.5 bg-emerald-500 text-white text-[7px] font-black uppercase rounded-full shadow">Tersedia</span>
                    @else
                    <span class="px-2 py-0.5 bg-red-500 text-white text-[7px] font-black uppercase rounded-full shadow">Habis</span>
                    @endif
                </div>

                <a href="{{ route('pelanggan.Katalog.detail_barang', $item->id) }}" class="block">
                    <div class="aspect-square w-full bg-white rounded-xl p-3 flex items-center justify-center relative overflow-hidden shadow-sm">
                        @if($item->gambar)
                        <img src="{{ asset($item->gambar) }}" class="max-h-full object-contain transition duration-500 group-hover:scale-105" alt="{{ $item->nama }}">
                        @else
                        <div class="text-center text-gray-300">
                            <i class="fas fa-camera text-2xl mb-1 block"></i>
                            <span class="text-[9px] font-medium text-gray-400">No Image</span>
                        </div>
                        @endif
                    </div>
                </a>

                <div class="mt-3 space-y-1 flex-grow flex flex-col justify-between">
                    <a href="{{ route('pelanggan.Katalog.detail_barang', $item->id) }}" class="block">
                        <span class="text-[8px] font-bold text-[#f3a933] uppercase tracking-wider block">{{ $item->merk }}</span>
                        <h3 class="font-bold text-gray-800 text-xs line-clamp-1 group-hover:text-[#f3a933] transition" title="{{ $item->nama }}">
                            {{ $item->nama }}
                        </h3>
                        <p class="text-[9px] text-gray-400 font-medium">Stok: {{ $item->stok }} Unit</p>
                    </a>

                    <div class="pt-2 border-t border-gray-200/60 mt-2">
                        <div class="text-center mb-2">
                            <span class="text-[11px] font-black text-gray-900 block">
                                Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}<span class="text-[8px] text-gray-400 font-normal">/Hari</span>
                            </span>
                        </div>

                        <!-- FORM BOOKING YANG SUDAH DIPERBAIKI (Method POST) -->
                        <form action="{{ route('pelanggan.keranjang.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="barang_id" value="{{ $item->id }}">
                            <button type="submit" {{ $item->stok <= 0 ? 'disabled' : '' }}
                                class="w-full py-1.5 bg-[#f3a933] text-[#0f172a] hover:bg-[#0f172a] hover:text-white rounded-lg text-[9px] font-black uppercase tracking-wider transition duration-300 shadow-sm disabled:opacity-40 disabled:cursor-not-allowed">
                                BOOKING
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- PESAN JIKA BARANG TIDAK DITEMUKAN DI KATEGORI TERSEBUT -->
        <div class="hidden text-center py-6 no-result-msg">
            <p class="text-xs text-gray-400 font-medium italic">Barang tidak ditemukan pada kategori ini.</p>
        </div>
    </section>
    @endforeach

</div>
@endsection

@push('scripts')
<script>
    // SCRIPT LIVE SEARCH BARANG
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const items = document.querySelectorAll('.barang-item');
        const sections = document.querySelectorAll('.category-section');

        searchInput.addEventListener('keyup', function(e) {
            const term = e.target.value.toLowerCase();

            sections.forEach(section => {
                const sectionItems = section.querySelectorAll('.barang-item');
                const noResultMsg = section.querySelector('.no-result-msg');
                let hasVisibleItems = false;

                sectionItems.forEach(item => {
                    const name = item.getAttribute('data-name');
                    const merk = item.getAttribute('data-merk');

                    // Cek apakah term pencarian ada di nama ATAU merk
                    if (name.includes(term) || merk.includes(term)) {
                        item.style.display = 'flex'; // Munculin barang
                        hasVisibleItems = true;
                    } else {
                        item.style.display = 'none'; // Sembunyiin barang
                    }
                });

                // Tampilkan pesan jika semua item dalam satu kategori disembunyikan
                if (!hasVisibleItems) {
                    noResultMsg.classList.remove('hidden');
                } else {
                    noResultMsg.classList.add('hidden');
                }
            });
        });
    });
</script>
@endpush