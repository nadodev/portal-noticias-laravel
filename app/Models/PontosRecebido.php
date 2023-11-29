<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class PontosRecebido extends Model
{
    use HasFactory;

    protected $fillable = ['profissional_id', 'quantidade'];

    public function profissional()
    {
        return $this->belongsTo(User::class, 'profissional_id');
    }



    public function associadoDistribuidor()
    {
        return $this->belongsTo(User::class, 'associado_id', 'id');
    }

    
}
