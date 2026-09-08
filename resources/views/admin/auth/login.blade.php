<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Graha Land Serang Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen relative overflow-hidden font-sans">
    
    <!-- Background Accents (Optional subtle shapes) -->
    <div class="absolute top-[-10%] left-[-5%] w-96 h-96 bg-primary/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-[-10%] right-[-5%] w-96 h-96 bg-secondary/10 rounded-full blur-3xl"></div>

    <div class="max-w-5xl w-full mx-4 bg-white rounded-[2.5rem] shadow-2xl overflow-hidden flex flex-col md:flex-row relative z-10 min-h-[600px] border border-slate-100">
        
        <!-- Left Side: Branding / Illustration -->
        <!-- Using a clip-path for that diagonal curved look from the reference -->
        <div class="w-full md:w-[45%] relative bg-gradient-to-br from-primary to-[#3F6A1F] text-white p-10 flex flex-col justify-between overflow-hidden" style="clip-path: polygon(0 0, 100% 0, 85% 100%, 0 100%);">
            
            <!-- Diagonal sharp overlay to match reference exactly -->
            <div class="absolute top-0 right-0 w-full h-[150%] bg-white/10 origin-top-right -rotate-[35deg] translate-x-12 -translate-y-20 z-0"></div>

            <!-- Vertical Welcome Text -->
            <div class="absolute left-6 top-1/2 -translate-y-1/2 rotate-180 z-10" style="writing-mode: vertical-rl;">
                <h2 class="text-6xl font-black text-white/20 uppercase tracking-widest leading-none">Welcome</h2>
            </div>

            <!-- Content Container -->
            <div class="relative z-10 flex-1 flex flex-col justify-center items-center px-12">
                <!-- Replace src below with generated illustration -->
                <img src="/storage/artifacts/admin_login_illustration.webp" alt="Dashboard Illustration" class="w-full max-w-[280px] drop-shadow-2xl hover:scale-105 transition-transform duration-700 ease-in-out" onerror="this.src='{{ asset('images/logo/logo graha land serang.webp') }}'; this.classList.add('brightness-0', 'invert');">
            </div>

            <div class="relative z-10 mt-8 text-center px-8 border-l border-white/20">
                <p class="text-xs uppercase tracking-[0.2em] font-bold text-white/80">Introducing Graha Land</p>
                <p class="text-[10px] uppercase tracking-widest text-white/50 mt-1">Admin Operating System</p>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full md:w-[55%] p-10 md:p-16 flex flex-col justify-center bg-white relative">
            <div class="max-w-xs mx-auto w-full">
                <!-- Header -->
                <div class="mb-12 text-center md:text-left">
                    <h1 class="text-4xl font-black text-primary tracking-tight">LOGIN</h1>
                    <div class="w-12 h-1.5 bg-secondary mt-3 rounded-full md:mx-0 mx-auto"></div>
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

                <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-8">
                    @csrf
                    
                    <!-- Username / Email Input -->
                    <div class="mb-5">
                        <label class="block text-sm font-bold text-[#1e293b] mb-2">Email</label>
                        <div class="relative flex items-center">
                            <div class="absolute left-4 text-slate-400">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <input type="email" name="email" value="{{ old('email') }}" required 
                                class="w-full pl-12 pr-4 py-3 text-sm text-slate-700 bg-white border border-slate-300 rounded-xl focus:outline-none focus:border-[#5E8E2E] focus:ring-1 focus:ring-[#5E8E2E] transition-colors" 
                                placeholder="nama@perusahaan.com">
                        </div>
                    </div>
                    
                    <!-- Password Input -->
                    <div class="mb-5">
                        <label class="block text-sm font-bold text-[#1e293b] mb-2">Password</label>
                        <div class="relative flex items-center">
                            <div class="absolute left-4 text-slate-400">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <input type="password" name="password" id="password_input" required 
                                class="w-full pl-12 pr-12 py-3 text-sm text-slate-700 bg-white border border-slate-300 rounded-xl focus:outline-none focus:border-[#5E8E2E] focus:ring-1 focus:ring-[#5E8E2E] transition-colors" 
                                placeholder="••••••••">
                            <div class="absolute right-4 text-slate-400 hover:text-[#5E8E2E] transition-colors cursor-pointer flex items-center h-full" onclick="togglePassword()">
                                <svg id="eye_icon" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <div class="flex items-center">
                            <input type="checkbox" name="remember" id="remember" class="rounded border-slate-300 text-primary w-4 h-4 cursor-pointer focus:ring-0">
                            <label for="remember" class="ml-2 text-sm text-slate-500 cursor-pointer">Ingat saya</label>
                        </div>
                        <a href="{{ route('admin.password.request') }}" class="text-sm font-bold text-blue-700 hover:text-blue-800">Lupa password?</a>
                    </div>

                    <!-- Login Button -->
                    <div class="pt-4">
                        <button type="submit" class="w-full bg-primary hover:bg-primary-hover text-white font-bold py-4 rounded-full transition-all duration-300 shadow-lg shadow-primary/30 transform hover:-translate-y-1 hover:shadow-xl hover:shadow-primary/40 uppercase tracking-widest text-sm">
                            Login
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function togglePassword() {
            const pwd = document.getElementById('password_input');
            const icon = document.getElementById('eye_icon');
            if (pwd.type === "password") {
                pwd.type = "text";
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
            } else {
                pwd.type = "password";
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
            }
        }
    </script>
</body>
</html>
