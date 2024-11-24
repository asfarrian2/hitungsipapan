<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Wp extends Authenticatable
{
    protected $table = "tb_wp";
    protected $primaryKey = "id_wajibpajak";
    public $incrementing = false;
    protected $fillable = [
        'id_wajibpajak',
        'nama',
        'alamat',
        'kegiatan',
        'no_telp',
        'id_unit',
        'email',
        'password',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
