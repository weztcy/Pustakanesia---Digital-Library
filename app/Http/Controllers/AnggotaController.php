<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $iduser = Auth::id();
        $user = User::where('isAdmin', '0')->get();
        $profile = Profile::where('users_id', $iduser)->first();
        return view('anggota.tampil', ['anggota' => $user, 'profile' => $profile]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $iduser = Auth::id();
        $user = User::where('isAdmin', '0')->get();
        $profile = Profile::where('users_id', $iduser)->first();
        return view('anggota.tambah', ['user' => $user, 'profile' => $profile]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'npm' => 'required|string|max:50|unique:profile,npm',
            'prodi' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'noTelp' => 'required|string|max:25',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ], [
            'name.required' => "Nama tidak boleh kosong",
            'npm.required' => "Nomor Induk tidak boleh kosong",
            'npm.unique' => "NPM Telah Digunakan",
            'prodi.required' => "Prodi tidak boleh kosong",
            'alamat.required' => "Alamat tidak boleh kosong",
            'noTelp.required' => "Nomor Telepon tidak boleh kosong",
            'email.required' => "Email tidak boleh kosong",
            'email.unique' => "Email Telah Digunakan",
            'password.required' => "Password tidak boleh kosong",
            'password.min' => "Password tidak boleh kurang dari 8 karakter"
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'isAdmin' => '0'
        ]);

        Profile::create([
            'npm' => $request['npm'],
            'prodi' => $request['prodi'],
            'alamat' => $request['alamat'],
            'noTelp' => $request['noTelp'],
            'photoProfile' => 'boy.png',
            'users_id' => $user->id,
        ]);

        Alert::success('Berhasil', 'Berhasil Menambah Anggota');
        return redirect('/anggota');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $profile = Profile::where('users_id', $user->id)->first();
        $pinjamanUser = Peminjaman::where('users_id', $user->id)->get();
        return view('anggota.detail', ['user' => $user, 'profile' => $profile, 'pinjamanUser' => $pinjamanUser]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $profile = Profile::firstOrCreate(
            ['users_id' => $user->id],
            [
                'npm' => 'MHS' . str_pad($user->id, 3, '0', STR_PAD_LEFT),
                'prodi' => 'Umum',
                'alamat' => '-',
                'noTelp' => '-',
                'photoProfile' => 'boy.png'
            ]
        );
        return view('anggota.edit', ['user' => $user, 'profile' => $profile]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $profile = Profile::firstOrCreate(
            ['users_id' => $user->id],
            [
                'npm' => 'MHS' . str_pad($user->id, 3, '0', STR_PAD_LEFT),
                'prodi' => 'Umum',
                'alamat' => '-',
                'noTelp' => '-',
                'photoProfile' => 'boy.png'
            ]
        );

        $request->validate([
            'name' => 'required|string|max:255',
            'npm' => [
                'required',
                'string',
                'max:50',
                Rule::unique('profile', 'npm')->ignore($profile->id)
            ],
            'prodi' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'noTelp' => 'required|string|max:25',
            'photoProfile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ], [
            'name.required' => "Nama tidak boleh kosong",
            'npm.required' => "Nomor Induk tidak boleh kosong",
            'npm.unique' => "NPM telah digunakan oleh anggota lain",
            'prodi.required' => "Prodi tidak boleh kosong",
            'alamat.required' => "Alamat tidak boleh kosong",
            'noTelp.required' => "Nomor Telepon tidak boleh kosong",
            'photoProfile.image' => "Foto Profile Harus Berupa file gambar",
            'photoProfile.mimes' => "Foto Profile Harus Berupa jpg, jpeg, atau png",
            'photoProfile.max' => "Ukuran gambar tidak boleh lebih dari 2048 KB"
        ]);

        if ($request->hasFile('photoProfile') && $request->file('photoProfile')->isValid()) {
            $destinationPath = public_path('images/photoProfile');
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            if (!empty($profile->photoProfile) && $profile->photoProfile !== 'boy.png') {
                $oldPath = $destinationPath . '/' . $profile->photoProfile;
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            $file = $request->file('photoProfile');
            $namaGambar = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $namaGambar);
            $profile->photoProfile = $namaGambar;
        }

        $user->name = $request->name;
        $user->save();

        $profile->npm = $request->npm;
        $profile->prodi = $request->prodi;
        $profile->alamat = $request->alamat;
        $profile->noTelp = $request->noTelp;
        $profile->save();

        Alert::success('Berhasil', 'Berhasil Mengubah Data Anggota');
        return redirect('/anggota');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        Alert::success('Berhasil', 'Berhasil Menghapus Anggota');
        return redirect('anggota');
    }
}
