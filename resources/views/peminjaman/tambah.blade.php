@extends('layouts.master')

@section('sidebar')
    @include('part.sidebar')
@endsection

@section('topbar')
    @include('part.topbar')
@endsection

@section('judul')
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Formulir Peminjaman Buku</h1>
        <p class="text-sm text-slate-500 mt-0.5">Catat transaksi peminjaman buku untuk anggota perpustakaan.</p>
    </div>
    <a href="/peminjaman" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold transition-all shadow-sm">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Kembali ke Riwayat</span>
    </a>
@endsection

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-10 mb-8">
            <form action="/peminjaman" method="POST" class="space-y-6">
                @csrf

                <!-- Peminjam Selection -->
                <div>
                    <label for="users_id" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Anggota Peminjam <span class="text-rose-500">*</span>
                    </label>

                    @if (Auth::user()->isAdmin == 1)
                        <select name="users_id" id="users_id" required
                                class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('users_id') ? 'border-rose-400 ring-rose-200 ring-2' : 'border-slate-300' }} focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all bg-white">
                            <option value="">-- Pilih Mahasiswa Peminjam --</option>
                            @forelse ($peminjam as $item)
                                <option value="{{ $item->id }}" {{ old('users_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->user->name }} &mdash; NPM: {{ $item->npm }} ({{ $item->prodi }})
                                </option>
                            @empty
                                <option disabled>Belum ada data anggota</option>
                            @endforelse
                        </select>
                    @else
                        <select name="users_id" id="users_id" readonly
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm bg-slate-50 text-slate-700 font-medium">
                            <option value="{{ $peminjam->users_id }}" selected>
                                {{ $peminjam->user->name }} (NPM: {{ $peminjam->npm }})
                            </option>
                        </select>
                    @endif

                    @error('users_id')
                        <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buku Selection -->
                <div>
                    <label for="buku_id" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Buku yang Dipinjam <span class="text-rose-500">*</span>
                    </label>
                    <select name="buku_id" id="buku_id" required
                            class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('buku_id') ? 'border-rose-400 ring-rose-200 ring-2' : 'border-slate-300' }} focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all bg-white">
                        <option value="">-- Pilih Judul Buku dari Koleksi --</option>
                        @forelse ($buku as $item)
                            <option value="{{ $item->id }}" {{ old('buku_id') == $item->id ? 'selected' : '' }}>
                                [{{ $item->kode_buku }}] {{ $item->judul }} &mdash; Status: {{ $item->status ?? 'Tersedia' }}
                            </option>
                        @empty
                            <option disabled>Tidak ada buku yang tersedia saat ini</option>
                        @endforelse
                    </select>
                    @error('buku_id')
                        <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Info Notice -->
                <div class="p-4 rounded-2xl bg-brand-50/60 border border-brand-100 flex items-start gap-3 text-xs text-brand-900 leading-relaxed">
                    <i class="fa-solid fa-calendar-check text-brand-600 text-sm mt-0.5"></i>
                    <div>
                        <strong class="font-bold block mb-0.5">Ketentuan Otomatis</strong>
                        Tanggal pinjam dicatat hari ini (<strong>{{ date('d F Y') }}</strong>). Tanggal wajib pengembalian ditetapkan otomatis <strong>7 hari ke depan</strong>.
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                    <a href="/peminjaman" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-700 font-semibold text-sm hover:bg-slate-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-sm shadow-md shadow-brand-500/20 transition-all flex items-center gap-2">
                        <i class="fa-solid fa-check"></i>
                        <span>Konfirmasi Peminjaman</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
