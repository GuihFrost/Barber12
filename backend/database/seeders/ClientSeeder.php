<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $clients = [
            [
                'name' => 'João Silva',
                'email' => 'joao@email.com',
                'phone' => '(11) 98888-1111',
                'birth_date' => '1985-03-15',
                'address' => 'Rua das Flores, 123 - São Paulo/SP',
                'notes' => 'Cliente fiel, sempre pontual',
            ],
            [
                'name' => 'Maria Santos',
                'email' => 'maria@email.com',
                'phone' => '(11) 98888-2222',
                'birth_date' => '1990-07-22',
                'address' => 'Av. Paulista, 456 - São Paulo/SP',
                'notes' => 'Prefere cortes modernos',
            ],
            [
                'name' => 'Pedro Costa',
                'email' => 'pedro@email.com',
                'phone' => '(11) 98888-3333',
                'birth_date' => '1988-11-10',
                'address' => 'Rua Augusta, 789 - São Paulo/SP',
                'notes' => 'Gosta de barbas bem feitas',
            ],
            [
                'name' => 'Ana Lima',
                'email' => 'ana@email.com',
                'phone' => '(11) 98888-4444',
                'birth_date' => '1992-05-18',
                'address' => 'Rua Oscar Freire, 321 - São Paulo/SP',
                'notes' => 'Cliente nova, interessada em manicure',
            ],
            [
                'name' => 'Carlos Oliveira',
                'email' => 'carlos@email.com',
                'phone' => '(11) 98888-5555',
                'birth_date' => '1980-12-03',
                'address' => 'Av. Faria Lima, 654 - São Paulo/SP',
                'notes' => 'Executivo, horários restritos',
            ],
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }
    }
}