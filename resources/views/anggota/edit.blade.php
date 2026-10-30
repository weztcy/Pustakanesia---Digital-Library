@extends('layouts.master')

@section('sidebar')
    @include('part.sidebar')
@endsection

@section('topbar')
    @include('part.topbar')
@endsection

@section('judul')
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Perbarui Data Anggota</h1>
        <p class="text-sm text-slate-500 mt-0.5">Ubah informasi identitas mahasiswa, nomor kontak, atau perbarui foto profil.</p>
    </div>
    <a href="/anggota" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold transition-all shadow-sm">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Kembali ke Data Anggota</span>
    </a>
@endsection

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-10 mb-8">
            <form action="/anggota/{{ $profile->user->id }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Row 1: Nama & NPM -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Nama Lengkap <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name', $profile->user->name) }}" required
                               class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('name') ? 'border-rose-400 ring-rose-200 ring-2' : 'border-slate-300' }} focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all">
                        @error('name')
                            <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="npm" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            NPM (Nomor Induk Mahasiswa) <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="npm" name="npm" value="{{ old('npm', $profile->npm) }}" required
                               class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('npm') ? 'border-rose-400 ring-rose-200 ring-2' : 'border-slate-300' }} focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm font-mono transition-all">
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
                        <input type="text" id="prodi" name="prodi" value="{{ old('prodi', $profile->prodi) }}" required
                               class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('prodi') ? 'border-rose-400 ring-rose-200 ring-2' : 'border-slate-300' }} focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all">
                        @error('prodi')
                            <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="noTelp" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Nomor WhatsApp / Telp <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="noTelp" name="noTelp" value="{{ old('noTelp', $profile->noTelp) }}" required
                               class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('noTelp') ? 'border-rose-400 ring-rose-200 ring-2' : 'border-slate-300' }} focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all">
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
                              class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('alamat') ? 'border-rose-400 ring-rose-200 ring-2' : 'border-slate-300' }} focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all">{{ old('alamat', $profile->alamat) }}</textarea>
                    @error('alamat')
                        <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Foto Profil -->
                <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-3">
                        <i class="fa-solid fa-image text-brand-600 mr-1"></i> Perbarui Foto Profil (Opsional)
                    </label>
                    <div class="flex items-center gap-4">
                        <img src="{{ $profile->photo_profile_url }}" alt="Foto Profil" 
                             class="w-16 h-16 rounded-full object-cover ring-2 ring-slate-200">
                        <div class="flex-1">
                            <input type="file" name="photoProfile" id="photoProfile" accept="image/*"
                                   class="block w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 transition-all cursor-pointer">
                            <p class="text-[11px] text-slate-400 mt-1">Maksimal 2MB. Format: JPG, JPEG, PNG.</p>
                            @error('photoProfile')
                                <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                    <a href="/anggota" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-700 font-semibold text-sm hover:bg-slate-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-bold text-sm shadow-md shadow-amber-500/20 transition-all flex items-center gap-2">
                        <i class="fa-solid fa-check"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
