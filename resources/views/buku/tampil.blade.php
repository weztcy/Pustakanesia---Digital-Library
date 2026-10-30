@extends('layouts.master')

@section('sidebar')
    @include('part.sidebar')
@endsection

@section('topbar')
    @include('part.topbar')
@endsection

@section('judul')
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Katalog Koleksi Buku</h1>
        <p class="text-sm text-slate-500 mt-0.5">Jelajahi buku pelajaran, novel sastra, sains, dan buku teknologi terpopuler.</p>
    </div>

    @if (Auth::user()->isAdmin == 1)
        <a href="/buku/create" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold shadow-md shadow-brand-500/20 transition-all">
            <i class="fa-solid fa-plus-circle"></i>
            <span>Tambah Buku Baru</span>
        </a>
    @endif
@endsection

@section('content')
    <!-- Search Bar Card -->
    <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-sm mb-8">
        <form action="/buku" method="GET" class="flex flex-col sm:flex-row items-center gap-3">
            <div class="relative flex-1 w-full">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                    <i class="fa-solid fa-magnifying-glass text-sm"></i>
                </span>
                <input type="search" name="search" value="{{ request('search') }}"
                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all"
                       placeholder="Cari berdasarkan judul buku atau pengarang...">
            </div>
            <div class="flex items-center gap-2 w-full sm:w-auto">
                @if(request('search'))
                    <a href="/buku" class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 text-xs font-bold transition-all">
                        Reset
                    </a>
                @endif
                <button type="submit" class="flex-1 sm:flex-initial px-6 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold shadow-sm transition-all flex items-center justify-center gap-2">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span>Cari Buku</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Books Card Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @forelse ($buku as $item)
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-brand-300 transition-all duration-300 flex flex-col overflow-hidden group">
                <!-- Book Cover Wrap (3:4 aspect ratio) -->
                <div class="relative w-full pt-[130%] bg-slate-100 overflow-hidden">
                    <img src="{{ $item->gambar_url }}" alt="{{ $item->judul }}" 
                         class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    
                    <!-- Status Badge -->
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

                    <!-- Book Code Badge -->
                    <div class="absolute bottom-3 left-3 z-10">
                        <span class="px-2.5 py-1 rounded-lg bg-slate-900/80 backdrop-blur-md text-white font-mono text-[11px] font-bold tracking-wider">
                            {{ $item->kode_buku }}
                        </span>
                    </div>
                </div>

                <!-- Book Body Info -->
                <div class="p-5 flex-1 flex flex-col justify-between">
                    <div>
                        <!-- Category Tags -->
                        <div class="flex flex-wrap gap-1.5 mb-2.5">
                            @forelse ($item->kategori_buku as $kategori)
                                <span class="px-2.5 py-0.5 rounded-md text-[11px] font-semibold bg-brand-50 text-brand-700 border border-brand-100">
                                    {{ $kategori->nama }}
                                </span>
                            @empty
                                <span class="text-[11px] text-slate-400">Umum</span>
                            @endforelse
                        </div>

                        <!-- Title -->
                        <h3 class="text-sm font-bold text-slate-900 line-clamp-2 leading-snug group-hover:text-brand-600 transition-colors mb-1.5" title="{{ $item->judul }}">
                            <a href="/buku/{{ $item->id }}">{{ $item->judul }}</a>
                        </h3>

                        <!-- Author -->
                        <p class="text-xs text-slate-500 flex items-center gap-1.5 mb-4">
                            <i class="fa-solid fa-feather-pointed text-brand-500 text-[11px]"></i>
                            <span class="truncate">{{ $item->pengarang }}</span>
                        </p>
                    </div>

                    <!-- Actions -->
                    <div class="pt-4 border-t border-slate-100 mt-auto">
                        @if (Auth::user()->isAdmin == 1)
                            <div class="flex items-center gap-2">
                                <a href="/buku/{{ $item->id }}" class="flex-1 py-2 rounded-xl border border-slate-200 hover:border-brand-500 hover:bg-brand-50 hover:text-brand-700 text-slate-700 text-xs font-bold text-center transition-all">
                                    Detail
                                </a>
                                <a href="/buku/{{ $item->id }}/edit" class="p-2 w-9 h-9 rounded-xl border border-slate-200 hover:border-amber-500 hover:bg-amber-50 text-slate-700 hover:text-amber-700 flex items-center justify-center transition-all" title="Edit">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </a>
                                <button type="button" onclick="openDeleteModal('{{ $item->id }}', '{{ addslashes($item->judul) }}')" 
                                        class="p-2 w-9 h-9 rounded-xl border border-slate-200 hover:border-rose-500 hover:bg-rose-50 text-slate-700 hover:text-rose-700 flex items-center justify-center transition-all" title="Hapus">
                                    <i class="fa-solid fa-trash text-xs"></i>
                                </button>
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
                <h3 class="text-base font-bold text-slate-900 mb-1">Tidak Ada Koleksi Buku Ditemukan</h3>
                <p class="text-xs text-slate-500 mb-4">Coba sesuaikan kata kunci pencarian Anda untuk menemukan judul yang dicari.</p>
                @if(request('search'))
                    <a href="/buku" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition-all">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span>Tampilkan Semua Koleksi</span>
                    </a>
                @endif
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $buku->links() }}
    </div>

    <!-- Delete Modal with Tailwind -->
    <div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm hidden opacity-0 transition-opacity duration-200">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-100 text-center transform scale-95 transition-transform duration-200" id="deleteModalContent">
            <div class="w-14 h-14 bg-rose-100 text-rose-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl">
                <i class="fa-solid fa-trash-can"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-900 mb-1">Konfirmasi Hapus Buku</h3>
            <p class="text-sm text-slate-500 mb-6">Apakah Anda yakin ingin menghapus buku <strong id="deleteBookTitle" class="text-slate-800"></strong> dari sistem perpustakaan?</p>
            <div class="flex items-center justify-center gap-3">
                <button type="button" onclick="closeDeleteModal()" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-700 font-semibold text-sm hover:bg-slate-100 transition-colors">
                    Batal
                </button>
                <form id="deleteBookForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-rose-600 text-white font-semibold text-sm hover:bg-rose-700 shadow-sm shadow-rose-200 transition-all">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(bookId, title) {
            const modal = document.getElementById('deleteModal');
            const content = document.getElementById('deleteModalContent');
            const titleEl = document.getElementById('deleteBookTitle');
            const form = document.getElementById('deleteBookForm');

            titleEl.textContent = `"${title}"`;
            form.action = `/buku/${bookId}`;

            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                content.classList.remove('scale-95');
                content.classList.add('scale-100');
            }, 10);
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            const content = document.getElementById('deleteModalContent');
            modal.classList.add('opacity-0');
            content.classList.remove('scale-100');
            content.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }
    </script>
@endsection
