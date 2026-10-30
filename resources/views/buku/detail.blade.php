@extends('layouts.master')

@section('sidebar')
    @include('part.sidebar')
@endsection

@section('topbar')
    @include('part.topbar')
@endsection

@section('judul')
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Detail Koleksi Buku</h1>
        <p class="text-sm text-slate-500 mt-0.5">Spesifikasi komprehensif, metadata, dan sinopsis buku.</p>
    </div>
    <a href="/buku" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold transition-all shadow-sm">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Kembali ke Katalog</span>
    </a>
@endsection

@section('content')
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-10 mb-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
            <!-- Book Cover Column -->
            <div class="lg:col-span-4 flex flex-col items-center">
                <div class="w-full max-w-xs relative rounded-2xl overflow-hidden shadow-2xl border border-slate-100 group">
                    <div class="pt-[135%] relative bg-slate-100">
                        <img src="{{ $buku->gambar_url }}" alt="{{ $buku->judul }}" 
                             class="absolute inset-0 w-full h-full object-cover">
                    </div>
                    <!-- Status Badge -->
                    <div class="absolute top-3 right-3">
                        @if(strtolower($buku->status ?? 'tersedia') == 'tersedia')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-500 text-white shadow-lg shadow-emerald-500/40">
                                <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                                Tersedia
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-rose-500 text-white shadow-lg shadow-rose-500/40">
                                <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                                Dipinjam
                            </span>
                        @endif
                    </div>
                </div>

                <div class="w-full max-w-xs mt-6 space-y-2">
                    @if (Auth::user()->isAdmin == 1)
                        <a href="/buku/{{ $buku->id }}/edit" class="w-full py-2.5 px-4 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-bold text-xs shadow-md shadow-amber-500/20 transition-all flex items-center justify-center gap-2">
                            <i class="fa-solid fa-pen-to-square"></i>
                            <span>Edit Data Buku</span>
                        </a>
                    @else
                        <a href="/peminjaman/create" class="w-full py-2.5 px-4 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-md shadow-brand-500/20 transition-all flex items-center justify-center gap-2">
                            <i class="fa-solid fa-cart-plus"></i>
                            <span>Ajukan Pinjam Buku</span>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Book Metadata Column -->
            <div class="lg:col-span-8 flex flex-col">
                <div class="flex flex-wrap items-center gap-2 mb-3">
                    <span class="px-3 py-1 rounded-lg bg-slate-900 text-white font-mono text-xs font-bold tracking-wider">
                        <i class="fa-solid fa-barcode mr-1 text-slate-400"></i> {{ $buku->kode_buku }}
                    </span>
                    @foreach ($buku->kategori_buku as $kategori)
                        <span class="px-3 py-1 rounded-lg bg-brand-50 text-brand-700 border border-brand-200 text-xs font-bold">
                            {{ $kategori->nama }}
                        </span>
                    @endforeach
                </div>

                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight leading-snug mb-6">
                    {{ $buku->judul }}
                </h1>

                <!-- Key Attributes Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-200/80 mb-6">
                    <div>
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block mb-0.5">Pengarang</span>
                        <p class="text-sm font-bold text-slate-800">{{ $buku->pengarang }}</p>
                    </div>
                    <div class="sm:border-l sm:border-slate-200 sm:pl-4">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block mb-0.5">Penerbit</span>
                        <p class="text-sm font-bold text-slate-800">{{ $buku->penerbit }}</p>
                    </div>
                    <div class="sm:border-l sm:border-slate-200 sm:pl-4">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block mb-0.5">Tahun Terbit</span>
                        <p class="text-sm font-bold text-slate-800">{{ $buku->tahun_terbit }}</p>
                    </div>
                </div>

                <!-- Synopsis -->
                <div class="space-y-2">
                    <h2 class="text-xs font-bold uppercase tracking-wider text-slate-400 flex items-center gap-2">
                        <i class="fa-solid fa-align-left text-brand-600"></i>
                        <span>Sinopsis &amp; Ringkasan Buku</span>
                    </h2>
                    <div class="text-sm text-slate-600 leading-relaxed text-justify whitespace-pre-line p-4 rounded-2xl bg-white border border-slate-100">
                        {{ $buku->deskripsi }}
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-100 mt-8 flex items-center justify-between">
                    <a href="/buku" class="text-xs font-bold text-slate-600 hover:text-slate-900 flex items-center gap-1.5">
                        <i class="fa-solid fa-arrow-left text-[10px]"></i>
                        <span>Kembali ke Koleksi</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
