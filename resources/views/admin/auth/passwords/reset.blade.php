<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Password Baru - Graha Land Serang</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen relative overflow-hidden font-sans">
    
    <!-- Background Accents -->
    <div class="absolute top-[-10%] left-[-5%] w-[600px] h-[600px] bg-[#5E8E2E]/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-[-10%] right-[-5%] w-[600px] h-[600px] bg-[#3F6A1F]/10 rounded-full blur-3xl"></div>

    <div class="max-w-4xl w-full mx-4 bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row relative z-10 min-h-[550px] border border-slate-100">
        
        <!-- Left Side -->
        <div class="w-full md:w-1/2 relative bg-[#5E8E2E] text-white p-10 flex flex-col justify-between overflow-hidden" style="clip-path: polygon(0 0, 100% 0, 80% 100%, 0 100%);">
            <div class="absolute top-0 right-0 w-full h-[150%] bg-[#7eb644]/40 origin-top-right -rotate-[30deg] translate-x-12 -translate-y-20 z-0"></div>
            <div class="absolute left-6 top-1/2 -translate-y-1/2 -rotate-180 z-10" style="writing-mode: vertical-rl;">
                <h2 class="text-6xl font-extrabold text-white/30 uppercase tracking-widest leading-none">Security</h2>
            </div>
            <div class="relative z-10 flex-1 flex flex-col justify-center items-center px-12 md:pl-20 md:pr-10">
                <img src="/storage/artifacts/admin_login_illustration.webp" alt="Dashboard" class="w-full max-w-[240px] drop-shadow-xl mix-blend-multiply" onerror="this.src='{{ asset('images/logo/logo graha land serang.png') }}'; this.classList.remove('mix-blend-multiply'); this.classList.add('mix-blend-multiply');">
            </div>
        </div>

        <!-- Right Side: Reset Password Form -->
        <div class="w-full md:w-1/2 p-10 md:p-14 flex flex-col justify-center bg-white relative">
            <div class="max-w-xs mx-auto w-full">
                <!-- Header -->
                <div class="mb-8 text-center md:text-left">
                    <h1 class="text-2xl font-black text-[#5E8E2E] tracking-tight uppercase">Password Baru</h1>
                    <p class="text-sm text-slate-500 mt-2 leading-relaxed">Silakan masukkan kata sandi baru Anda dengan aman.</p>
                </div>
                
                @if($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-600 p-4 rounded-r-lg mb-8 text-sm font-medium shadow-sm">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('admin.password.update') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <!-- Email Input -->
                    <div>
                        <label class="block text-sm font-bold text-[#1e293b] mb-2">Email</label>
                        <div class="relative flex items-center">
                            <div class="absolute left-4 text-slate-400">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <input type="email" name="email" value="{{ $email ?? old('email') }}" readonly required 
                                class="w-full pl-12 pr-4 py-3 text-sm text-slate-500 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#5E8E2E] focus:ring-1 focus:ring-[#5E8E2E] transition-colors cursor-not-allowed">
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-bold text-[#1e293b] mb-2">Password Baru</label>
                        <div class="relative flex items-center">
                            <div class="absolute left-4 text-slate-400">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <input type="password" name="password" required 
                                class="w-full pl-12 pr-4 py-3 text-sm text-slate-700 bg-white border border-slate-300 rounded-xl focus:outline-none focus:border-[#5E8E2E] focus:ring-1 focus:ring-[#5E8E2E] transition-colors" 
                                placeholder="Minimal 8 karakter">
                        </div>
                    </div>

                    <!-- Konfirmasi Password -->
                    <div>
                        <label class="block text-sm font-bold text-[#1e293b] mb-2">Konfirmasi Password Baru</label>
                        <div class="relative flex items-center">
                            <div class="absolute left-4 text-slate-400">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <input type="password" name="password_confirmation" required 
                                class="w-full pl-12 pr-4 py-3 text-sm text-slate-700 bg-white border border-slate-300 rounded-xl focus:outline-none focus:border-[#5E8E2E] focus:ring-1 focus:ring-[#5E8E2E] transition-colors" 
                                placeholder="Ulangi password">
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full bg-[#5E8E2E] hover:bg-[#476e22] text-white font-bold py-3.5 rounded-full transition-all duration-300 shadow-md tracking-wide text-sm">
                            Simpan Password & Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
