@extends('layouts.master')

@section('sidebar')
    @include('part.sidebar')
@endsection

@section('topbar')
    @include('part.topbar')
@endsection

@section('judul')
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Daftar Kategori Buku</h1>
        <p class="text-sm text-slate-500 mt-0.5">Klasifikasi topik, genre fiksi/non-fiksi, dan materi studi perpustakaan.</p>
    </div>

    @if (Auth::user()->isAdmin == 1)
        <a href="/kategori/create" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold shadow-md shadow-brand-500/20 transition-all">
            <i class="fa-solid fa-plus-circle"></i>
            <span>Tambah Kategori</span>
        </a>
    @endif
@endsection

@section('content')
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden mb-8">
        <!-- Card Header with Search Input -->
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center text-sm font-bold">
                    <i class="fa-solid fa-tags"></i>
                </div>
                <div>
                    <h2 class="text-base font-bold text-slate-800">Semua Kategori</h2>
                    <p class="text-xs text-slate-400">Total: {{ count($kategori) }} Kategori Terdaftar</p>
                </div>
            </div>

            <!-- Client-side quick filter -->
            <div class="w-full sm:w-64">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    </span>
                    <input type="text" id="kategoriFilter" onkeyup="filterKategori()" 
                           placeholder="Filter kategori..." 
                           class="w-full pl-9 pr-4 py-2 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-brand-600 focus:ring-2 focus:ring-brand-500/20">
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse" id="kategoriTable">
                <thead>
                    <tr class="bg-slate-50/75 border-b border-slate-100 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-3.5 px-6" style="width: 8%;">No.</th>
                        <th class="py-3.5 px-6" style="width: 32%;">Nama Kategori</th>
                        <th class="py-3.5 px-6" style="width: 45%;">Deskripsi Singkat</th>
                        <th class="py-3.5 px-6 text-right" style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs text-slate-700">
                    @forelse ($kategori as $key => $item)
                        <tr class="hover:bg-slate-50/60 transition-colors kategori-row">
                            <td class="py-4 px-6 font-semibold text-slate-400">{{ $key + 1 }}</td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center text-xs shrink-0">
                                        <i class="fa-solid fa-bookmark"></i>
                                    </div>
                                    <a href="/kategori/{{ $item->id }}" class="font-bold text-slate-900 hover:text-brand-600 transition-colors kategori-name">
                                        {{ $item->nama }}
                                    </a>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-slate-500">
                                {{ $item->deskripsi ?? 'Tidak ada deskripsi' }}
                            </td>
                            <td class="py-4 px-6 text-right">
                                @if (Auth::user()->isAdmin == 1)
                                    <div class="inline-flex items-center gap-1.5">
                                        <a href="/kategori/{{ $item->id }}" class="p-2 w-8 h-8 rounded-lg border border-slate-200 hover:border-brand-500 hover:bg-brand-50 text-slate-600 hover:text-brand-700 flex items-center justify-center transition-all" title="Lihat Buku">
                                            <i class="fa-solid fa-eye text-xs"></i>
                                        </a>
                                        <a href="/kategori/{{ $item->id }}/edit" class="p-2 w-8 h-8 rounded-lg border border-slate-200 hover:border-amber-500 hover:bg-amber-50 text-slate-600 hover:text-amber-700 flex items-center justify-center transition-all" title="Edit">
                                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                                        </a>
                                        <button type="button" onclick="openDeleteCategoryModal('{{ $item->id }}', '{{ addslashes($item->nama) }}')" 
                                                class="p-2 w-8 h-8 rounded-lg border border-slate-200 hover:border-rose-500 hover:bg-rose-50 text-slate-600 hover:text-rose-700 flex items-center justify-center transition-all" title="Hapus">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </div>
                                @else
                                    <a href="/kategori/{{ $item->id }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border border-slate-200 hover:bg-slate-50 text-slate-700 font-semibold text-xs transition-all">
                                        <i class="fa-solid fa-eye text-brand-600"></i>
                                        <span>Lihat Koleksi</span>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center text-slate-400 text-xs">Belum ada kategori yang dibuat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Table Footer -->
        <div class="px-6 py-3.5 bg-slate-50/60 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
            <span>Menampilkan seluruh <strong class="text-slate-800">{{ $kategori->count() }}</strong> kategori terdaftar</span>
            <span class="text-slate-400">Total: {{ $kategori->count() }} entri</span>
        </div>
    </div>

    <!-- Delete Category Modal -->
    <div id="deleteCategoryModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm hidden opacity-0 transition-opacity duration-200">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-100 text-center transform scale-95 transition-transform duration-200" id="deleteCategoryModalContent">
            <div class="w-14 h-14 bg-rose-100 text-rose-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl">
                <i class="fa-solid fa-trash-can"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-900 mb-1">Konfirmasi Hapus Kategori</h3>
            <p class="text-sm text-slate-500 mb-6">Apakah Anda yakin ingin menghapus kategori <strong id="deleteCategoryName" class="text-slate-800"></strong>?</p>
            <div class="flex items-center justify-center gap-3">
                <button type="button" onclick="closeDeleteCategoryModal()" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-700 font-semibold text-sm hover:bg-slate-100 transition-colors">
                    Batal
                </button>
                <form id="deleteCategoryForm" method="POST" action="">
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
        function filterKategori() {
            const input = document.getElementById("kategoriFilter").value.toLowerCase();
            const rows = document.querySelectorAll(".kategori-row");
            rows.forEach(row => {
                const name = row.querySelector(".kategori-name").textContent.toLowerCase();
                if (name.includes(input)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }

        function openDeleteCategoryModal(categoryId, name) {
            const modal = document.getElementById('deleteCategoryModal');
            const content = document.getElementById('deleteCategoryModalContent');
            const nameEl = document.getElementById('deleteCategoryName');
            const form = document.getElementById('deleteCategoryForm');

            nameEl.textContent = `"${name}"`;
            form.action = `/kategori/${categoryId}`;

            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                content.classList.remove('scale-95');
                content.classList.add('scale-100');
            }, 10);
        }

        function closeDeleteCategoryModal() {
            const modal = document.getElementById('deleteCategoryModal');
            const content = document.getElementById('deleteCategoryModalContent');
            modal.classList.add('opacity-0');
            content.classList.remove('scale-100');
            content.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }
    </script>
@endsection
