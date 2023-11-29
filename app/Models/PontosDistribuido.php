<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class PontosDistribuido extends Model
{
    use HasFactory;


    protected $fillable = ['associado_id', 'profissional_id', 'quantidade'];

    public function associado()
    {
        return $this->belongsTo(User::class, 'associado_id');
    }

    public function profissional()
    {
        return $this->belongsTo(User::class, 'profissional_id');
    }
}
