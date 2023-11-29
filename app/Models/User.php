<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\PontosDistribuido;
use App\Models\PontosRecebido;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'description',
        'city',
        'ramo',
        'state',
        'image',
        'number_phone',
        'website',
        'role', // Se você deseja que o campo 'role' seja preenchível em massa
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];



    public function pontosDistribuidosComoAssociado()
    {
        return $this->hasMany(PontosDistribuido::class, 'associado_id');
    }

    public function pontosRecebidosComoProfissional()
    {
        return $this->hasMany(PontosRecebido::class, 'profissional_id');
    }

    public function pontosRecebidos()
    {
        return $this->hasMany(PontosRecebido::class, 'profissional_id');
    }
}
