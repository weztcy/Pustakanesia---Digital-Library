<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $iduser = Auth::id();
        $profile = Profile::firstOrCreate(
            ['users_id' => $iduser],
            [
                'npm' => (Auth::user()->isAdmin == 1 ? 'ADM' : 'MHS') . str_pad($iduser, 3, '0', STR_PAD_LEFT),
                'prodi' => Auth::user()->isAdmin == 1 ? 'Administrator Sistem' : 'Umum',
                'alamat' => '-',
                'noTelp' => '-',
                'photoProfile' => 'boy.png'
            ]
        );

        return view('profile.tampil', ['profile' => $profile]);
    }

    public function edit($id = null)
    {
        $iduser = Auth::id();
        $profile = Profile::firstOrCreate(
            ['users_id' => $iduser],
            [
                'npm' => (Auth::user()->isAdmin == 1 ? 'ADM' : 'MHS') . str_pad($iduser, 3, '0', STR_PAD_LEFT),
                'prodi' => Auth::user()->isAdmin == 1 ? 'Administrator Sistem' : 'Umum',
                'alamat' => '-',
                'noTelp' => '-',
                'photoProfile' => 'boy.png'
            ]
        );

        return view('profile.edit', ['profile' => $profile]);
    }

    public function update(Request $request, $id = null)
    {
        $iduser = Auth::id();
        $profile = Profile::firstOrCreate(
            ['users_id' => $iduser],
            [
                'npm' => (Auth::user()->isAdmin == 1 ? 'ADM' : 'MHS') . str_pad($iduser, 3, '0', STR_PAD_LEFT),
                'prodi' => Auth::user()->isAdmin == 1 ? 'Administrator Sistem' : 'Umum',
                'alamat' => '-',
                'noTelp' => '-',
                'photoProfile' => 'boy.png'
            ]
        );
        $user = User::findOrFail($iduser);

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
            'name.required' => 'Nama tidak boleh kosong',
            'npm.required' => 'Nomor Induk tidak boleh kosong',
            'npm.unique' => 'NPM telah digunakan oleh pengguna lain',
            'prodi.required' => 'Program Studi tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'noTelp.required' => 'Nomor Telepon tidak boleh kosong',
            'photoProfile.image' => 'Foto Profil harus berupa file gambar',
            'photoProfile.mimes' => 'Foto Profil harus berformat JPG, JPEG, atau PNG',
            'photoProfile.max' => 'Ukuran gambar tidak boleh lebih dari 2048 KB'
        ]);

        if ($request->hasFile('photoProfile') && $request->file('photoProfile')->isValid()) {
            $destinationPath = public_path('images/photoProfile');
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            // Remove old custom photo if exists and is not default avatar
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

        Alert::success('Berhasil', 'Profil Anda berhasil diperbarui');
        return redirect('/profile');
    }
}
