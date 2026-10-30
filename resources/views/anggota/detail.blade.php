@extends('layouts.master')

@section('sidebar')
    @include('part.sidebar')
@endsection

@section('topbar')
    @include('part.topbar')
@endsection

@section('judul')
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Detail Anggota: {{ $profile->user->name }}</h1>
        <p class="text-sm text-slate-500 mt-0.5">Informasi profil lengkap, kontak, dan riwayat sirkulasi peminjaman anggota.</p>
    </div>
    <a href="/anggota" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold transition-all shadow-sm">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Kembali ke Data Anggota</span>
    </a>
@endsection

@section('content')
    <!-- Member Profile Card -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-10 mb-8">
        <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
            <div class="flex flex-col items-center text-center shrink-0">
                <img src="{{ $profile->photo_profile_url }}" 
                     alt="{{ $profile->user->name }}" 
                     class="w-32 h-32 rounded-full object-cover ring-4 ring-slate-100 shadow-xl mb-3">
                <h2 class="text-lg font-bold text-slate-900">{{ $profile->user->name }}</h2>
                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 mt-1 mb-2">
                    Anggota Aktif
                </span>
                <p class="text-xs text-slate-400 flex items-center gap-1.5">
                    <i class="fa-solid fa-envelope"></i>
                    <span>{{ $profile->user->email }}</span>
                </p>
            </div>

            <div class="flex-1 w-full border-t md:border-t-0 md:border-l md:border-slate-100 pt-6 md:pt-0 md:pl-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block mb-1">
                            Nomor Induk Mahasiswa (NPM)
                        </span>
                        <p class="text-sm font-bold text-slate-800 font-mono">{{ $profile->npm }}</p>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block mb-1">
                            Program Studi
                        </span>
                        <p class="text-sm font-bold text-slate-800">{{ $profile->prodi }}</p>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block mb-1">
                            Nomor Telepon / WhatsApp
                        </span>
                        <p class="text-sm font-bold text-slate-800">{{ $profile->noTelp }}</p>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block mb-1">
                            Alamat Tempat Tinggal
                        </span>
                        <p class="text-sm font-bold text-slate-800">{{ $profile->alamat }}</p>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                    <a href="/anggota/{{ $profile->user->id }}/edit" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-bold text-xs shadow-md shadow-amber-500/20 transition-all">
                        <i class="fa-solid fa-user-pen"></i>
                        <span>Edit Data Anggota</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Loan History of this Member -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden mb-8">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center text-sm font-bold">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
                <div>
                    <h2 class="text-base font-bold text-slate-800">Riwayat Peminjaman Buku Anggota</h2>
                    <p class="text-xs text-slate-400">Total: {{ count($pinjamanUser) }} Transaksi Peminjaman</p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/75 border-b border-slate-100 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-3.5 px-6 whitespace-nowrap" style="width: 6%;">No.</th>
                        <th class="py-3.5 px-6" style="width: 35%;">Judul Buku</th>
                        <th class="py-3.5 px-6 whitespace-nowrap" style="width: 15%;">Kode Buku</th>
                        <th class="py-3.5 px-6 whitespace-nowrap" style="width: 15%;">Tgl Pinjam</th>
                        <th class="py-3.5 px-6 whitespace-nowrap" style="width: 15%;">Jatuh Tempo</th>
                        <th class="py-3.5 px-6 whitespace-nowrap" style="width: 14%;">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs text-slate-700">
                    @forelse ($pinjamanUser as $item)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-4 px-6 font-semibold text-slate-400 whitespace-nowrap">{{ $loop->iteration }}</td>
                            <td class="py-4 px-6 font-bold text-slate-900">{{ $item->buku ? $item->buku->judul : '-' }}</td>
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
                            <td colspan="6" class="py-8 text-center text-slate-400 text-xs">Anggota ini belum pernah meminjam buku.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
