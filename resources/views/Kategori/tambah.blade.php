@extends('layouts.master')

@section('sidebar')
    @include('part.sidebar')
@endsection

@section('topbar')
    @include('part.topbar')
@endsection

@section('judul')
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Tambah Kategori Baru</h1>
        <p class="text-sm text-slate-500 mt-0.5">Buat pengelompokan genre atau rumpun studi baru untuk katalog buku.</p>
    </div>
    <a href="/kategori" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold transition-all shadow-sm">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Kembali ke Kategori</span>
    </a>
@endsection

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-10 mb-8">
            <form action="/kategori" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="nama" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Nama Kategori <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required autofocus
                           class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('nama') ? 'border-rose-400 ring-rose-200 ring-2' : 'border-slate-300' }} focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all"
                           placeholder="Contoh: Pemrograman, Sains, Sastra Modern...">
                    @error('nama')
                        <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="deskripsi" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Deskripsi Kategori (Opsional)
                    </label>
                    <textarea id="deskripsi" name="deskripsi" rows="4"
                              class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all"
                              placeholder="Penjelasan ringkas mengenai kelompok buku ini...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                    <a href="/kategori" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-700 font-semibold text-sm hover:bg-slate-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-sm shadow-md shadow-brand-500/20 transition-all flex items-center gap-2">
                        <i class="fa-solid fa-check"></i>
                        <span>Simpan Kategori</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
