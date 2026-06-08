<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - Lenscape</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap'); body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
    
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>
<body class="bg-[#0f172a] text-white flex items-center justify-center min-h-screen relative overflow-hidden">

    <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?q=80&w=1638&auto=format&fit=crop')] bg-cover bg-center opacity-10"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-[#0f172a] via-[#0f172a]/80 to-transparent"></div>

    <div class="bg-white text-slate-900 p-8 md:p-10 rounded-3xl shadow-2xl max-w-md w-full mx-4 text-center relative z-10 overflow-hidden border border-gray-100">
        <div class="absolute -top-12 -right-12 w-40 h-40 bg-[#f3a933] rounded-full blur-3xl opacity-20"></div>

        <div class="w-20 h-20 bg-[#f3a933]/10 text-[#f3a933] border border-[#f3a933]/20 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl shadow-inner">
            <i class="fas fa-wallet"></i>
        </div>

        <h2 class="text-2xl md:text-3xl font-extrabold mb-2 text-gray-900">Selesaikan Pembayaran</h2>
        <p class="text-xs text-gray-500 mb-6">Kode Booking: <span class="font-bold text-[#f3a933] px-2 py-1 bg-[#f3a933]/10 rounded-md ml-1 tracking-wider">{{ $penyewaan->kode_transaksi }}</span></p>

        <div class="bg-gray-50 rounded-2xl p-6 mb-8 border border-gray-100 shadow-sm relative">
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-2">Total Tagihan Sewa</p>
            <p class="text-3xl md:text-4xl font-black text-[#0f172a]">Rp {{ number_format($penyewaan->total_harga, 0, ',', '.') }}</p>
        </div>

        <button id="pay-button" class="w-full py-4 bg-[#f3a933] text-[#0f172a] rounded-xl text-sm md:text-base font-black uppercase tracking-widest hover:bg-[#d98e1d] transition-all duration-300 shadow-[0_10px_20px_rgba(243,169,51,0.25)] hover:shadow-[0_15px_25px_rgba(243,169,51,0.4)] flex items-center justify-center gap-3">
            <i class="fas fa-shield-alt"></i> Bayar Sekarang
        </button>

        <div class="mt-6 flex flex-col items-center gap-3">
            <a href="{{ route('pelanggan.dashboard') }}" class="text-xs text-gray-400 hover:text-[#0f172a] transition-colors font-bold uppercase tracking-wider flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
            </a>
            <div class="flex items-center gap-2 text-[9px] text-gray-400 font-medium mt-4">
                <i class="fas fa-lock"></i> Secured by Midtrans
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            // Memanggil fitur Snap Midtrans berdasarkan Token yang dilempar dari Controller
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    // Kalau berhasil bayar, arahkan ke dashboard atau riwayat
                    window.location.href = "{{ route('pelanggan.dashboard') }}";
                },
                onPending: function(result){
                    alert("Menunggu pembayaran lu nih bre!"); console.log(result);
                },
                onError: function(result){
                    alert("Pembayaran gagal!"); console.log(result);
                },
                onClose: function(){
                    alert('Lu nutup popup sebelum bayar, jangan lupa diselesaikan transaksinya ya bre!');
                }
            });
        });
    </script>
</body>
</html>