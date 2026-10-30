@extends('layouts.master')

@section('sidebar')
    @include('part.sidebar')
@endsection

@section('topbar')
    @include('part.topbar')
@endsection

@section('judul')
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Dashboard Administrator</h1>
        <p class="text-sm text-slate-500 mt-0.5">Ringkasan inventaris katalog, anggota, dan aktivitas sirkulasi buku perpustakaan.</p>
    </div>
    <div class="flex items-center gap-2">
        <a href="/peminjaman/create" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold shadow-md shadow-brand-500/20 transition-all">
            <i class="fa-solid fa-plus-circle"></i>
            <span>Transaksi Baru</span>
        </a>
        <a href="/cetaklaporan" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold transition-all shadow-sm">
            <i class="fa-solid fa-file-pdf text-rose-500"></i>
            <span>Cetak PDF</span>
        </a>
    </div>
@endsection

@section('content')
    <!-- 4 KPI Metrics Stat Cards with Tailwind -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <!-- Card 1: Buku -->
        <div class="bg-gradient-to-br from-brand-600 to-indigo-800 rounded-2xl p-6 text-white shadow-lg shadow-brand-600/20 relative overflow-hidden flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-bold uppercase tracking-wider text-brand-200">Total Koleksi Buku</span>
                <div class="w-10 h-10 rounded-xl bg-white/15 backdrop-blur-md flex items-center justify-center text-lg">
                    <i class="fa-solid fa-book-bookmark"></i>
                </div>
            </div>
            <div>
                <span class="text-3xl font-extrabold tracking-tight">{{ $buku }}</span>
                <span class="text-xs text-brand-200 ml-1">Judul</span>
            </div>
            <div class="mt-4 pt-3 border-t border-white/10">
                <a href="/buku" class="text-xs font-semibold text-brand-100 hover:text-white flex items-center gap-1.5 group">
                    <span>Lihat Semua Katalog</span>
                    <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>

        <!-- Card 2: Kategori -->
        <div class="bg-gradient-to-br from-cyan-600 to-sky-800 rounded-2xl p-6 text-white shadow-lg shadow-cyan-600/20 relative overflow-hidden flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-bold uppercase tracking-wider text-cyan-200">Kategori Buku</span>
                <div class="w-10 h-10 rounded-xl bg-white/15 backdrop-blur-md flex items-center justify-center text-lg">
                    <i class="fa-solid fa-tags"></i>
                </div>
            </div>
            <div>
                <span class="text-3xl font-extrabold tracking-tight">{{ $kategori }}</span>
                <span class="text-xs text-cyan-200 ml-1">Kategori</span>
            </div>
            <div class="mt-4 pt-3 border-t border-white/10">
                <a href="/kategori" class="text-xs font-semibold text-cyan-100 hover:text-white flex items-center gap-1.5 group">
                    <span>Kelola Kategori</span>
                    <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>

        <!-- Card 3: Anggota -->
        <div class="bg-gradient-to-br from-emerald-600 to-teal-800 rounded-2xl p-6 text-white shadow-lg shadow-emerald-600/20 relative overflow-hidden flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-200">Anggota Terdaftar</span>
                <div class="w-10 h-10 rounded-xl bg-white/15 backdrop-blur-md flex items-center justify-center text-lg">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
            <div>
                <span class="text-3xl font-extrabold tracking-tight">{{ $user }}</span>
                <span class="text-xs text-emerald-200 ml-1">Mahasiswa</span>
            </div>
            <div class="mt-4 pt-3 border-t border-white/10">
                <a href="/anggota" class="text-xs font-semibold text-emerald-100 hover:text-white flex items-center gap-1.5 group">
                    <span>Data Anggota</span>
                    <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>

        <!-- Card 4: Riwayat -->
        <div class="bg-gradient-to-br from-rose-600 to-pink-800 rounded-2xl p-6 text-white shadow-lg shadow-rose-600/20 relative overflow-hidden flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-bold uppercase tracking-wider text-rose-200">Sirkulasi Pinjam</span>
                <div class="w-10 h-10 rounded-xl bg-white/15 backdrop-blur-md flex items-center justify-center text-lg">
                    <i class="fa-solid fa-handshake"></i>
                </div>
            </div>
            <div>
                <span class="text-3xl font-extrabold tracking-tight">{{ $jumlah_riwayat }}</span>
                <span class="text-xs text-rose-200 ml-1">Transaksi</span>
            </div>
            <div class="mt-4 pt-3 border-t border-white/10">
                <a href="/peminjaman" class="text-xs font-semibold text-rose-100 hover:text-white flex items-center gap-1.5 group">
                    <span>Lihat Riwayat</span>
                    <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Action / Shortcut Banner -->
    <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm mb-8 flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-wand-magic-sparkles"></i>
            </div>
            <div>
                <h2 class="text-base font-bold text-slate-800">Aksi Cepat Sirkulasi Perpustakaan</h2>
                <p class="text-xs text-slate-500 mt-0.5">Kelola penambahan koleksi buku baru, kategori, atau catat pengembalian buku peminjam.</p>
            </div>
        </div>
        <div class="flex items-center gap-2.5 w-full md:w-auto">
            <a href="/buku/create" class="flex-1 md:flex-initial inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold shadow-sm transition-all">
                <i class="fa-solid fa-book-medical"></i>
                <span>Tambah Buku</span>
            </a>
            <a href="/pengembalian" class="flex-1 md:flex-initial inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-rose-200 bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-semibold transition-all">
                <i class="fa-solid fa-rotate-left"></i>
                <span>Pengembalian</span>
            </a>
        </div>
    </div>

    <!-- Recent Transactions Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden mb-8">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center text-sm">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
                <div>
                    <h2 class="text-base font-bold text-slate-800">Sirkulasi Peminjaman Terbaru</h2>
                    <p class="text-xs text-slate-500">Daftar transaksi peminjaman buku terkini</p>
                </div>
            </div>
            <a href="/peminjaman" class="text-xs font-bold text-brand-600 hover:text-brand-700 flex items-center gap-1">
                <span>Lihat Semua</span>
                <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/75 border-b border-slate-100 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-3.5 px-6 whitespace-nowrap">No.</th>
                        <th class="py-3.5 px-6 whitespace-nowrap">Nama Peminjam</th>
                        <th class="py-3.5 px-6">Buku</th>
                        <th class="py-3.5 px-6 whitespace-nowrap">Kode</th>
                        <th class="py-3.5 px-6 whitespace-nowrap">Tgl Pinjam</th>
                        <th class="py-3.5 px-6 whitespace-nowrap">Jatuh Tempo</th>
                        <th class="py-3.5 px-6 whitespace-nowrap">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs text-slate-700">
                    @forelse ($riwayat_pinjam->take(5) as $item)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-4 px-6 font-semibold text-slate-400 whitespace-nowrap">{{ $loop->iteration }}</td>
                            <td class="py-4 px-6 font-bold text-slate-900 whitespace-nowrap">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-7 h-7 rounded-full bg-brand-100 text-brand-700 font-bold flex items-center justify-center text-xs shrink-0">
                                        {{ strtoupper(substr($item->user ? $item->user->name : 'U', 0, 1)) }}
                                    </div>
                                    <span>{{ $item->user ? $item->user->name : '-' }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 font-medium text-slate-800">{{ $item->buku ? $item->buku->judul : '-' }}</td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                <span class="inline-block whitespace-nowrap px-2.5 py-1 rounded-md bg-slate-100 border border-slate-200 font-mono text-[11px] text-slate-700 font-bold">
                                    {{ $item->buku ? $item->buku->kode_buku : '-' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-slate-500 whitespace-nowrap">{{ $item->tanggal_pinjam }}</td>
                            <td class="py-4 px-6 font-bold text-rose-600 whitespace-nowrap">{{ $item->tanggal_wajib_kembali }}</td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                @if ($item->tanggal_pengembalian != null)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 whitespace-nowrap">
                                        <i class="fa-solid fa-circle-check text-[10px]"></i>
                                        Kembali ({{ $item->tanggal_pengembalian }})
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200 whitespace-nowrap">
                                        <i class="fa-solid fa-hourglass-half text-[10px]"></i>
                                        Sedang Dipinjam
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-slate-400 text-xs">Belum ada data sirkulasi peminjaman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
