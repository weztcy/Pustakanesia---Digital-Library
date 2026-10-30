<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    protected $table = "profile";
    protected $fillable =[
        'npm',
        'prodi',
        'alamat',
        'noTelp',
        'photoProfile',
        'users_id'
    ];

    /**
     * Get resolved photo profile URL
     *
     * @return string
     */
    public function getPhotoProfileUrlAttribute(): string
    {
        if (empty($this->photoProfile)) {
            return asset('/images/photoProfile/boy.png');
        }

        if (filter_var($this->photoProfile, FILTER_VALIDATE_URL)) {
            return $this->photoProfile;
        }

        if (file_exists(public_path('images/photoProfile/' . $this->photoProfile))) {
            return asset('images/photoProfile/' . $this->photoProfile);
        }

        if (file_exists(public_path('images/' . $this->photoProfile))) {
            return asset('images/' . $this->photoProfile);
        }

        return asset('/images/photoProfile/boy.png');
    }

    public function user(){
        return $this->belongsTo(User::class,'users_id');
    }
}
