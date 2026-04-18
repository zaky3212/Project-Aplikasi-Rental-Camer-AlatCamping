<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lenscape - Sewa Kamera & Alat Camping Batam</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        .blob-bg {
            border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
        }
    </style>
</head>

<body class="bg-white text-gray-800 antialiased relative">

    <div class="absolute top-0 right-0 -z-10 w-[500px] h-[500px] bg-[#fff5e8] rounded-full blur-3xl opacity-60"></div>

    <header class="sticky top-0 z-50 w-full bg-white/80 backdrop-blur-md shadow-sm border-b border-gray-100 transition-all duration-300">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <h1 class="text-3xl font-serif font-black text-[#0f172a] tracking-tight">Lens<span class="text-[#f3a933]">cape</span></h1>
            </div>

            <nav class="hidden md:flex items-center gap-10 font-medium text-sm text-gray-700">
                <a href="#" class="hover:text-[#f3a933] transition">Beranda</a>
                <a href="#kamera" class="hover:text-[#f3a933] transition">Kamera</a>
                <a href="#camping" class="hover:text-[#f3a933] transition">Alat Camping</a>
                <a href="#tentang" class="hover:text-[#f3a933] transition">Tentang Kami</a>
            </nav>

            <div class="hidden md:flex items-center gap-4">
                @auth
                <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('pelanggan.dashboard') }}" class="px-5 py-2 bg-[#0f172a] text-white text-sm font-semibold rounded-lg hover:bg-gray-800 transition shadow-lg">
                    Ke Dashboard
                </a>
                @else
                <a href="{{ route('login') }}" class="font-medium text-sm text-gray-800 hover:text-[#f3a933] transition">Login</a>
                <a href="{{ route('register') }}" class="px-5 py-2 bg-[#f3a933] text-[#0f172a] text-sm font-semibold rounded-lg hover:bg-yellow-500 transition shadow-[0_10px_20px_rgba(243,169,51,0.3)]">
                    Daftar
                </a>
                @endauth
            </div>

            <button class="md:hidden text-2xl text-gray-800">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <section class="container mx-auto px-6 pt-10 pb-20 flex flex-col-reverse md:flex-row items-center gap-12 relative z-10">

        <div class="w-full md:w-1/2 flex flex-col items-start">
            <p class="text-[#f3a933] font-bold text-sm tracking-widest uppercase mb-4">Gaya Terbaik Untuk Petualanganmu</p>
            <h2 class="text-5xl md:text-6xl font-serif font-black text-[#181e4b] leading-[1.2] mb-6">
                Jelajahi Alam, <span class="relative inline-block"><span class="relative z-10">Abadikan Setiap</span><img src="https://raw.githubusercontent.com/hasankhadra/jadoo/main/images/Decore.png" class="absolute bottom-1 right-0 -z-0 w-full h-auto" alt=""></span> Momen Tanpa Batas
            </h2>
            <p class="text-gray-500 mb-8 leading-relaxed text-sm md:text-base pr-0 md:pr-10">
                Pusat penyewaan kamera dan alat camping terlengkap di Batam. Kualitas terjamin, harga bersahabat, siap menemani setiap perjalanan epikmu.
            </p>
            <div class="flex items-center gap-6">
                <a href="#" class="px-8 py-4 bg-[#f3a933] text-white text-sm font-bold rounded-xl hover:bg-yellow-500 transition shadow-[0_15px_30px_rgba(243,169,51,0.4)]">
                    Sewa Sekarang
                </a>
                <a href="#" class="flex items-center gap-3 text-gray-600 font-medium hover:text-[#f3a933] transition">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-[0_15px_30px_rgba(0,0,0,0.1)] text-[#f3a933]">
                        <i class="fas fa-play ml-1"></i>
                    </div>
                    Play Demo
                </a>
            </div>
        </div>

        <div class="w-full md:w-1/2 relative flex justify-center">
            <div class="absolute top-10 right-10 w-[350px] h-[350px] md:w-[450px] md:h-[450px] bg-[#fce8d5] blob-bg -z-10"></div>
            <img src="{{ asset('images/barang/Traveller.png') }}" alt="Traveler" class="w-[85%] object-contain drop-shadow-2xl rounded-3xl z-10 border-[10px] border-white">
        </div>
    </section>

    <section class="container mx-auto px-6 py-20 relative">
        <div class="text-center mb-16 relative z-10">
            <p class="text-gray-500 font-semibold text-sm tracking-wider uppercase mb-2">Keunggulan Lenscape</p>
            <h3 class="text-4xl font-serif font-black text-[#181e4b]">MENGAPA MEMILIH KAMI?</h3>
        </div>

        <div class="absolute top-10 right-10 text-[#fff1da] text-6xl -z-10 font-sans tracking-widest leading-none">++++<br>++++<br>++++</div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="bg-white p-8 rounded-[30px] text-center transition hover:shadow-[0_20px_50px_rgba(0,0,0,0.08)] group">
                <div class="w-20 h-20 mx-auto mb-6 flex items-center justify-center bg-blue-50 rounded-2xl group-hover:bg-[#f3a933] transition duration-300">
                    <i class="fas fa-camera text-3xl text-blue-900 group-hover:text-white transition"></i>
                </div>
                <h4 class="font-bold text-[#181e4b] mb-3 text-lg">Kualitas Terjamin</h4>
                <p class="text-gray-500 text-sm leading-relaxed">Seluruh unit dirawat rutin dan dipastikan berfungsi 100% sebelum disewa.</p>
            </div>
            <div class="bg-white p-8 rounded-[30px] text-center shadow-[0_20px_50px_rgba(0,0,0,0.08)] relative group">
                <div class="absolute -bottom-6 -left-6 w-24 h-24 bg-[#f3a933] rounded-tl-[30px] rounded-br-[30px] -z-10"></div>
                <div class="w-20 h-20 mx-auto mb-6 flex items-center justify-center bg-blue-50 rounded-2xl group-hover:bg-[#f3a933] transition duration-300">
                    <i class="fas fa-hand-pointer text-3xl text-blue-900 group-hover:text-white transition"></i>
                </div>
                <h4 class="font-bold text-[#181e4b] mb-3 text-lg">Sewa Praktis</h4>
                <p class="text-gray-500 text-sm leading-relaxed">Proses booking mudah secara online. Tinggal klik, bayar, dan ambil barangnya.</p>
            </div>
            <div class="bg-white p-8 rounded-[30px] text-center transition hover:shadow-[0_20px_50px_rgba(0,0,0,0.08)] group">
                <div class="w-20 h-20 mx-auto mb-6 flex items-center justify-center bg-blue-50 rounded-2xl group-hover:bg-[#f3a933] transition duration-300">
                    <i class="fas fa-wallet text-3xl text-blue-900 group-hover:text-white transition"></i>
                </div>
                <h4 class="font-bold text-[#181e4b] mb-3 text-lg">Harga Bersahabat</h4>
                <p class="text-gray-500 text-sm leading-relaxed">Sewa alat berkualitas tinggi gak perlu bikin kantong jebol, pas untuk mahasiswa.</p>
            </div>
            <div class="bg-white p-8 rounded-[30px] text-center transition hover:shadow-[0_20px_50px_rgba(0,0,0,0.08)] group">
                <div class="w-20 h-20 mx-auto mb-6 flex items-center justify-center bg-blue-50 rounded-2xl group-hover:bg-[#f3a933] transition duration-300">
                    <i class="fas fa-headset text-3xl text-blue-900 group-hover:text-white transition"></i>
                </div>
                <h4 class="font-bold text-[#181e4b] mb-3 text-lg">Support 24/7</h4>
                <p class="text-gray-500 text-sm leading-relaxed">Admin sigap membantu jika kamu bingung cara pakai atau ada kendala teknis.</p>
            </div>
        </div>
    </section>

    <section id="kamera" class="container mx-auto px-6 py-16">
        <div class="text-center mb-12">
            <p class="text-gray-500 font-semibold text-sm tracking-wider mb-2">Favorite</p>
            <h3 class="text-4xl font-serif font-black text-[#181e4b]">Kamera</h3>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
            @for ($i = 0; $i < 4; $i++)
                <div class="bg-white border border-gray-100 rounded-2xl p-4 hover:shadow-xl transition relative group">
                <div class="relative h-[200px] bg-gray-50 rounded-xl mb-4 overflow-hidden flex items-center justify-center">
                    <img src="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Kamera" class="object-cover h-full w-full group-hover:scale-110 transition duration-500">
                    <button class="absolute top-3 right-3 bg-white w-8 h-8 rounded-full shadow flex items-center justify-center text-gray-400 hover:text-red-500 transition">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
                <h4 class="font-bold text-[#181e4b] text-base truncate pr-2">Sony Alpha A6000</h4>
                <div class="flex justify-between items-center mt-3">
                    <p class="text-[#f3a933] font-bold">Rp 150.000<span class="text-xs text-gray-400 font-normal">/hari</span></p>
                    <a href="#" class="w-8 h-8 rounded-full bg-blue-50 text-blue-900 flex items-center justify-center hover:bg-[#f3a933] hover:text-white transition">
                        <i class="fas fa-plus text-xs"></i>
                    </a>
                </div>
        </div>
        @endfor
        </div>

        <div class="text-center">
            <a href="#" class="inline-block px-8 py-3 bg-gray-100 text-gray-600 font-semibold rounded-xl hover:bg-gray-200 transition text-sm">
                Lihat Lebih Banyak
            </a>
        </div>
    </section>

    <section id="camping" class="container mx-auto px-6 py-16">
        <div class="text-center mb-12">
            <p class="text-gray-500 font-semibold text-sm tracking-wider mb-2">Favorite</p>
            <h3 class="text-4xl font-serif font-black text-[#181e4b]">Alat Camping</h3>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
            @for ($i = 0; $i < 4; $i++)
                <div class="bg-white border border-gray-100 rounded-2xl p-4 transition duration-300 hover:shadow-xl relative group">
                <div class="relative h-[200px] bg-gray-50 rounded-xl mb-4 overflow-hidden flex items-center justify-center">
                    <img src="https://images.unsplash.com/photo-1523987355523-c7b5b0dd90a7?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Tenda" class="object-cover h-full w-full group-hover:scale-110 transition duration-500">
                    <button class="absolute top-3 right-3 bg-white w-8 h-8 rounded-full shadow flex items-center justify-center text-gray-400 hover:text-red-500 transition">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
                <h4 class="font-bold text-[#181e4b] text-base truncate pr-2">Tenda Dome Kapasitas 4</h4>
                <div class="flex justify-between items-center mt-3">
                    <p class="text-[#f3a933] font-bold">Rp 45.000<span class="text-xs text-gray-400 font-normal">/hari</span></p>
                    <a href="#" class="w-8 h-8 rounded-full bg-blue-50 text-blue-900 flex items-center justify-center hover:bg-[#f3a933] hover:text-white transition">
                        <i class="fas fa-plus text-xs"></i>
                    </a>
                </div>
        </div>
        @endfor
        </div>

        <div class="text-center">
            <a href="#" class="inline-block px-8 py-3 bg-gray-100 text-gray-600 font-semibold rounded-xl hover:bg-gray-200 transition text-sm">
                Lihat Lebih Banyak
            </a>
        </div>
    </section>

    <section id="tentang" class="container mx-auto px-6 py-20 relative">
        <div class="text-center mb-16">
            <p class="text-gray-500 font-semibold text-sm tracking-wider uppercase mb-2">Topselling</p>
            <h3 class="text-4xl font-serif font-black text-[#181e4b]">Destinasi Favorit</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-5xl mx-auto relative z-10">
            <div class="bg-white rounded-3xl overflow-hidden shadow-xl group">
                <div class="h-64 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1542314831-c6a4d14effea?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Destinasi" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                </div>
                <div class="p-6">
                    <div class="flex justify-between text-[#181e4b] font-semibold mb-3 text-lg">
                        <h4>Gunung Bromo</h4>
                        <p>IDR 2.5jt</p>
                    </div>
                    <p class="text-gray-500 text-sm flex items-center gap-3"><i class="fas fa-location-arrow"></i> 3 Hari Trip</p>
                </div>
            </div>
            <div class="bg-white rounded-3xl overflow-hidden shadow-xl group relative">
                <div class="h-64 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1518684079-3c830dcef090?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Destinasi" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                </div>
                <div class="p-6">
                    <div class="flex justify-between text-[#181e4b] font-semibold mb-3 text-lg">
                        <h4>Danau Toba</h4>
                        <p>IDR 1.2jt</p>
                    </div>
                    <p class="text-gray-500 text-sm flex items-center gap-3"><i class="fas fa-location-arrow"></i> 2 Hari Trip</p>
                </div>
            </div>
            <div class="bg-white rounded-3xl overflow-hidden shadow-xl group">
                <div class="h-64 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1533587851505-d119e13fa0d7?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Destinasi" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                </div>
                <div class="p-6">
                    <div class="flex justify-between text-[#181e4b] font-semibold mb-3 text-lg">
                        <h4>Raja Ampat</h4>
                        <p>IDR 5.5jt</p>
                    </div>
                    <p class="text-gray-500 text-sm flex items-center gap-3"><i class="fas fa-location-arrow"></i> 5 Hari Trip</p>
                </div>
            </div>
            <div class="absolute -bottom-10 -right-16 text-[#f3a933] text-[150px] leading-none opacity-20 -z-10 font-serif">@</div>
        </div>
    </section>

    <footer class="container mx-auto px-6 py-16 mt-10 border-t border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-8 mb-12">
            <div class="md:col-span-2">
                <h1 class="text-4xl font-serif font-black text-[#181e4b] mb-4 tracking-tight">Lens<span class="text-[#f3a933]">cape.</span></h1>
                <p class="text-gray-500 text-sm mb-6 max-w-xs leading-relaxed">Booking kamera dan alat campingmu dalam hitungan menit, dan nikmati petualangan tanpa batas.</p>
            </div>
            <div>
                <h4 class="font-bold text-[#181e4b] text-lg mb-4">Company</h4>
                <ul class="space-y-3 text-gray-500 text-sm font-medium">
                    <li><a href="#" class="hover:text-[#f3a933] transition">About</a></li>
                    <li><a href="#" class="hover:text-[#f3a933] transition">Careers</a></li>
                    <li><a href="#" class="hover:text-[#f3a933] transition">Mobile</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-[#181e4b] text-lg mb-4">Contact</h4>
                <ul class="space-y-3 text-gray-500 text-sm font-medium">
                    <li><a href="#" class="hover:text-[#f3a933] transition">Help/FAQ</a></li>
                    <li><a href="#" class="hover:text-[#f3a933] transition">Press</a></li>
                    <li><a href="#" class="hover:text-[#f3a933] transition">Affiliates</a></li>
                </ul>
            </div>
            <div>
                <div class="flex items-center gap-3 mb-6">
                    <a href="#" class="w-10 h-10 bg-white shadow-lg rounded-full flex items-center justify-center text-gray-600 hover:bg-[#f3a933] hover:text-white transition"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="w-10 h-10 bg-white shadow-lg rounded-full flex items-center justify-center text-gray-600 hover:bg-[#f3a933] hover:text-white transition"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="w-10 h-10 bg-white shadow-lg rounded-full flex items-center justify-center text-gray-600 hover:bg-[#f3a933] hover:text-white transition"><i class="fab fa-twitter"></i></a>
                </div>
                <h4 class="font-bold text-gray-500 text-lg mb-3 tracking-wider">Discover our app</h4>
                <div class="flex items-center gap-3">
                    <a href="#" class="bg-black text-white px-3 py-1.5 rounded-full flex items-center gap-2 text-[10px] hover:bg-gray-800 transition">
                        <i class="fab fa-google-play text-lg"></i>
                        <div class="text-left">
                            <span class="block text-[8px] uppercase">Get it on</span>
                            <span class="block font-bold">Google Play</span>
                        </div>
                    </a>
                    <a href="#" class="bg-black text-white px-3 py-1.5 rounded-full flex items-center gap-2 text-[10px] hover:bg-gray-800 transition">
                        <i class="fab fa-apple text-xl"></i>
                        <div class="text-left">
                            <span class="block text-[8px] uppercase">Available on the</span>
                            <span class="block font-bold">App Store</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="text-center text-gray-500 text-sm font-medium">
            <p>All rights reserved &copy; {{ date('Y') }} Lenscape</p>
        </div>
    </footer>

</body>

</html>