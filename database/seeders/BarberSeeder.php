<?php

namespace Database\Seeders;

use App\Models\Barber;
use Illuminate\Database\Seeder;

class BarberSeeder extends Seeder
{
    public function run(): void
    {
        $barbers = [
            [
                'name' => 'Carlos Silva',
                'email' => 'carlos@barbertime.com',
                'phone' => '(11) 99999-1111',
                'specialties' => ['Corte', 'Barba', 'Sobrancelha'],
                'bio' => 'Especialista em cortes modernos e barbas bem feitas. 8 anos de experiência.',
                'experience_years' => 8,
                'rating' => 4.8,
            ],
            [
                'name' => 'Ana Santos',
                'email' => 'ana@barbertime.com',
                'phone' => '(11) 99999-2222',
                'specialties' => ['Corte', 'Barba', 'Manicure'],
                'bio' => 'Profissional versátil com foco em cortes femininos e masculinos.',
                'experience_years' => 5,
                'rating' => 4.6,
            ],
            [
                'name' => 'Pedro Costa',
                'email' => 'pedro@barbertime.com',
                'phone' => '(11) 99999-3333',
                'specialties' => ['Corte', 'Barba', 'Sobrancelha', 'Bigode'],
                'bio' => 'Mestre em bigodes e barbas clássicas. 12 anos de experiência.',
                'experience_years' => 12,
                'rating' => 4.9,
            ],
            [
                'name' => 'Mariana Lima',
                'email' => 'mariana@barbertime.com',
                'phone' => '(11) 99999-4444',
                'specialties' => ['Corte', 'Manicure', 'Pedicure'],
                'bio' => 'Especialista em cuidados femininos e cortes modernos.',
                'experience_years' => 6,
                'rating' => 4.7,
            ],
        ];

        foreach ($barbers as $barber) {
            Barber::create($barber);
        }
    }
}