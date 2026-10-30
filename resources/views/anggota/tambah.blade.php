@extends('layouts.master')

@section('sidebar')
    @include('part.sidebar')
@endsection

@section('topbar')
    @include('part.topbar')
@endsection

@section('judul')
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Registrasi Anggota Baru</h1>
        <p class="text-sm text-slate-500 mt-0.5">Daftarkan akun mahasiswa baru ke sistem informasi perpustakaan.</p>
    </div>
    <a href="/anggota" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold transition-all shadow-sm">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Kembali ke Data Anggota</span>
    </a>
@endsection

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-10 mb-8">
            <form action="/anggota" method="POST" class="space-y-6">
                @csrf

                <!-- Row 1: Nama & NPM -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Nama Lengkap <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                               class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('name') ? 'border-rose-400 ring-rose-200 ring-2' : 'border-slate-300' }} focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all"
                               placeholder="Nama lengkap mahasiswa">
                        @error('name')
                            <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="npm" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            NPM (Nomor Induk Mahasiswa) <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="npm" name="npm" value="{{ old('npm') }}" required
                               class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('npm') ? 'border-rose-400 ring-rose-200 ring-2' : 'border-slate-300' }} focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm font-mono transition-all"
                               placeholder="A11.2023.12345">
                        @error('npm')
                            <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Row 2: Prodi & No Telp -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="prodi" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Program Studi <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="prodi" name="prodi" value="{{ old('prodi') }}" required
                               class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('prodi') ? 'border-rose-400 ring-rose-200 ring-2' : 'border-slate-300' }} focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all"
                               placeholder="Contoh: Teknik Informatika">
                        @error('prodi')
                            <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="noTelp" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Nomor WhatsApp / Telp <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="noTelp" name="noTelp" value="{{ old('noTelp') }}" required
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

                <!-- Row 3: Email & Password -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Alamat Email Akun <span class="text-rose-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                               class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('email') ? 'border-rose-400 ring-rose-200 ring-2' : 'border-slate-300' }} focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all"
                               placeholder="nama@email.com">
                        @error('email')
                            <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Kata Sandi Default <span class="text-rose-500">*</span>
                        </label>
                        <input type="password" id="password" name="password" required
                               class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('password') ? 'border-rose-400 ring-rose-200 ring-2' : 'border-slate-300' }} focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all"
                               placeholder="Minimal 8 karakter">
                        @error('password')
                            <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                    <a href="/anggota" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-700 font-semibold text-sm hover:bg-slate-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-sm shadow-md shadow-brand-500/20 transition-all flex items-center gap-2">
                        <i class="fa-solid fa-user-plus"></i>
                        <span>Daftarkan Anggota</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
