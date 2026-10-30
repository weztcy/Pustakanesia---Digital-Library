<?php

namespace App\Models;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Buku extends Model
{
    use HasFactory;

    protected $table = "buku";
    protected $fillable = [
        'judul',
        'kode_buku',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'deskripsi',
        'gambar'
    ];

    /**
     * Get the resolved image URL (supporting both external URL and local uploaded file)
     *
     * @return string
     */
    public function getGambarUrlAttribute(): string
    {
        if (empty($this->gambar)) {
            return asset('/images/noImage.jpg');
        }

        if (filter_var($this->gambar, FILTER_VALIDATE_URL)) {
            return $this->gambar;
        }

        if (file_exists(public_path('images/' . $this->gambar))) {
            return asset('images/' . $this->gambar);
        }

        if (file_exists(public_path('img/buku/' . $this->gambar))) {
            return asset('img/buku/' . $this->gambar);
        }

        return asset('/images/noImage.jpg');
    }

    /**
     * The roles that belong to the Buku
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function kategori_buku():BelongsToMany
    {
        return $this->belongsToMany(Kategori::class, 'kategori_buku', 'buku_id', 'kategori_id');
    }
}
