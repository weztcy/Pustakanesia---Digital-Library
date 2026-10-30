@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Navigasi Halaman" class="bg-white rounded-2xl px-5 py-3.5 border border-slate-200/80 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4">
        {{-- Info Count --}}
        <div class="text-xs text-slate-500 text-center sm:text-left">
            Menampilkan 
            <span class="font-bold text-slate-800">{{ $paginator->firstItem() ?? 0 }}</span>
            sampai 
            <span class="font-bold text-slate-800">{{ $paginator->lastItem() ?? 0 }}</span>
            dari total 
            <span class="font-bold text-slate-800">{{ $paginator->total() }}</span>
            data
        </div>

        {{-- Mobile Controls (Simple) --}}
        <div class="flex items-center justify-between w-full sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="px-3.5 py-2 rounded-xl border border-slate-200/60 bg-slate-50 text-slate-300 font-semibold text-xs cursor-not-allowed flex items-center gap-1.5">
                    <i class="fa-solid fa-chevron-left text-[10px]"></i>
                    <span>Sebelumnya</span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-3.5 py-2 rounded-xl border border-slate-200 bg-white hover:bg-brand-50 hover:border-brand-300 text-slate-700 hover:text-brand-600 font-semibold text-xs transition-all shadow-sm flex items-center gap-1.5">
                    <i class="fa-solid fa-chevron-left text-[10px]"></i>
                    <span>Sebelumnya</span>
                </a>
            @endif

            <span class="text-xs font-bold text-slate-700">
                Halaman {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
            </span>

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-3.5 py-2 rounded-xl border border-slate-200 bg-white hover:bg-brand-50 hover:border-brand-300 text-slate-700 hover:text-brand-600 font-semibold text-xs transition-all shadow-sm flex items-center gap-1.5">
                    <span>Berikutnya</span>
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </a>
            @else
                <span class="px-3.5 py-2 rounded-xl border border-slate-200/60 bg-slate-50 text-slate-300 font-semibold text-xs cursor-not-allowed flex items-center gap-1.5">
                    <span>Berikutnya</span>
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </span>
            @endif
        </div>

        {{-- Desktop Controls --}}
        <div class="hidden sm:flex items-center gap-1.5">
            {{-- Tombol Sebelumnya --}}
            @if ($paginator->onFirstPage())
                <span class="px-3 py-1.5 rounded-xl border border-slate-200/60 bg-slate-50 text-slate-300 font-semibold text-xs cursor-not-allowed flex items-center gap-1.5 mr-1" aria-disabled="true">
                    <i class="fa-solid fa-chevron-left text-[10px]"></i>
                    <span>Sebelumnya</span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-3 py-1.5 rounded-xl border border-slate-200 bg-white hover:bg-brand-50 hover:border-brand-300 text-slate-700 hover:text-brand-600 font-semibold text-xs transition-all shadow-sm flex items-center gap-1.5 mr-1">
                    <i class="fa-solid fa-chevron-left text-[10px]"></i>
                    <span>Sebelumnya</span>
                </a>
            @endif

            {{-- Angka Halaman --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="w-8 h-8 flex items-center justify-center text-xs text-slate-400 font-bold" aria-disabled="true">
                        {{ $element }}
                    </span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="w-8 h-8 rounded-xl bg-brand-600 text-white font-bold text-xs flex items-center justify-center shadow-md shadow-brand-500/25" aria-current="page">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="w-8 h-8 rounded-xl border border-slate-200 bg-white hover:bg-slate-100 hover:border-brand-300 text-slate-700 hover:text-brand-600 font-semibold text-xs flex items-center justify-center transition-all shadow-sm">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Tombol Berikutnya --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-3 py-1.5 rounded-xl border border-slate-200 bg-white hover:bg-brand-50 hover:border-brand-300 text-slate-700 hover:text-brand-600 font-semibold text-xs transition-all shadow-sm flex items-center gap-1.5 ml-1">
                    <span>Berikutnya</span>
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </a>
            @else
                <span class="px-3 py-1.5 rounded-xl border border-slate-200/60 bg-slate-50 text-slate-300 font-semibold text-xs cursor-not-allowed flex items-center gap-1.5 ml-1" aria-disabled="true">
                    <span>Berikutnya</span>
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </span>
            @endif
        </div>
    </nav>
@endif
