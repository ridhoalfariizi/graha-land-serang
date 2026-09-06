<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Graha Land Serang</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen relative overflow-hidden font-sans">
    
    <!-- Background Accents -->
    <div class="absolute top-[-10%] left-[-5%] w-[600px] h-[600px] bg-[#5E8E2E]/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-[-10%] right-[-5%] w-[600px] h-[600px] bg-[#3F6A1F]/10 rounded-full blur-3xl"></div>

    <div class="max-w-4xl w-full mx-4 bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row relative z-10 min-h-[550px] border border-slate-100">
        
        <!-- Left Side: Branding -->
        <div class="w-full md:w-1/2 relative bg-[#5E8E2E] text-white p-10 flex flex-col justify-between overflow-hidden" style="clip-path: polygon(0 0, 100% 0, 80% 100%, 0 100%);">
            <div class="absolute top-0 right-0 w-full h-[150%] bg-[#7eb644]/40 origin-top-right -rotate-[30deg] translate-x-12 -translate-y-20 z-0"></div>
            <div class="absolute left-6 top-1/2 -translate-y-1/2 -rotate-180 z-10" style="writing-mode: vertical-rl;">
                <h2 class="text-6xl font-extrabold text-white/30 uppercase tracking-widest leading-none">Recover</h2>
            </div>
            <div class="relative z-10 flex-1 flex flex-col justify-center items-center px-12 md:pl-20 md:pr-10">
                <img src="/storage/artifacts/admin_login_illustration.webp" alt="Dashboard" class="w-full max-w-[240px] drop-shadow-xl mix-blend-multiply" onerror="this.src='{{ asset('images/logo/logo graha land serang.png') }}'; this.classList.remove('mix-blend-multiply'); this.classList.add('mix-blend-multiply');">
            </div>
            <div class="relative z-10 mt-8 text-left pl-8 border-l-2 border-white/30">
                <p class="text-[10px] uppercase tracking-[0.2em] font-bold text-white/90">Introducing Graha Land</p>
                <p class="text-[9px] uppercase tracking-widest text-white/60 mt-1">Admin Operating System</p>
            </div>
        </div>

        <!-- Right Side: Reset Request Form -->
        <div class="w-full md:w-1/2 p-10 md:p-14 flex flex-col justify-center bg-white relative">
            <div class="max-w-xs mx-auto w-full">
                <!-- Header -->
                <div class="mb-8 text-center md:text-left">
                    <h1 class="text-2xl font-black text-[#5E8E2E] tracking-tight uppercase">Lupa Password?</h1>
                    <p class="text-sm text-slate-500 mt-2 leading-relaxed">Masukkan email Anda untuk kami kirimkan tautan reset kata sandi.</p>
                </div>

                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-r-lg mb-8 text-sm font-medium shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-600 p-4 rounded-r-lg mb-8 text-sm font-medium shadow-sm">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('admin.password.email') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="mb-5">
                        <label class="block text-sm font-bold text-[#1e293b] mb-2">Email Akun Admin</label>
                        <div class="relative flex items-center">
                            <div class="absolute left-4 text-slate-400">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <input type="email" name="email" value="{{ old('email') }}" required 
                                class="w-full pl-12 pr-4 py-3 text-sm text-slate-700 bg-white border border-slate-300 rounded-xl focus:outline-none focus:border-[#5E8E2E] focus:ring-1 focus:ring-[#5E8E2E] transition-colors" 
                                placeholder="nama@perusahaan.com">
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-[#5E8E2E] hover:bg-[#476e22] text-white font-bold py-3.5 rounded-full transition-all duration-300 shadow-md tracking-wide text-sm">
                            Kirim Tautan Reset
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center">
                    <a href="{{ route('admin.login') }}" class="text-xs font-bold text-[#5E8E2E]/80 hover:text-[#5E8E2E] transition">&larr; Kembali ke halaman Login</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
