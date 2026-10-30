@extends('layouts.welcome')

@section('content')
<!-- Left Branding Showcase Panel -->
<div class="hidden lg:flex lg:col-span-5 bg-gradient-to-br from-brand-700 via-brand-800 to-slate-950 p-10 flex-col justify-between text-white relative overflow-hidden">
    <div class="relative z-10">
        <div class="flex items-center gap-3 mb-10">
            <div class="w-11 h-11 rounded-xl bg-white/10 backdrop-blur-md flex items-center justify-center border border-white/20 shadow-lg">
                <img src="{{ asset('/img/logoPustaka2.png') }}" alt="Logo" class="w-7 h-7 object-contain brightness-0 invert">
            </div>
            <div>
                <h2 class="text-xl font-extrabold tracking-tight">Pustakanesia</h2>
                <span class="text-xs font-semibold text-cyan-300 uppercase tracking-widest">Digital Library Portal</span>
            </div>
        </div>

        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/15 text-xs font-semibold text-brand-100 mb-6">
            <i class="fa-solid fa-sparkles text-amber-300"></i>
            <span>Sistem Informasi Terpadu</span>
        </div>

        <h1 class="text-3xl font-extrabold tracking-tight leading-tight mb-4">
            Akses Ribuan Koleksi Buku &amp; Referensi Terbaik.
        </h1>
        <p class="text-slate-300 text-sm leading-relaxed">
            Platform modern untuk menelusuri katalog, meminjam buku fisik, serta memantau riwayat peminjaman dengan cepat dan transparan.
        </p>
    </div>

    <div class="relative z-10 pt-8 border-t border-white/10">
        <div class="space-y-3 mb-6 text-xs text-slate-300">
            <div class="flex items-center gap-2.5">
                <i class="fa-solid fa-circle-check text-cyan-400"></i>
                <span>Peminjaman &amp; Pengembalian Cepat</span>
            </div>
            <div class="flex items-center gap-2.5">
                <i class="fa-solid fa-circle-check text-cyan-400"></i>
                <span>Manajemen Anggota &amp; Katalog Digital</span>
            </div>
            <div class="flex items-center gap-2.5">
                <i class="fa-solid fa-circle-check text-cyan-400"></i>
                <span>Cetak Rekapitulasi Laporan PDF</span>
            </div>
        </div>
        <p class="text-xs text-slate-400">&copy; {{ date('Y') }} Pustakanesia. All rights reserved.</p>
    </div>
</div>

<!-- Right Form Panel -->
<div class="lg:col-span-7 p-8 sm:p-12 flex flex-col justify-center bg-white">
    @auth
        <div class="text-center py-8">
            <div class="w-16 h-16 rounded-full bg-brand-50 text-brand-600 flex items-center justify-center mx-auto mb-4 text-2xl">
                <i class="fa-solid fa-user-check"></i>
            </div>
            <h2 class="text-2xl font-bold text-slate-900 mb-1">Selamat Datang Kembali!</h2>
            <p class="text-sm text-slate-500 mb-6">Anda telah masuk sebagai <strong>{{ auth()->user()->name }}</strong>.</p>
            <a href="{{ url('/home') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-brand-600 text-white font-semibold text-sm hover:bg-brand-700 shadow-md shadow-brand-500/20 transition-all">
                <span>Buka Dashboard</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    @else
        <!-- Mobile Logo -->
        <div class="flex lg:hidden items-center gap-2.5 mb-6">
            <div class="w-9 h-9 rounded-lg bg-brand-600 flex items-center justify-center shadow-md shadow-brand-500/30">
                <img src="{{ asset('/img/logoPustaka2.png') }}" alt="Logo" class="w-5 h-5 object-contain brightness-0 invert">
            </div>
            <div>
                <span class="text-base font-bold text-slate-900">Pustakanesia</span>
                <span class="text-[10px] text-brand-600 font-semibold uppercase tracking-wider block">Digital Library</span>
            </div>
        </div>

        <div class="mb-6">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Masuk ke Akun</h2>
            <p class="text-sm text-slate-500 mt-1">Masukkan alamat email dan kata sandi Anda.</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email Field -->
            <div>
                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Alamat Email
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <i class="fa-solid fa-envelope text-sm"></i>
                    </span>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border {{ $errors->has('email') ? 'border-rose-400 ring-rose-200 ring-2' : 'border-slate-300' }} focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all"
                           placeholder="nama@email.com">
                </div>
                @error('email')
                    <p class="text-rose-600 text-xs font-semibold mt-1 flex items-center gap-1">
                        <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Password Field -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Kata Sandi
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-xs font-semibold text-brand-600 hover:text-brand-700">Lupa sandi?</a>
                    @endif
                </div>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <i class="fa-solid fa-lock text-sm"></i>
                    </span>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border {{ $errors->has('password') ? 'border-rose-400 ring-rose-200 ring-2' : 'border-slate-300' }} focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all"
                           placeholder="Masukkan kata sandi">
                </div>
                @error('password')
                    <p class="text-rose-600 text-xs font-semibold mt-1 flex items-center gap-1">
                        <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Remember checkbox -->
            <div class="flex items-center justify-between py-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                           class="w-4 h-4 rounded text-brand-600 border-slate-300 focus:ring-brand-500">
                    <span class="text-xs text-slate-600 font-medium select-none">Ingat saya di perangkat ini</span>
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full py-3 px-4 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-sm shadow-lg shadow-brand-600/30 hover:shadow-brand-600/40 transform hover:-translate-y-0.5 active:translate-y-0 transition-all flex items-center justify-center gap-2">
                <i class="fa-solid fa-right-to-bracket"></i>
                <span>Masuk Sekarang</span>
            </button>

            <!-- Register Link -->
            <div class="text-center pt-4 border-t border-slate-100">
                <p class="text-xs text-slate-500">
                    Belum memiliki akun anggota?
                    <a href="{{ route('register') }}" class="font-bold text-brand-600 hover:text-brand-700 ml-1">
                        Daftar Akun Baru &rarr;
                    </a>
                </p>
            </div>
        </form>
    @endauth
</div>
@endsection
