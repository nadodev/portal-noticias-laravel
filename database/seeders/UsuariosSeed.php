<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\PontosDistribuido;
use App\Models\PontosIniciaisAssociado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;



class UsuariosSeed extends Seeder
{
    public function run()
    {
        PontosIniciaisAssociado::create([
            'associado_id' => 14,
            'pontos_iniciais' => 70000,
        ]);
    }
}
