<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Item - Lenscape</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-stone-50 text-stone-800 font-sans">
    <div class="min-h-screen flex flex-col md:flex-row">

        <!-- SIDEBAR -->
        <aside class="w-full md:w-64 bg-teal-900 text-white flex flex-col shadow-xl">
            <div class="p-6 flex items-center justify-between md:justify-center border-b border-teal-800">
                <h1 class="text-2xl font-bold tracking-widest">LENS<span class="text-teal-400">CAPE</span></h1>
                <button class="md:hidden text-white focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 hidden md:block">
                <a href="{{ route('dashboard.view') }}" class="flex items-center gap-3 px-4 py-3 text-teal-100 hover:bg-teal-800 hover:text-white rounded-lg font-medium transition-colors">
                    <i class="fas fa-layer-group w-5"></i> Overview
                </a>

                <a href="/item" class="flex items-center gap-3 px-4 py-3 bg-teal-800 rounded-lg text-white font-medium shadow-inner">
                    <i class="fas fa-camera w-5"></i> List Barang
                </a>
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 flex flex-col h-screen overflow-y-auto">

            <header class="bg-white shadow-sm px-8 py-4 flex items-center justify-between sticky top-0 z-10">
                <h2 class="text-2xl font-bold text-stone-800">List Barang</h2>
            </header>

            <div class="p-6">

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-stone-800">Daftar Item</h3>

                        <button class="bg-teal-600 hover:bg-teal-700 text-white px-5 py-2.5 rounded-lg font-medium shadow-lg shadow-teal-200 transition-all flex items-center gap-2">
                            <i class="fas fa-plus"></i> Tambah Item
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-stone-200 bg-stone-50">
                                    <th class="py-3 px-4 text-sm font-semibold text-stone-600">Nama Item</th>
                                    <th class="py-3 px-4 text-sm font-semibold text-stone-600">Kategori</th>
                                    <th class="py-3 px-4 text-sm font-semibold text-stone-600">Stok</th>
                                    <th class="py-3 px-4 text-sm font-semibold text-stone-600">Harga Sewa</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-stone-100">
                                @foreach ($items as $item)
                                <tr class="hover:bg-stone-50 transition-colors">
                                    <td class="py-4 px-4 font-medium text-stone-800">{{ $item['nama'] }}</td>
                                    <td class="py-4 px-4 text-stone-600">{{ $item['kategori'] }}</td>
                                    <td class="py-4 px-4 text-stone-600">{{ $item['stok'] }}</td>
                                    <td class="py-4 px-4 text-stone-600">Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>
</body>
</html>