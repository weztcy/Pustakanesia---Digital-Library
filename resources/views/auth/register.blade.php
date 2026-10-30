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
            <i class="fa-solid fa-user-plus text-cyan-300"></i>
            <span>Keanggotaan Mahasiswa</span>
        </div>

        <h1 class="text-3xl font-extrabold tracking-tight leading-tight mb-4">
            Bergabung &amp; Nikmati Fasilitas Literasi Modern.
        </h1>
        <p class="text-slate-300 text-sm leading-relaxed">
            Daftarkan akun anggota untuk mulai meminjam buku fisik, mengakses katalog perpustakaan, dan mengelola sirkulasi peminjaman.
        </p>
    </div>

    <div class="relative z-10 pt-6 border-t border-white/10">
        <div class="p-3.5 rounded-2xl bg-white/5 border border-white/10 text-xs text-slate-300 leading-relaxed mb-4">
            <p class="font-bold text-white mb-1"><i class="fa-solid fa-circle-info text-cyan-400 mr-1"></i> Catatan:</p>
            Pastikan Nomor Pokok Mahasiswa (NPM) dan nomor WhatsApp aktif agar petugas dapat memverifikasi transaksi pinjam buku.
        </div>
        <p class="text-xs text-slate-400">&copy; {{ date('Y') }} Pustakanesia. All rights reserved.</p>
    </div>
</div>

<!-- Right Register Form Panel -->
<div class="lg:col-span-7 p-8 sm:p-12 flex flex-col justify-center bg-white overflow-y-auto">
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
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Registrasi Anggota Baru</h2>
        <p class="text-sm text-slate-500 mt-1">Lengkapi data diri Anda untuk membuat akun perpustakaan.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Row 1: Name & NPM -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Nama Lengkap <span class="text-rose-500">*</span>
                </label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                       class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('name') ? 'border-rose-400 ring-rose-200 ring-2' : 'border-slate-300' }} focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all"
                       placeholder="Nama lengkap">
                @error('name')
                    <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="npm" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    NPM Mahasiswa <span class="text-rose-500">*</span>
                </label>
                <input id="npm" type="text" name="npm" value="{{ old('npm') }}" required
                       class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('npm') ? 'border-rose-400 ring-rose-200 ring-2' : 'border-slate-300' }} focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all"
                       placeholder="Contoh: A11.2023.12345">
                @error('npm')
                    <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Row 2: Prodi & No Telp -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="prodi" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Program Studi <span class="text-rose-500">*</span>
                </label>
                <input id="prodi" type="text" name="prodi" value="{{ old('prodi') }}" required
                       class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('prodi') ? 'border-rose-400 ring-rose-200 ring-2' : 'border-slate-300' }} focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all"
                       placeholder="Teknik Informatika">
                @error('prodi')
                    <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="noTelp" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Nomor WhatsApp / Telp <span class="text-rose-500">*</span>
                </label>
                <input id="noTelp" type="text" name="noTelp" value="{{ old('noTelp') }}" required
                       class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('noTelp') ? 'border-rose-400 ring-rose-200 ring-2' : 'border-slate-300' }} focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all"
                       placeholder="08xxxxxxxxxx">
                @error('noTelp')
                    <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Alamat -->
        <div>
            <label for="alamat" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                Alamat Domisili <span class="text-rose-500">*</span>
            </label>
            <textarea id="alamat" name="alamat" rows="2" required
                      class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('alamat') ? 'border-rose-400 ring-rose-200 ring-2' : 'border-slate-300' }} focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all"
                      placeholder="Alamat tempat tinggal saat ini">{{ old('alamat') }}</textarea>
            @error('alamat')
                <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                Alamat Email <span class="text-rose-500">*</span>
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                   class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('email') ? 'border-rose-400 ring-rose-200 ring-2' : 'border-slate-300' }} focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all"
                   placeholder="nama@email.com">
            @error('email')
                <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Row 3: Password & Confirm -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Kata Sandi <span class="text-rose-500">*</span>
                </label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                       class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('password') ? 'border-rose-400 ring-rose-200 ring-2' : 'border-slate-300' }} focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all"
                       placeholder="Minimal 8 karakter">
                @error('password')
                    <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password-confirm" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Ulangi Kata Sandi <span class="text-rose-500">*</span>
                </label>
                <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password"
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all"
                       placeholder="Konfirmasi sandi">
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full py-3 px-4 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-sm shadow-lg shadow-brand-600/30 hover:shadow-brand-600/40 transform hover:-translate-y-0.5 active:translate-y-0 transition-all flex items-center justify-center gap-2 mt-2">
            <i class="fa-solid fa-user-plus"></i>
            <span>Daftar Sekarang</span>
        </button>

        <!-- Login Link -->
        <div class="text-center pt-3 border-t border-slate-100">
            <p class="text-xs text-slate-500">
                Sudah memiliki akun perpustakaan?
                <a href="{{ route('login') }}" class="font-bold text-brand-600 hover:text-brand-700 ml-1">
                    Masuk di Sini &rarr;
                </a>
            </p>
        </div>
    </form>
</div>
@endsection
