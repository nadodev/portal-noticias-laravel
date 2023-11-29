<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class RankingProfissional extends Model
{
    use HasFactory;

    protected $fillable = ['profissional_id', 'posicao'];

    public function profissional()
    {
        return $this->belongsTo(User::class, 'profissional_id');
    }
}
