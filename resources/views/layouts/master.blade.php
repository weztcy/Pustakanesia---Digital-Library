<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Pustakanesia - Perpustakaan Digital Modern">
    <link href="{{ asset('/img/logoPustaka2.png') }}" rel="icon">
    <title>PUSTAKANESIA &mdash; Digital Library</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            200: '#c7d2fe',
                            300: '#a5b4fc',
                            400: '#818cf8',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#312e81',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Font Awesome 6.5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- jQuery & Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <style>
        /* Smooth scrolling and base styling */
        html { scroll-behavior: smooth; }
        body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; background-color: #f8fafc; color: #1e293b; }
        /* Select2 Tailwind Styling */
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #cbd5e1 !important;
            border-radius: 0.5rem !important;
            padding: 0.35rem 0.5rem !important;
            min-height: 44px !important;
        }
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #4f46e5 !important;
            outline: none !important;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15) !important;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #eef2ff !important;
            border: 1px solid #c7d2fe !important;
            color: #4338ca !important;
            border-radius: 9999px !important;
            padding: 2px 10px !important;
            font-size: 0.8125rem !important;
            font-weight: 600 !important;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #4338ca !important;
            margin-right: 5px !important;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col selection:bg-brand-500 selection:text-white">
    <div class="flex min-h-screen">
        <!-- Sidebar Backdrop for Mobile -->
        <div id="sidebarBackdrop" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 hidden lg:hidden transition-opacity"></div>

        <!-- Sidebar -->
        @yield('sidebar')
        <!-- /Sidebar -->

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 bg-slate-50">
            <!-- Topbar -->
            @yield('topbar')
            <!-- /Topbar -->

            <!-- Main Page Content -->
            <main class="flex-1 px-4 sm:px-6 lg:px-8 py-8 max-w-7xl w-full mx-auto">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                    @yield('judul')
                </div>

                @yield('content')
            </main>

            <!-- Modern Footer -->
            <footer class="bg-white border-t border-slate-200 py-6 mt-auto">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-3 text-sm text-slate-500">
                    <p>&copy; {{ date('Y') }} <strong class="text-slate-800">Pustakanesia</strong> &mdash; Sistem Informasi Perpustakaan Digital.</p>
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            Server Aktif
                        </span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Modal Logout Modal Tailwind -->
    <div id="logoutModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm hidden opacity-0 transition-opacity duration-200">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-100 transform scale-95 transition-transform duration-200" id="logoutModalContent">
            <div class="text-center">
                <div class="w-14 h-14 bg-rose-100 text-rose-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-1">Konfirmasi Keluar</h3>
                <p class="text-sm text-slate-500 mb-6">Apakah Anda yakin ingin mengakhiri sesi dan keluar dari sistem Pustakanesia?</p>
                <div class="flex items-center justify-center gap-3">
                    <button type="button" onclick="closeLogoutModal()" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-700 font-semibold text-sm hover:bg-slate-100 transition-colors">
                        Batal
                    </button>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="px-5 py-2.5 rounded-xl bg-rose-600 text-white font-semibold text-sm hover:bg-rose-700 shadow-sm shadow-rose-200 transition-all">
                        Ya, Logout
                    </a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
    </div>

    <!-- Global Helpers Script -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('hidden');
            }
        }

        function toggleUserMenu() {
            const menu = document.getElementById('userDropdownMenu');
            menu.classList.toggle('hidden');
        }

        function openLogoutModal() {
            const modal = document.getElementById('logoutModal');
            const content = document.getElementById('logoutModalContent');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                content.classList.remove('scale-95');
                content.classList.add('scale-100');
            }, 10);
        }

        function closeLogoutModal() {
            const modal = document.getElementById('logoutModal');
            const content = document.getElementById('logoutModalContent');
            modal.classList.add('opacity-0');
            content.classList.remove('scale-100');
            content.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }

        // Close dropdown when clicking outside
        window.addEventListener('click', function(e) {
            const btn = document.getElementById('userDropdownButton');
            const menu = document.getElementById('userDropdownMenu');
            if (btn && menu && !btn.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
    </script>

    @stack('scripts')
    @include('sweetalert::alert')
</body>
</html>
