<header class="h-20 bg-white border-b border-slate-200 sticky top-0 z-30 flex items-center justify-between px-4 sm:px-6 lg:px-8">
    <!-- Left Area: Mobile Toggle & Page Greeting -->
    <div class="flex items-center gap-4">
        <button type="button" onclick="toggleSidebar()" class="lg:hidden w-10 h-10 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-700 transition-colors">
            <i class="fa-solid fa-bars-staggered text-lg"></i>
        </button>

        <div class="hidden sm:block">
            <h1 class="text-base font-bold text-slate-800">
                Selamat Datang, {{ Auth::user()->name }}
            </h1>
            <p class="text-xs text-slate-500">
                {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }} &bull; Pustakanesia Digital
            </p>
        </div>
    </div>

    <!-- Right Area: Search, Online Pill, User Menu -->
    <div class="flex items-center gap-3 sm:gap-4">
        <!-- Quick Search Pill -->
        <a href="/buku" class="hidden md:flex items-center gap-2 px-3.5 py-1.5 rounded-full border border-slate-200 bg-slate-50 text-xs font-medium text-slate-500 hover:border-brand-300 hover:bg-brand-50 hover:text-brand-700 transition-all">
            <i class="fa-solid fa-magnifying-glass text-brand-600"></i>
            <span>Cari Koleksi Buku</span>
        </a>

        <!-- Status Indicator -->
        <div class="hidden lg:flex items-center gap-2 px-3 py-1 rounded-full border border-slate-200 bg-slate-50 text-xs font-semibold text-slate-600">
            <span class="w-2 h-2 rounded-full bg-emerald-500 shadow-sm shadow-emerald-500/50"></span>
            <span>Online</span>
        </div>

        <!-- User Dropdown Menu -->
        <div class="relative">
            <button id="userDropdownButton" type="button" onclick="toggleUserMenu()" class="flex items-center gap-2.5 p-1.5 sm:pr-3 rounded-full border border-slate-200 hover:border-brand-400 bg-white hover:shadow-sm transition-all">
                <img src="{{ $profile ? $profile->photo_profile_url : asset('images/photoProfile/boy.png') }}" 
                     alt="{{ Auth::user()->name }}" 
                     class="w-8 h-8 rounded-full object-cover">
                <span class="hidden sm:block text-xs font-bold text-slate-700">{{ Auth::user()->name }}</span>
                <i class="fa-solid fa-chevron-down text-slate-400 text-xs mr-1 hidden sm:block"></i>
            </button>

            <!-- Dropdown Body -->
            <div id="userDropdownMenu" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-50">
                <div class="px-4 py-2 border-b border-slate-100">
                    <p class="text-xs font-bold text-slate-800 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[11px] text-slate-500 truncate">{{ Auth::user()->email }}</p>
                </div>
                <div class="py-1">
                    <a href="/profile" class="flex items-center gap-3 px-4 py-2 text-xs font-medium text-slate-700 hover:bg-slate-50 hover:text-brand-600 transition-colors">
                        <i class="fa-solid fa-user-circle text-slate-400"></i>
                        <span>Lihat Profil</span>
                    </a>
                    <a href="/profile/edit" class="flex items-center gap-3 px-4 py-2 text-xs font-medium text-slate-700 hover:bg-slate-50 hover:text-brand-600 transition-colors">
                        <i class="fa-solid fa-user-pen text-slate-400"></i>
                        <span>Edit Profil</span>
                    </a>
                </div>
                <div class="border-t border-slate-100 pt-1">
                    <button type="button" onclick="openLogoutModal()" class="w-full flex items-center gap-3 px-4 py-2 text-xs font-semibold text-rose-600 hover:bg-rose-50 transition-colors text-left">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <span>Keluar (Logout)</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>
