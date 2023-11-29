<?php

namespace App\Models;

use  App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PontosIniciaisAssociado extends Model
{
    use HasFactory;

    protected $fillable = [
        'associado_id',
        'pontos_iniciais',
    ];

    public function associado()
    {
        return $this->belongsTo(User::class, 'associado_id');
    }
}
