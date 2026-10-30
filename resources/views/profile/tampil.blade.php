@extends('layouts.master')

@section('sidebar')
    @include('part.sidebar')
@endsection

@section('topbar')
    @include('part.topbar')
@endsection

@section('judul')
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Profil Akun Saya</h1>
        <p class="text-sm text-slate-500 mt-0.5">Informasi identitas digital, kredensial, dan data akademik anggota.</p>
    </div>
    <a href="/profile/edit" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold shadow-md shadow-brand-500/20 transition-all">
        <i class="fa-solid fa-user-pen"></i>
        <span>Perbarui Profil</span>
    </a>
@endsection

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden mb-8">
            <!-- Header Cover Gradient -->
            <div class="h-36 bg-gradient-to-r from-brand-600 via-indigo-600 to-cyan-600 relative"></div>

            <div class="px-6 sm:px-10 pb-10 pt-2 relative">
                <div class="flex flex-col sm:flex-row items-center sm:items-center justify-between gap-4 mb-8">
                    <div class="flex flex-col sm:flex-row items-center sm:items-center gap-5 text-center sm:text-left">
                        <div class="-mt-16 sm:-mt-20 shrink-0">
                            <img src="{{ $profile->photo_profile_url }}" 
                                 alt="{{ $profile->user->name }}" 
                                 class="w-32 h-32 rounded-full object-cover ring-4 ring-white shadow-xl bg-white">
                        </div>
                        <div class="pt-2 sm:pt-5">
                            <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 leading-tight">{{ $profile->user->name }}</h2>
                            <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2 mt-1.5">
                                <span class="px-3 py-0.5 rounded-full text-xs font-semibold {{ Auth::user()->isAdmin == 1 ? 'bg-brand-50 text-brand-700 border border-brand-200' : 'bg-emerald-50 text-emerald-700 border border-emerald-200' }}">
                                    {{ Auth::user()->isAdmin == 1 ? 'Administrator' : 'Anggota Mahasiswa' }}
                                </span>
                                <span class="text-xs text-slate-400">&bull; {{ $profile->user->email }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="sm:self-center pt-2 sm:pt-4">
                        <a href="/profile/edit" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 hover:border-brand-400 text-slate-700 text-xs font-bold transition-all shadow-sm">
                            <i class="fa-solid fa-pen-to-square text-brand-600"></i>
                            <span>Edit Data</span>
                        </a>
                    </div>
                </div>

                <!-- Profile Info Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-6 border-t border-slate-100">
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
            </div>
        </div>
    </div>
@endsection
