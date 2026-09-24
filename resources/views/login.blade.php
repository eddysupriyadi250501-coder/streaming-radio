<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Radio Suara Kota</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            /* Ganti URL di bawah dengan path gambar lokal Anda, contoh: '/images/studio.jpg' */
            background-image: url('https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            height: 100vh;
        }
    </style>
</head>
<body class="flex items-center justify-center">

    <div class="bg-white/10 backdrop-blur-md w-full max-w-md p-8 rounded-3xl shadow-2xl border border-white/20 text-white">
        
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold">RADIO SUARA KOTA</h1>
            <p class="text-red-700 font-bold tracking-[0.2em] text-sm uppercase mt-1">105.9 FM Mataram</p>
        </div>

        <form action="/login-proses" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Email address*</label>
                <div class="relative">
                    <input type="email" name="email" required placeholder="Email address" 
                           class="w-full p-3 bg-white/10 border border-white/20 rounded-xl outline-none focus:ring-2 focus:ring-red-500 placeholder-white/30">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Password*</label>
                <div class="relative">
                    <input type="password" name="password" required placeholder="Password" 
                           class="w-full p-3 bg-white/10 border border-white/20 rounded-xl outline-none focus:ring-2 focus:ring-red-500 placeholder-white/30">
                </div>
            </div>

            <div class="mb-6 flex items-center">
                <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded border-white/20 bg-white/10 text-red-600 focus:ring-red-500">
                <label for="remember" class="ml-2 text-sm">Remember me</label>
            </div>

            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-xl font-bold transition duration-300 shadow-lg">
                Masuk Sekarang
            </button>
        </form>
    </div>

</body>
</html>