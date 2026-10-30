@extends('layouts.master')

@section('sidebar')
    @include('part.sidebar')
@endsection

@section('topbar')
    @include('part.topbar')
@endsection

@section('judul')
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">
            @if (Auth::user()->isAdmin == 1)
                Sirkulasi &amp; Riwayat Peminjaman
            @else
                Riwayat Peminjaman Buku Saya
            @endif
        </h1>
        <p class="text-sm text-slate-500 mt-0.5">Pantau status transaksi peminjaman aktif dan arsip pengembalian buku.</p>
    </div>

    <div class="flex items-center gap-2">
        @if (Auth::user()->isAdmin == 1)
            <a href="/peminjaman/create" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold shadow-md shadow-brand-500/20 transition-all">
                <i class="fa-solid fa-plus-circle"></i>
                <span>Transaksi Baru</span>
            </a>
            <a href="/cetaklaporan" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold transition-all shadow-sm">
                <i class="fa-solid fa-file-pdf text-rose-500"></i>
                <span>Cetak PDF</span>
            </a>
            <a href="/pengembalian" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-rose-200 bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-bold transition-all">
                <i class="fa-solid fa-rotate-left"></i>
                <span>Pengembalian</span>
            </a>
        @else
            <a href="/peminjaman/create" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold shadow-md shadow-brand-500/20 transition-all">
                <i class="fa-solid fa-cart-plus"></i>
                <span>Ajukan Peminjaman</span>
            </a>
        @endif
    </div>
@endsection

@section('content')
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden mb-8">
        <!-- Header & Filter -->
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center text-sm font-bold">
                    <i class="fa-solid fa-handshake"></i>
                </div>
                <div>
                    <h2 class="text-base font-bold text-slate-800">Daftar Transaksi Peminjaman</h2>
                    <p class="text-xs text-slate-400">
                        @if (Auth::user()->isAdmin == 1)
                            Total: {{ count($peminjam) }} Data Tercatat
                        @else
                            Total: {{ count($pinjamanUser) }} Peminjaman Saya
                        @endif
                    </p>
                </div>
            </div>

            <div class="w-full sm:w-64">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    </span>
                    <input type="text" id="loanFilter" onkeyup="filterLoans()" 
                           placeholder="Filter peminjam atau buku..." 
                           class="w-full pl-9 pr-4 py-2 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-brand-600 focus:ring-2 focus:ring-brand-500/20">
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse" id="loanTable">
                <thead>
                    <tr class="bg-slate-50/75 border-b border-slate-100 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-3.5 px-6 whitespace-nowrap" style="width: 5%;">No.</th>
                        @if (Auth::user()->isAdmin == 1)
                            <th class="py-3.5 px-6 whitespace-nowrap" style="width: 20%;">Peminjam</th>
                        @endif
                        <th class="py-3.5 px-6" style="width: 25%;">Judul Buku</th>
                        <th class="py-3.5 px-6 whitespace-nowrap" style="width: 12%;">Kode</th>
                        <th class="py-3.5 px-6 whitespace-nowrap" style="width: 12%;">Tgl Pinjam</th>
                        <th class="py-3.5 px-6 whitespace-nowrap" style="width: 12%;">Jatuh Tempo</th>
                        <th class="py-3.5 px-6 whitespace-nowrap" style="width: 14%;">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs text-slate-700">
                    @php
                        $listData = (Auth::user()->isAdmin == 1) ? $peminjam : $pinjamanUser;
                    @endphp

                    @forelse ($listData as $item)
                        <tr class="hover:bg-slate-50/60 transition-colors loan-row">
                            <td class="py-4 px-6 font-semibold text-slate-400 whitespace-nowrap">{{ $loop->iteration }}</td>
                            @if (Auth::user()->isAdmin == 1)
                                <td class="py-4 px-6 font-bold text-slate-900 loan-user whitespace-nowrap">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-7 h-7 rounded-full bg-brand-100 text-brand-700 font-bold flex items-center justify-center text-xs shrink-0">
                                            {{ strtoupper(substr($item->user ? $item->user->name : 'U', 0, 1)) }}
                                        </div>
                                        <span>{{ $item->user ? $item->user->name : '-' }}</span>
                                    </div>
                                </td>
                            @endif
                            <td class="py-4 px-6 font-medium text-slate-800 loan-book">
                                {{ $item->buku ? $item->buku->judul : '-' }}
                            </td>
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
                            <td colspan="{{ Auth::user()->isAdmin == 1 ? '7' : '6' }}" class="py-8 text-center text-slate-400 text-xs">
                                Belum ada data transaksi peminjaman buku.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Table Footer -->
        <div class="px-6 py-3.5 bg-slate-50/60 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
            <span>Menampilkan seluruh <strong class="text-slate-800">{{ $listData->count() }}</strong> transaksi peminjaman</span>
            <span class="text-slate-400">Total: {{ $listData->count() }} entri</span>
        </div>
    </div>

    <script>
        function filterLoans() {
            const input = document.getElementById("loanFilter").value.toLowerCase();
            const rows = document.querySelectorAll(".loan-row");
            rows.forEach(row => {
                const book = row.querySelector(".loan-book") ? row.querySelector(".loan-book").textContent.toLowerCase() : "";
                const user = row.querySelector(".loan-user") ? row.querySelector(".loan-user").textContent.toLowerCase() : "";
                if (book.includes(input) || user.includes(input)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }
    </script>
@endsection
