@extends('layouts.master')

@section('sidebar')
    @include('part.sidebar')
@endsection

@section('topbar')
    @include('part.topbar')
@endsection

@section('judul')
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Ruang Baca Anggota</h1>
        <p class="text-sm text-slate-500 mt-0.5">Selamat datang, <strong>{{ Auth::user()->name }}</strong>! Akses koleksi buku dan pantau transaksi Anda.</p>
    </div>
    <div class="flex items-center gap-2">
        <a href="/buku" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold shadow-md shadow-brand-500/20 transition-all">
            <i class="fa-solid fa-book-open"></i>
            <span>Jelajahi Buku</span>
        </a>
        <a href="/peminjaman/create" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold transition-all shadow-sm">
            <i class="fa-solid fa-hand-holding-hand text-brand-600"></i>
            <span>Ajukan Pinjam</span>
        </a>
    </div>
@endsection

@section('content')
    <!-- KPI Metrics for Anggota -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <!-- Card 1: Koleksi Buku -->
        <div class="bg-gradient-to-br from-brand-600 to-indigo-800 rounded-2xl p-6 text-white shadow-lg shadow-brand-600/20 relative overflow-hidden flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-bold uppercase tracking-wider text-brand-200">Katalog Buku</span>
                <div class="w-10 h-10 rounded-xl bg-white/15 backdrop-blur-md flex items-center justify-center text-lg">
                    <i class="fa-solid fa-book-bookmark"></i>
                </div>
            </div>
            <div>
                <span class="text-3xl font-extrabold tracking-tight">{{ $buku }}</span>
                <span class="text-xs text-brand-200 ml-1">Koleksi Tersedia</span>
            </div>
            <div class="mt-4 pt-3 border-t border-white/10">
                <a href="/buku" class="text-xs font-semibold text-brand-100 hover:text-white flex items-center gap-1.5 group">
                    <span>Lihat Katalog</span>
                    <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>

        <!-- Card 2: Kategori -->
        <div class="bg-gradient-to-br from-cyan-600 to-sky-800 rounded-2xl p-6 text-white shadow-lg shadow-cyan-600/20 relative overflow-hidden flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-bold uppercase tracking-wider text-cyan-200">Pilihan Kategori</span>
                <div class="w-10 h-10 rounded-xl bg-white/15 backdrop-blur-md flex items-center justify-center text-lg">
                    <i class="fa-solid fa-tags"></i>
                </div>
            </div>
            <div>
                <span class="text-3xl font-extrabold tracking-tight">{{ $kategori }}</span>
                <span class="text-xs text-cyan-200 ml-1">Genre &amp; Topik</span>
            </div>
            <div class="mt-4 pt-3 border-t border-white/10">
                <a href="/kategori" class="text-xs font-semibold text-cyan-100 hover:text-white flex items-center gap-1.5 group">
                    <span>Eksplor Kategori</span>
                    <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>

        <!-- Card 3: Rekan Mahasiswa -->
        <div class="bg-gradient-to-br from-emerald-600 to-teal-800 rounded-2xl p-6 text-white shadow-lg shadow-emerald-600/20 relative overflow-hidden flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-200">Komunitas Anggota</span>
                <div class="w-10 h-10 rounded-xl bg-white/15 backdrop-blur-md flex items-center justify-center text-lg">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
            <div>
                <span class="text-3xl font-extrabold tracking-tight">{{ $user }}</span>
                <span class="text-xs text-emerald-200 ml-1">Mahasiswa Aktif</span>
            </div>
            <div class="mt-4 pt-3 border-t border-white/10">
                <span class="text-xs text-emerald-100">Terdaftar di Sistem</span>
            </div>
        </div>

        <!-- Card 4: Pinjaman Aktif -->
        <div class="bg-gradient-to-br from-rose-600 to-pink-800 rounded-2xl p-6 text-white shadow-lg shadow-rose-600/20 relative overflow-hidden flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-bold uppercase tracking-wider text-rose-200">Pinjaman Aktif Anda</span>
                <div class="w-10 h-10 rounded-xl bg-white/15 backdrop-blur-md flex items-center justify-center text-lg">
                    <i class="fa-solid fa-clock"></i>
                </div>
            </div>
            <div>
                <span class="text-3xl font-extrabold tracking-tight">{{ $pinjamanUser }}</span>
                <span class="text-xs text-rose-200 ml-1">Buku Dipinjam</span>
            </div>
            <div class="mt-4 pt-3 border-t border-white/10">
                <a href="/peminjaman" class="text-xs font-semibold text-rose-100 hover:text-white flex items-center gap-1.5 group">
                    <span>Lihat Pinjaman</span>
                    <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Informasi & Aturan Peminjaman Banner -->
    <div class="bg-gradient-to-br from-slate-900 to-slate-950 rounded-3xl p-8 text-white border border-slate-800 shadow-xl relative overflow-hidden">
        <div class="flex items-center gap-3.5 mb-6">
            <div class="w-11 h-11 rounded-xl bg-brand-500/20 text-brand-400 flex items-center justify-center text-xl border border-brand-500/30">
                <i class="fa-solid fa-circle-info"></i>
            </div>
            <div>
                <h2 class="text-lg font-bold text-white">Ketentuan &amp; Regulasi Peminjaman Buku</h2>
                <p class="text-xs text-slate-400">Harap diperhatikan dan dipatuhi oleh seluruh anggota perpustakaan</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-xs text-slate-300">
            <div class="space-y-4">
                <div class="flex items-start gap-3">
                    <span class="w-6 h-6 rounded-full bg-brand-500/20 text-brand-300 flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">1</span>
                    <div>
                        <strong class="text-white block text-sm mb-0.5">Maksimal Durasi Peminjaman</strong>
                        Waktu pinjam setiap buku maksimal 1 (satu) minggu sejak tanggal pengajuan/pengambilan fisik.
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <span class="w-6 h-6 rounded-full bg-brand-500/20 text-brand-300 flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">2</span>
                    <div>
                        <strong class="text-white block text-sm mb-0.5">Batas Kuota Peminjaman</strong>
                        Setiap anggota mahasiswa hanya diperbolehkan meminjam maksimal 3 (tiga) buku secara bersamaan.
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex items-start gap-3">
                    <span class="w-6 h-6 rounded-full bg-rose-500/20 text-rose-300 flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">3</span>
                    <div>
                        <strong class="text-white block text-sm mb-0.5">Ketentuan Denda Keterlambatan</strong>
                        Keterlambatan pengembalian buku dikenakan denda administratif sebesar <strong>Rp 15.000 / buku / minggu</strong>.
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <span class="w-6 h-6 rounded-full bg-brand-500/20 text-brand-300 flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">4</span>
                    <div>
                        <strong class="text-white block text-sm mb-0.5">Verifikasi di Loket Petugas</strong>
                        Setelah mengajukan pinjam via web, silakan membawa kartu identitas mahasiswa ke loket perpustakaan.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
