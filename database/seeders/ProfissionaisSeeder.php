<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProfissionaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Criar usuários como profissionais
        $profissionais = [
            ['name' => 'Profissional 1', 'email' => 'profissional1@email.com', 'role' => 'profissional', 'password' => Hash::make('senha')],
            ['name' => 'Profissional 2', 'email' => 'profissional2@email.com', 'role' => 'profissional', 'password' => Hash::make('senha')],
            // Adicionar mais profissionais conforme necessário
        ];

        foreach ($profissionais as $profissional) {
            User::create($profissional);
        }
    }
}
