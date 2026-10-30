<aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-72 bg-slate-900 border-r border-slate-800 flex flex-col transition-transform duration-300 transform -translate-x-full lg:translate-x-0 lg:static lg:inset-auto">
    <!-- Brand Header -->
    <div class="h-20 flex items-center px-6 border-b border-slate-800/80 bg-slate-950/40">
        <a href="/home" class="flex items-center gap-3 group">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-brand-600 to-indigo-400 flex items-center justify-center shadow-lg shadow-brand-500/30 group-hover:scale-105 transition-transform">
                <img src="{{ asset('/img/logoPustaka2.png') }}" alt="Logo" class="w-6 h-6 object-contain brightness-0 invert">
            </div>
            <div class="flex flex-col">
                <span class="text-lg font-extrabold text-white tracking-tight">Pustakanesia</span>
                <span class="text-xs font-semibold text-brand-400 tracking-wider uppercase">Digital Library</span>
            </div>
        </a>
    </div>

    <!-- Navigation List -->
    <div class="flex-1 overflow-y-auto px-4 py-6 space-y-6">
        <!-- Main Section -->
        <div>
            <p class="px-3 text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Menu Utama</p>
            <a href="/home" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all {{ Request::is('home') ? 'bg-brand-600 text-white shadow-md shadow-brand-600/30 font-semibold' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                <i class="fa-solid fa-chart-pie w-5 text-center text-base {{ Request::is('home') ? 'text-white' : 'text-slate-400' }}"></i>
                <span>Dashboard</span>
            </a>
        </div>

        <!-- Catalog Section -->
        <div>
            <p class="px-3 text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Katalog &amp; Koleksi</p>
            <div class="space-y-1">
                <a href="/buku" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all {{ Request::is('buku') ? 'bg-brand-600 text-white shadow-md shadow-brand-600/30 font-semibold' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                    <i class="fa-solid fa-book-open w-5 text-center text-base {{ Request::is('buku') ? 'text-white' : 'text-slate-400' }}"></i>
                    <span>Semua Buku</span>
                </a>
                @if (Auth::user()->isAdmin == 1)
                    <a href="/buku/create" class="flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium text-sm transition-all {{ Request::is('buku/create') ? 'bg-brand-600/20 text-brand-300 font-semibold' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/40' }} pl-11">
                        <i class="fa-solid fa-plus text-xs"></i>
                        <span>Tambah Buku</span>
                    </a>
                @endif

                <a href="/kategori" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all {{ Request::is('kategori') ? 'bg-brand-600 text-white shadow-md shadow-brand-600/30 font-semibold' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                    <i class="fa-solid fa-tags w-5 text-center text-base {{ Request::is('kategori') ? 'text-white' : 'text-slate-400' }}"></i>
                    <span>Kategori</span>
                </a>
                @if (Auth::user()->isAdmin == 1)
                    <a href="/kategori/create" class="flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium text-sm transition-all {{ Request::is('kategori/create') ? 'bg-brand-600/20 text-brand-300 font-semibold' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/40' }} pl-11">
                        <i class="fa-solid fa-plus text-xs"></i>
                        <span>Tambah Kategori</span>
                    </a>
                @endif
            </div>
        </div>

        @if (Auth::user()->isAdmin == 1)
            <!-- Member Management -->
            <div>
                <p class="px-3 text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Manajemen Anggota</p>
                <div class="space-y-1">
                    <a href="/anggota" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all {{ Request::is('anggota') ? 'bg-brand-600 text-white shadow-md shadow-brand-600/30 font-semibold' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                        <i class="fa-solid fa-users w-5 text-center text-base {{ Request::is('anggota') ? 'text-white' : 'text-slate-400' }}"></i>
                        <span>Data Anggota</span>
                    </a>
                    <a href="/anggota/create" class="flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium text-sm transition-all {{ Request::is('anggota/create') ? 'bg-brand-600/20 text-brand-300 font-semibold' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/40' }} pl-11">
                        <i class="fa-solid fa-user-plus text-xs"></i>
                        <span>Registrasi Anggota</span>
                    </a>
                </div>
            </div>
        @endif

        <!-- Circulation Section -->
        <div>
            <p class="px-3 text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Sirkulasi &amp; Layanan</p>
            <div class="space-y-1">
                @if (Auth::user()->isAdmin == 1)
                    <a href="/peminjaman" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all {{ Request::is('peminjaman') ? 'bg-brand-600 text-white shadow-md shadow-brand-600/30 font-semibold' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                        <i class="fa-solid fa-clock-rotate-left w-5 text-center text-base {{ Request::is('peminjaman') ? 'text-white' : 'text-slate-400' }}"></i>
                        <span>Riwayat Pinjam</span>
                    </a>
                    <a href="/peminjaman/create" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all {{ Request::is('peminjaman/create') ? 'bg-brand-600 text-white shadow-md shadow-brand-600/30 font-semibold' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                        <i class="fa-solid fa-circle-plus w-5 text-center text-base {{ Request::is('peminjaman/create') ? 'text-white' : 'text-slate-400' }}"></i>
                        <span>Tambah Pinjaman</span>
                    </a>
                    <a href="/pengembalian" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all {{ Request::is('pengembalian*') ? 'bg-brand-600 text-white shadow-md shadow-brand-600/30 font-semibold' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                        <i class="fa-solid fa-rotate-left w-5 text-center text-base {{ Request::is('pengembalian*') ? 'text-white' : 'text-slate-400' }}"></i>
                        <span>Pengembalian Buku</span>
                    </a>
                @else
                    <a href="/peminjaman" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all {{ Request::is('peminjaman') ? 'bg-brand-600 text-white shadow-md shadow-brand-600/30 font-semibold' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                        <i class="fa-solid fa-book-bookmark w-5 text-center text-base {{ Request::is('peminjaman') ? 'text-white' : 'text-slate-400' }}"></i>
                        <span>Pinjaman Saya</span>
                    </a>
                    <a href="/peminjaman/create" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all {{ Request::is('peminjaman/create') ? 'bg-brand-600 text-white shadow-md shadow-brand-600/30 font-semibold' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                        <i class="fa-solid fa-hand-holding-hand w-5 text-center text-base {{ Request::is('peminjaman/create') ? 'text-white' : 'text-slate-400' }}"></i>
                        <span>Ajukan Pinjam</span>
                    </a>
                @endif
            </div>
        </div>

        <!-- Account Section -->
        <div>
            <p class="px-3 text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Akun Saya</p>
            <a href="/profile" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all {{ Request::is('profile*') ? 'bg-brand-600 text-white shadow-md shadow-brand-600/30 font-semibold' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                <i class="fa-solid fa-user-gear w-5 text-center text-base {{ Request::is('profile*') ? 'text-white' : 'text-slate-400' }}"></i>
                <span>Profil Akun</span>
            </a>
        </div>
    </div>

    <!-- Sidebar Bottom Profile Footer -->
    <div class="p-4 border-t border-slate-800/80 bg-slate-950/40">
        <div class="flex items-center gap-3">
            <img src="{{ $profile ? $profile->photo_profile_url : asset('images/photoProfile/boy.png') }}" 
                 alt="{{ Auth::user()->name }}" 
                 class="w-10 h-10 rounded-full object-cover ring-2 ring-brand-500/40">
            <div class="flex-1 min-w-0">
                <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name }}</p>
                <span class="inline-block px-2 py-0.5 text-[11px] font-semibold rounded-md {{ Auth::user()->isAdmin == 1 ? 'bg-brand-500/20 text-brand-300' : 'bg-emerald-500/20 text-emerald-300' }}">
                    {{ Auth::user()->isAdmin == 1 ? 'Administrator' : 'Anggota' }}
                </span>
            </div>
        </div>
    </div>
</aside>
