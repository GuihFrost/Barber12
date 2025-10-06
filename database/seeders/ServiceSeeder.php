<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Corte Masculino',
                'description' => 'Corte moderno e estiloso para homens',
                'price' => 25.00,
                'duration' => 30,
                'category' => 'Corte',
            ],
            [
                'name' => 'Barba Simples',
                'description' => 'Aparar e modelar a barba',
                'price' => 15.00,
                'duration' => 20,
                'category' => 'Barba',
            ],
            [
                'name' => 'Corte + Barba',
                'description' => 'Corte completo com barba',
                'price' => 35.00,
                'duration' => 45,
                'category' => 'Combo',
            ],
            [
                'name' => 'Sobrancelha',
                'description' => 'Design e limpeza da sobrancelha',
                'price' => 10.00,
                'duration' => 15,
                'category' => 'Sobrancelha',
            ],
            [
                'name' => 'Bigode',
                'description' => 'Aparar e modelar o bigode',
                'price' => 8.00,
                'duration' => 10,
                'category' => 'Bigode',
            ],
            [
                'name' => 'Corte Feminino',
                'description' => 'Corte moderno para mulheres',
                'price' => 30.00,
                'duration' => 40,
                'category' => 'Corte',
            ],
            [
                'name' => 'Manicure',
                'description' => 'Cuidados com as unhas das mãos',
                'price' => 20.00,
                'duration' => 30,
                'category' => 'Manicure',
            ],
            [
                'name' => 'Pedicure',
                'description' => 'Cuidados com as unhas dos pés',
                'price' => 25.00,
                'duration' => 35,
                'category' => 'Pedicure',
            ],
            [
                'name' => 'Pacote Completo',
                'description' => 'Corte + Barba + Sobrancelha + Manicure',
                'price' => 60.00,
                'duration' => 90,
                'category' => 'Combo',
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}