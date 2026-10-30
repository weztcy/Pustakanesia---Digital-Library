@extends('layouts.master')

@section('sidebar')
    @include('part.sidebar')
@endsection

@section('topbar')
    @include('part.topbar')
@endsection

@section('judul')
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Formulir Pengembalian Buku</h1>
        <p class="text-sm text-slate-500 mt-0.5">Catat pengembalian buku dan lakukan kalkulasi denda otomatis jika melewati tenggat.</p>
    </div>
    <a href="/peminjaman" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold transition-all shadow-sm">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Kembali ke Riwayat</span>
    </a>
@endsection

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-10 mb-8">
            <form action="/pengembalian" method="POST" class="space-y-6">
                @csrf

                <!-- Peminjam Selection -->
                <div>
                    <label for="users_id" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Nama Mahasiswa Peminjam <span class="text-rose-500">*</span>
                    </label>
                    <select name="users_id" id="users_id" required
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all bg-white">
                        <option value="">-- Pilih Mahasiswa yang Mengembalikan --</option>
                        @forelse ($peminjam as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->user->name }} &mdash; NPM: {{ $item->npm }} ({{ $item->prodi }})
                            </option>
                        @empty
                            <option disabled>Tidak ada peminjam aktif</option>
                        @endforelse
                    </select>
                </div>

                <!-- Buku Selection -->
                <div>
                    <label for="buku_id" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Judul Buku yang Dikembalikan <span class="text-rose-500">*</span>
                    </label>
                    <select name="buku_id" id="buku_id" required
                            class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('buku_id') ? 'border-rose-400 ring-rose-200 ring-2' : 'border-slate-300' }} focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all bg-white">
                        <option value="">-- Pilih Buku yang Sedang Dipinjam --</option>
                        @forelse ($buku as $item)
                            <option value="{{ $item->id }}">
                                [{{ $item->kode_buku }}] {{ $item->judul }} &mdash; Status: {{ $item->status ?? 'Dipinjam' }}
                            </option>
                        @empty
                            <option disabled>Tidak ada buku yang sedang dipinjam</option>
                        @endforelse
                    </select>
                    @error('buku_id')
                        <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Denda Warning Notice -->
                <div class="p-4 rounded-2xl bg-amber-50/70 border border-amber-200 flex items-start gap-3 text-xs text-amber-900 leading-relaxed">
                    <i class="fa-solid fa-calculator text-amber-600 text-sm mt-0.5"></i>
                    <div>
                        <strong class="font-bold block mb-0.5">Perhitungan Denda Otomatis</strong>
                        Jika tanggal pengembalian melebihi tenggat 7 hari, sistem akan menghitung denda Rp 15.000 / minggu keterlambatan dan menampilkan rinciannya pada notifikasi sukses.
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                    <a href="/peminjaman" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-700 font-semibold text-sm hover:bg-slate-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-sm shadow-md shadow-rose-500/20 transition-all flex items-center gap-2">
                        <i class="fa-solid fa-rotate-left"></i>
                        <span>Proses Pengembalian Buku</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
