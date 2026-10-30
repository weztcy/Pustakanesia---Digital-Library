@extends('layouts.master')

@section('sidebar')
    @include('part.sidebar')
@endsection

@section('topbar')
    @include('part.topbar')
@endsection

@section('judul')
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Tambah Buku Baru</h1>
        <p class="text-sm text-slate-500 mt-0.5">Lengkapi formulir untuk menambahkan judul koleksi baru ke sistem.</p>
    </div>
    <a href="/buku" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold transition-all shadow-sm">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Kembali ke Katalog</span>
    </a>
@endsection

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-10 mb-8">
            <form action="/buku" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Row 1: Judul & Kode Buku -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    <div class="sm:col-span-2">
                        <label for="judul" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Judul Lengkap Buku <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="judul" name="judul" value="{{ old('judul') }}" required
                               class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('judul') ? 'border-rose-400 ring-rose-200 ring-2' : 'border-slate-300' }} focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all"
                               placeholder="Contoh: Laskar Pelangi">
                        @error('judul')
                            <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="kode_buku" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Kode Buku <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="kode_buku" name="kode_buku" value="{{ old('kode_buku') }}" required
                               class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('kode_buku') ? 'border-rose-400 ring-rose-200 ring-2' : 'border-slate-300' }} focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm font-mono transition-all"
                               placeholder="NVL-001">
                        @error('kode_buku')
                            <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Row 2: Kategori & Pengarang -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="multiselect" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Kategori Buku <span class="text-rose-500">*</span>
                        </label>
                        <select class="w-full" name="kategori_buku[]" id="multiselect" multiple="multiple" required>
                            @forelse ($kategori as $item)
                                <option value="{{ $item->id }}" {{ (is_array(old('kategori_buku')) && in_array($item->id, old('kategori_buku'))) ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @empty
                                <option disabled>Belum ada kategori</option>
                            @endforelse
                        </select>
                        @error('kategori_buku')
                            <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="pengarang" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Pengarang / Penulis <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="pengarang" name="pengarang" value="{{ old('pengarang') }}" required
                               class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('pengarang') ? 'border-rose-400 ring-rose-200 ring-2' : 'border-slate-300' }} focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all"
                               placeholder="Nama pengarang">
                        @error('pengarang')
                            <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Row 3: Penerbit & Tahun Terbit -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="penerbit" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Penerbit <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="penerbit" name="penerbit" value="{{ old('penerbit') }}" required
                               class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('penerbit') ? 'border-rose-400 ring-rose-200 ring-2' : 'border-slate-300' }} focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all"
                               placeholder="Nama penerbit">
                        @error('penerbit')
                            <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tahun_terbit" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Tahun Terbit <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit') }}" required
                               class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('tahun_terbit') ? 'border-rose-400 ring-rose-200 ring-2' : 'border-slate-300' }} focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all"
                               placeholder="Contoh: 2023">
                        @error('tahun_terbit')
                            <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Sinopsis / Deskripsi Buku <span class="text-rose-500">*</span>
                    </label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" required
                              class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('deskripsi') ? 'border-rose-400 ring-rose-200 ring-2' : 'border-slate-300' }} focus:outline-none focus:border-brand-600 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all"
                              placeholder="Sinopsis cerita atau ulasan topik buku...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Upload Cover -->
                <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        <i class="fa-solid fa-image text-brand-600 mr-1"></i> Upload Sampul Cover Buku
                    </label>
                    <input type="file" name="gambar" id="gambar" accept="image/*"
                           class="block w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 transition-all cursor-pointer">
                    <p class="text-[11px] text-slate-400 mt-2">Mendukung format JPG, JPEG, PNG (Maksimal 2MB). Disarankan rasio 3:4.</p>
                    @error('gambar')
                        <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                    @enderror

                    <div id="coverPreviewWrap" class="mt-4 hidden">
                        <span class="text-xs text-slate-500 block mb-1 font-semibold">Preview Sampul:</span>
                        <img id="previewCover" src="#" alt="Preview" class="w-24 h-32 object-cover rounded-xl shadow-md border border-slate-200">
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                    <a href="/buku" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-700 font-semibold text-sm hover:bg-slate-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-sm shadow-md shadow-brand-500/20 transition-all flex items-center gap-2">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <span>Simpan Koleksi Buku</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#multiselect').select2({
                placeholder: "Pilih kategori...",
                allowClear: true,
                width: '100%'
            });

            $('#gambar').on('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(ev) {
                        $('#previewCover').attr('src', ev.target.result);
                        $('#coverPreviewWrap').removeClass('hidden');
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
