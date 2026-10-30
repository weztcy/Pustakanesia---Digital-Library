@extends('layouts.master')

@section('sidebar')
    @include('part.sidebar')
@endsection

@section('topbar')
    @include('part.topbar')
@endsection

@section('judul')
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Kategori: {{ $kategori->nama }}</h1>
        <p class="text-sm text-slate-500 mt-0.5">Daftar semua koleksi buku yang terhubung dengan kategori ini.</p>
    </div>
    <a href="/kategori" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold transition-all shadow-sm">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Kembali ke Kategori</span>
    </a>
@endsection

@section('content')
    <!-- Category Hero Header Card -->
    <div class="bg-gradient-to-br from-brand-600 via-indigo-700 to-slate-900 rounded-3xl p-8 text-white shadow-xl mb-8 relative overflow-hidden">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 backdrop-blur-md border border-white/20 text-xs font-semibold text-brand-100 mb-4">
            <i class="fa-solid fa-folder-open text-amber-300"></i>
            <span>{{ $kategori->kategori_buku->count() }} Koleksi Buku</span>
        </div>
        <h1 class="text-3xl font-extrabold tracking-tight mb-2">{{ $kategori->nama }}</h1>
        <p class="text-slate-200 text-sm max-w-2xl leading-relaxed">
            {{ $kategori->deskripsi ?? 'Kumpulan karya literatur dan bahan bacaan dalam klasifikasi rumpun keilmuan ini.' }}
        </p>
    </div>

    <!-- Related Books Grid -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-base font-bold text-slate-800 flex items-center gap-2">
            <i class="fa-solid fa-book-bookmark text-brand-600"></i>
            <span>Buku Dalam Kategori Ini</span>
        </h2>
        <span class="text-xs text-slate-400 font-semibold">{{ $kategori->kategori_buku->count() }} Buku</span>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @forelse ($kategori->kategori_buku as $item)
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-brand-300 transition-all duration-300 flex flex-col overflow-hidden group">
                <div class="relative w-full pt-[130%] bg-slate-100 overflow-hidden">
                    <img src="{{ $item->gambar_url }}" alt="{{ $item->judul }}" 
                         class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    
                    <div class="absolute top-3 right-3 z-10">
                        @if(strtolower($item->status ?? 'tersedia') == 'tersedia')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-500 text-white shadow-md shadow-emerald-500/30">
                                <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                                Tersedia
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-rose-500 text-white shadow-md shadow-rose-500/30">
                                <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                                Dipinjam
                            </span>
                        @endif
                    </div>

                    <div class="absolute bottom-3 left-3 z-10">
                        <span class="px-2.5 py-1 rounded-lg bg-slate-900/80 backdrop-blur-md text-white font-mono text-[11px] font-bold tracking-wider">
                            {{ $item->kode_buku }}
                        </span>
                    </div>
                </div>

                <div class="p-5 flex-1 flex flex-col justify-between">
                    <div>
                        <div class="flex flex-wrap gap-1.5 mb-2.5">
                            <span class="px-2.5 py-0.5 rounded-md text-[11px] font-semibold bg-brand-50 text-brand-700 border border-brand-100">
                                {{ $kategori->nama }}
                            </span>
                        </div>

                        <h3 class="text-sm font-bold text-slate-900 line-clamp-2 leading-snug group-hover:text-brand-600 transition-colors mb-1.5" title="{{ $item->judul }}">
                            <a href="/buku/{{ $item->id }}">{{ $item->judul }}</a>
                        </h3>

                        <p class="text-xs text-slate-500 flex items-center gap-1.5 mb-4">
                            <i class="fa-solid fa-feather-pointed text-brand-500 text-[11px]"></i>
                            <span class="truncate">{{ $item->pengarang }}</span>
                        </p>
                    </div>

                    <div class="pt-4 border-t border-slate-100 mt-auto">
                        @if (Auth::user()->isAdmin == 1)
                            <div class="flex items-center gap-2">
                                <a href="/buku/{{ $item->id }}" class="flex-1 py-2 rounded-xl border border-slate-200 hover:border-brand-500 hover:bg-brand-50 hover:text-brand-700 text-slate-700 text-xs font-bold text-center transition-all">
                                    Detail
                                </a>
                                <a href="/buku/{{ $item->id }}/edit" class="p-2 w-9 h-9 rounded-xl border border-slate-200 hover:border-amber-500 hover:bg-amber-50 text-slate-700 hover:text-amber-700 flex items-center justify-center transition-all" title="Edit">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </a>
                            </div>
                        @else
                            <div class="flex items-center gap-2">
                                <a href="/buku/{{ $item->id }}" class="flex-1 py-2 rounded-xl border border-slate-200 hover:border-brand-500 hover:bg-brand-50 hover:text-brand-700 text-slate-700 text-xs font-bold text-center transition-all">
                                    Detail
                                </a>
                                <a href="/peminjaman/create" class="flex-1 py-2 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold text-center shadow-sm shadow-brand-500/20 transition-all">
                                    Pinjam
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-2xl p-12 text-center border border-slate-200/80 shadow-sm">
                <div class="w-16 h-16 rounded-full bg-brand-50 text-brand-600 flex items-center justify-center mx-auto mb-4 text-2xl">
                    <i class="fa-solid fa-book-open"></i>
                </div>
                <h3 class="text-base font-bold text-slate-900 mb-1">Belum Ada Buku Dalam Kategori Ini</h3>
                <p class="text-xs text-slate-500 mb-4">Koleksi untuk kategori "{{ $kategori->nama }}" belum ditambahkan ke perpustakaan.</p>
                @if (Auth::user()->isAdmin == 1)
                    <a href="/buku/create" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold shadow-md shadow-brand-500/20 transition-all">
                        <i class="fa-solid fa-plus-circle"></i>
                        <span>Tambah Buku ke Kategori Ini</span>
                    </a>
                @endif
            </div>
        @endforelse
    </div>
@endsection
