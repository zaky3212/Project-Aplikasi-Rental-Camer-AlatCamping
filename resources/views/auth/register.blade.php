<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Lenscape</title>

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
                <h2 class="text-base font-bold text-gray-700 mt-4">Create an Account</h2>
                <p class="text-[10px] text-gray-500 mt-1 font-medium">Sign up to start your adventure with us</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3.5">
                    <label for="name" class="block text-[10px] font-semibold text-gray-500 mb-1">Full Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="John Doe"
                        class="w-full border border-gray-200 rounded-lg px-3.5 py-2 text-sm focus:ring-2 focus:ring-[#f3a933] focus:border-[#f3a933] outline-none transition">
                    @error('name')
                    <p class="text-red-500 text-[10px] mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3.5">
                    <label for="email" class="block text-[10px] font-semibold text-gray-500 mb-1">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="mail@abc.com"
                        class="w-full border border-gray-200 rounded-lg px-3.5 py-2 text-sm focus:ring-2 focus:ring-[#f3a933] focus:border-[#f3a933] outline-none transition">
                    @error('email')
                    <p class="text-red-500 text-[10px] mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-6">
                    <div>
                        <label for="password" class="block text-[10px] font-semibold text-gray-500 mb-1">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="••••••••"
                            class="w-full border border-gray-200 rounded-lg px-3.5 py-2 text-sm focus:ring-2 focus:ring-[#f3a933] focus:border-[#f3a933] outline-none transition">
                        @error('password')
                        <p class="text-red-500 text-[10px] mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-[10px] font-semibold text-gray-500 mb-1">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••"
                            class="w-full border border-gray-200 rounded-lg px-3.5 py-2 text-sm focus:ring-2 focus:ring-[#f3a933] focus:border-[#f3a933] outline-none transition">
                        @error('password_confirmation')
                        <p class="text-red-500 text-[10px] mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="w-full bg-[#fae0c5] hover:bg-[#f3a933] text-gray-900 hover:text-white font-bold py-2.5 rounded-lg transition text-xs shadow-sm">
                    Register Account
                </button>
            </form>

            <div class="mt-5 text-center text-[10px] text-gray-400 font-medium">
                Already registered?
                <a href="{{ route('login') }}" class="text-[#f3a933] font-bold hover:underline transition">Log in here</a>
            </div>

        </div>
    </div>

</body>

</html>