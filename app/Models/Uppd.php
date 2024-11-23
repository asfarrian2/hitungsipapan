<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Uppd extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "tb_uppd";
    protected $primaryKey = "id_unit";
    public $incrementing = false;
    protected $fillable = [
        'id_unit',
        'nama_unit',
        'no_telp',
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
