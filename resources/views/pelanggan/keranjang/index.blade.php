@extends('layouts.pelanggan')

@section('title', 'Keranjang Sewa - Lenscape')

@section('content')
<div class="max-w-7xl mx-auto px-4 md:px-6 py-12">

    <!-- HEADER KERANJANG -->
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 flex items-center gap-3">
            <i class="fas fa-shopping-cart text-[#f3a933]"></i> Keranjang Sewa
        </h1>
        <p class="text-sm text-gray-500 mt-2">Pilih alat yang mau lu sewa sekarang.</p>
    </div>

    <!-- ALERT NOTIFIKASI -->
    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
        <i class="fas fa-check-circle"></i>
        <span class="text-sm font-semibold">{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
        <i class="fas fa-exclamation-triangle text-xl"></i>
        <div>
            <span class="text-sm font-bold block">Gagal Checkout!</span>
            <span class="text-xs">{{ session('error') }}</span>
        </div>
    </div>
    @endif

    <!-- KONTEN UTAMA KERANJANG -->
    <div class="flex flex-col lg:flex-row gap-8 items-start">

        <!-- LIST BARANG DI KERANJANG (KIRI) -->
        <div class="w-full lg:w-2/3 space-y-4">

            @if(!empty($keranjang))
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex items-center gap-3">
                <input type="checkbox" id="check-all" class="w-5 h-5 accent-[#f3a933] cursor-pointer" checked>
                <label for="check-all" class="text-sm font-bold text-gray-700 cursor-pointer">Pilih Semua Alat</label>
            </div>
            @endif

            @forelse($keranjang as $id => $item)
            <div class="bg-white rounded-2xl p-4 md:p-5 shadow-sm border border-gray-100 flex flex-col sm:flex-row items-start sm:items-center gap-5 hover:shadow-md transition">

                <input type="checkbox" class="item-checkbox w-5 h-5 accent-[#f3a933] cursor-pointer mt-2 sm:mt-0"
                    value="{{ $id }}"
                    data-subtotal="{{ $item['harga_sewa'] * $item['lama_sewa'] }}"
                    checked>

                <div class="w-full sm:w-28 aspect-square bg-gray-50 rounded-xl overflow-hidden flex-shrink-0 relative border border-gray-100">
                    <img src="{{ $item['gambar'] }}" class="w-full h-full object-contain p-2" alt="{{ $item['nama'] }}">
                </div>

                <div class="flex-grow w-full">
                    <div class="flex justify-between items-start mb-1">
                        <span class="text-[9px] font-black uppercase tracking-widest text-[#f3a933]">{{ $item['kategori'] }}</span>
                        <form action="{{ route('pelanggan.keranjang.destroy', $id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-500 transition p-1" title="Hapus">
                                <i class="fas fa-trash-alt text-sm"></i>
                            </button>
                        </form>
                    </div>
                    <h3 class="font-bold text-gray-800 text-base md:text-lg mb-2 line-clamp-1">{{ $item['nama'] }}</h3>
                    <p class="text-gray-900 font-black mb-4">Rp {{ number_format($item['harga_sewa'], 0, ',', '.') }}<span class="text-[10px] text-gray-400 font-normal"> / hari</span></p>

                    <div class="flex items-center gap-1 bg-gray-50 w-fit p-1 rounded-lg border border-gray-200">
                        <form action="{{ route('pelanggan.keranjang.update', $id) }}" method="POST">
                            @csrf @method('PUT')
                            <input type="hidden" name="action" value="minus">
                            <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-md bg-white text-gray-600 hover:bg-gray-200 transition shadow-sm"><i class="fas fa-minus text-[10px]"></i></button>
                        </form>
                        <div class="flex flex-col items-center px-3">
                            <span class="text-xs font-bold text-gray-800">{{ $item['lama_sewa'] }} Hari</span>
                        </div>
                        <form action="{{ route('pelanggan.keranjang.update', $id) }}" method="POST">
                            @csrf @method('PUT')
                            <input type="hidden" name="action" value="plus">
                            <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-md bg-white text-gray-600 hover:bg-gray-200 transition shadow-sm"><i class="fas fa-plus text-[10px]"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-2xl p-12 shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center">
                <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-box-open text-4xl text-gray-300"></i>
                </div>
                <h3 class="font-bold text-gray-800 text-lg mb-2">Keranjang Masih Kosong</h3>
                <p class="text-gray-500 text-sm mb-6">Yuk, temukan perlengkapan camping dan kamera impianmu sekarang!</p>
                <a href="{{ route('pelanggan.dashboard') }}" class="px-6 py-2.5 bg-[#0f172a] text-white rounded-xl text-xs font-bold uppercase tracking-widest hover:bg-[#f3a933] transition shadow-lg">Mulai Jelajah</a>
            </div>
            @endforelse
        </div>

        <!-- RINGKASAN PESANAN (KANAN) -->
        <div class="w-full lg:w-1/3">
            <div class="bg-[#0f172a] rounded-2xl p-6 md:p-8 shadow-xl sticky top-28 text-white border border-white/5 relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-[#f3a933] rounded-full blur-3xl opacity-20"></div>

                <h3 class="font-bold text-lg mb-6 flex items-center gap-2 relative z-10">
                    <i class="fas fa-receipt text-[#f3a933]"></i> Ringkasan Pesanan
                </h3>

                <div class="space-y-4 text-sm text-gray-300 mb-6 border-b border-white/10 pb-6 relative z-10">
                    <div class="flex justify-between items-center">
                        <span>Total Item Dipilih</span>
                        <span id="txt-total-item" class="font-medium">0 Alat</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span>Subtotal Harga</span>
                        <span id="txt-subtotal" class="font-medium">Rp 0</span>
                    </div>
                </div>

                <div class="flex justify-between items-end mb-8 relative z-10">
                    <span class="text-xs uppercase tracking-widest font-bold text-gray-400">Total Akhir</span>
                    <span id="txt-total-akhir" class="text-2xl font-black text-[#f3a933]">Rp 0</span>
                </div>

                <form action="{{ route('pelanggan.checkout.proses') }}" method="POST" id="form-checkout" class="relative z-10">
                    @csrf
                    <input type="hidden" name="selected_items" id="input-selected-items" value="">
                    <button type="button" id="btn-checkout" class="w-full py-4 bg-[#f3a933] text-[#0f172a] rounded-xl text-xs font-black uppercase tracking-widest hover:bg-[#d98e1d] transition shadow-[0_10px_20px_rgba(243,169,51,0.3)] flex justify-center items-center gap-2">
                        Lanjut Pembayaran <i class="fas fa-arrow-right"></i>
                    </button>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    // LOGIKA JAVASCRIPT BUAT HITUNG-HITUNGAN OTOMATIS
    const checkAll = document.getElementById('check-all');
    const checkboxes = document.querySelectorAll('.item-checkbox');
    const txtTotalItem = document.getElementById('txt-total-item');
    const txtSubtotal = document.getElementById('txt-subtotal');
    const txtTotalAkhir = document.getElementById('txt-total-akhir');
    const inputSelected = document.getElementById('input-selected-items');
    const btnCheckout = document.getElementById('btn-checkout');
    const formCheckout = document.getElementById('form-checkout');

    function calculateCart() {
        let totalItems = 0;
        let totalPrice = 0;
        let selectedIds = [];

        checkboxes.forEach(cb => {
            if (cb.checked) {
                totalItems++;
                totalPrice += parseInt(cb.dataset.subtotal);
                selectedIds.push(cb.value);
            }
        });

        if (txtTotalItem) txtTotalItem.innerText = totalItems + ' Alat';
        if (txtSubtotal) txtSubtotal.innerText = 'Rp ' + totalPrice.toLocaleString('id-ID');
        if (txtTotalAkhir) txtTotalAkhir.innerText = 'Rp ' + totalPrice.toLocaleString('id-ID');

        if (inputSelected) inputSelected.value = selectedIds.join(',');

        if (btnCheckout) {
            if (totalItems === 0) {
                btnCheckout.disabled = true;
                btnCheckout.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                btnCheckout.disabled = false;
                btnCheckout.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }
    }

    checkboxes.forEach(cb => {
        cb.addEventListener('change', () => {
            calculateCart();
            // Batalin check-all kalau ada satu yang gak diceklis
            if (!cb.checked && checkAll) checkAll.checked = false;
        });
    });

    if (checkAll) {
        checkAll.addEventListener('change', function() {
            checkboxes.forEach(cb => {
                cb.checked = this.checked;
            });
            calculateCart();
        });
    }

    if (btnCheckout) {
        btnCheckout.addEventListener('click', function() {
            if (inputSelected && inputSelected.value !== '') {
                formCheckout.submit();
            }
        });
    }

    calculateCart();
</script>
@endpush