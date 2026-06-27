<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Lenscape</title>

    <link rel="icon" href="{{ asset('images/Lenscape-Logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .font-serif {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4 sm:p-8">

    <div class="bg-white w-full max-w-4xl rounded-3xl shadow-[0_20px_50px_rgba(0,_0,_0,_0.05)] flex flex-col md:flex-row overflow-hidden border border-gray-100 min-h-[500px]">

        <div class="hidden md:flex md:w-1/2 bg-[#fce8d5] relative items-center justify-center overflow-hidden">
            <div class="absolute w-[300px] h-[300px] lg:w-[350px] lg:h-[350px] bg-[#f5d5b5] rounded-full z-0"></div>

            <img src="{{ asset('images/barang/Traveller.png') }}"
                alt="Traveler"
                class="z-10 relative object-contain h-[85%] w-[85%] drop-shadow-xl">
        </div>

        <div class="w-full md:w-1/2 p-6 sm:p-10 lg:p-12 flex flex-col justify-center">

            <div class="text-center mb-6">
                <h1 class="text-3xl font-serif font-black text-gray-900 mb-1">Lenscape</h1>
                <h2 class="text-base font-bold text-gray-700 mt-5">Login to your Account</h2>
                <p class="text-[10px] text-gray-500 mt-1 font-medium">See what is going on with your business</p>
            </div>

            <div class="flex items-center mb-5">
                <hr class="flex-1 border-gray-200">
                <span class="px-3 text-[9px] text-gray-400 font-semibold uppercase tracking-wider">or Sign in with Email</span>
                <hr class="flex-1 border-gray-200">
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3.5">
                    <label for="email" class="block text-[10px] font-semibold text-gray-500 mb-1">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="mail@abc.com"
                        class="w-full border border-gray-200 rounded-lg px-3.5 py-2 text-sm focus:ring-2 focus:ring-[#f3a933] focus:border-[#f3a933] outline-none transition">
                    @error('email')
                    <p class="text-red-500 text-[10px] mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-[10px] font-semibold text-gray-500 mb-1">Password</label>
                    <input id="password" type="password" name="password" required placeholder="••••••••••••"
                        class="w-full border border-gray-200 rounded-lg px-3.5 py-2 text-sm focus:ring-2 focus:ring-[#f3a933] focus:border-[#f3a933] outline-none transition">
                    @error('password')
                    <p class="text-red-500 text-[10px] mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-3 h-3 text-[#f3a933] rounded border-gray-300 focus:ring-[#f3a933]">
                        <span class="text-[10px] font-semibold text-gray-500">Remember Me</span>
                    </label>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-[10px] font-bold text-[#f3a933] hover:text-orange-500 transition">Forgot Password?</a>
                    @endif
                </div>

                <button type="submit" class="w-full bg-[#fae0c5] hover:bg-[#f3a933] text-gray-900 hover:text-white font-bold py-2.5 rounded-lg transition text-xs shadow-sm">
                    Login
                </button>
            </form>

            <div class="mt-5 text-center text-[10px] text-gray-400 font-medium">
                Not Registered Yet?
                <a href="{{ route('register') }}" class="text-[#f3a933] font-bold hover:underline transition">Create an account</a>
            </div>

        </div>
    </div>

</body>

</html>