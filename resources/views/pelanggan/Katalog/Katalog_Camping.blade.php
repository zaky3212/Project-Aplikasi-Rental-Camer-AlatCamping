@extends('layouts.pelanggan')

@section('title', 'Katalog Alat Camping - Lenscape')

@section('content')
    <section class="relative h-[60vh] md:h-[450px] overflow-hidden">
        <img src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?q=80&w=1638&auto=format&fit=crop" class="w-full h-full object-cover brightness-[0.4]" alt="Banner Camping">
        <div class="absolute inset-0 flex items-center px-6 md:px-20">
            <div class="text-white mt-10 md:mt-12 w-full">
                <div class="inline-block px-3 py-1 bg-[#f3a933]/20 border border-[#f3a933]/30 rounded-full text-[#f3a933] text-[9px] md:text-[10px] font-bold uppercase tracking-widest mb-4">
                    Adventure Ready
                </div>
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold leading-tight">Perlengkapan<br><span class="text-[#f3a933]">Alat Camping</span></h1>
                <p class="mt-4 text-gray-300 max-w-lg text-xs md:text-base leading-relaxed opacity-90">Siapkan petualangan Anda dengan perlengkapan outdoor premium. Tangguh di segala medan, nyaman di setiap pendakian.</p>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 md:px-6 py-12 md:py-20 space-y-16 md:space-y-24">
        @foreach($categories as $cat)
        <section>
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-8 md:mb-10 gap-4">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 flex items-center gap-3 md:gap-4">
                        <span class="p-2 md:p-3 bg-white shadow-sm rounded-xl md:rounded-2xl text-[#f3a933]">
                            <i class="fas {{ Str::contains(strtolower($cat->nama_kategori), 'tenda') ? 'fa-campground' : 'fa-mountain' }} fa-fw"></i>
                        </span>
                        {{ $cat->nama_kategori }}
                    </h2>
                    <div class="h-1 w-16 md:w-20 bg-[#f3a933] mt-3 rounded-full"></div>
                </div>
                <a href="{{ route('pelanggan.Katalog.Katalog_Camping.semua') }}" class="text-gray-400 hover:text-[#f3a933] transition-colors flex items-center gap-2 text-[10px] md:text-sm font-bold uppercase tracking-wider">
                    Lihat Semua <i class="fas fa-chevron-right text-[10px]"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 xs:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-4 md:gap-8">
                @foreach($cat->barang as $item)
                <div class="bg-white rounded-[1.5rem] md:rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-500 border border-gray-100 overflow-hidden group relative flex flex-col">
                    <div class="absolute top-3 right-3 md:top-4 md:right-4 z-10">
                        @if($item->stok > 0)
                        <span class="px-2 md:px-3 py-1 bg-emerald-500 text-white text-[8px] md:text-[9px] font-black uppercase rounded-full shadow-md">Tersedia</span>
                        @else
                        <span class="px-2 md:px-3 py-1 bg-red-500 text-white text-[8px] md:text-[9px] font-black uppercase rounded-full shadow-md">Habis</span>
                        @endif
                    </div>

                    <a href="{{ route('pelanggan.Katalog.detail_barang', $item->id) }}" class="block flex-grow flex flex-col">
                        <div class="aspect-square bg-gray-50 p-4 md:p-6 flex items-center justify-center relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-200/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            @if($item->gambar)
                            <img src="{{ asset($item->gambar) }}" class="max-h-full object-contain transition-transform duration-700 group-hover:scale-110" alt="{{ $item->nama }}">
                            @else
                            <div class="text-center text-gray-300">
                                <i class="fas fa-campground text-4xl mb-1 block"></i>
                                <span class="text-[10px] font-semibold text-gray-400">No Image</span>
                            </div>
                            @endif
                        </div>

                        <div class="p-4 md:p-6 flex-grow flex flex-col justify-between">
                            <div>
                                <p class="text-[8px] md:text-[10px] text-[#f3a933] font-black uppercase tracking-[0.2em] mb-1">{{ $item->merk }}</p>
                                <h3 class="font-bold text-gray-800 text-sm md:text-base truncate group-hover:text-[#f3a933] transition-colors mb-2" title="{{ $item->nama }}">
                                    {{ $item->nama }}
                                </h3>
                            </div>
                        </div>
                    </a>

                    <div class="px-4 pb-4 md:px-6 md:pb-6">
                        <div class="pt-4 border-t border-gray-50">
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex flex-col">
                                    <span class="text-[8px] md:text-[9px] text-gray-400 uppercase font-bold">Sewa</span>
                                    <span class="text-xs md:text-sm font-black text-gray-900">
                                        Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}<span class="text-[9px] md:text-[10px] text-gray-400 font-normal">/hari</span>
                                    </span>
                                </div>
                                <div class="text-right">
                                    <span class="text-[8px] md:text-[9px] text-gray-400 uppercase font-bold block">Stok</span>
                                    <span class="text-[10px] md:text-xs font-bold text-gray-700">{{ $item->stok }} Pcs</span>
                                </div>
                            </div>

                            <form action="{{ route('pelanggan.keranjang.index') }}" method="GET">
                                <button type="submit" {{ $item->stok <= 0 ? 'disabled' : '' }} class="w-full py-2.5 md:py-3 bg-[#0f172a] text-white rounded-lg md:rounded-xl text-[9px] md:text-[10px] font-black uppercase tracking-widest hover:bg-[#f3a933] hover:text-[#0f172a] transition-all duration-300 shadow-md disabled:opacity-50 disabled:cursor-not-allowed">
                                    <i class="fas fa-calendar-plus mr-1 md:mr-2"></i> Booking
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endforeach
    </div>
@endsection