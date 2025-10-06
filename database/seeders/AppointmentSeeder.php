<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Client;
use App\Models\Barber;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $clients = Client::all();
        $barbers = Barber::all();
        $services = Service::all();

        $appointments = [
            [
                'client_id' => $clients->first()->id,
                'barber_id' => $barbers->first()->id,
                'service_id' => $services->where('name', 'Corte + Barba')->first()->id,
                'appointment_date' => Carbon::today()->addDays(1),
                'appointment_time' => '14:30',
                'status' => 'confirmed',
                'notes' => 'Cliente preferencial',
                'total_price' => 35.00,
            ],
            [
                'client_id' => $clients->skip(1)->first()->id,
                'barber_id' => $barbers->skip(1)->first()->id,
                'service_id' => $services->where('name', 'Corte Feminino')->first()->id,
                'appointment_date' => Carbon::today()->addDays(1),
                'appointment_time' => '16:00',
                'status' => 'pending',
                'notes' => 'Primeira vez na barbearia',
                'total_price' => 30.00,
            ],
            [
                'client_id' => $clients->skip(2)->first()->id,
                'barber_id' => $barbers->skip(2)->first()->id,
                'service_id' => $services->where('name', 'Barba Simples')->first()->id,
                'appointment_date' => Carbon::today()->addDays(2),
                'appointment_time' => '10:00',
                'status' => 'confirmed',
                'notes' => 'Manutenção da barba',
                'total_price' => 15.00,
            ],
            [
                'client_id' => $clients->skip(3)->first()->id,
                'barber_id' => $barbers->skip(3)->first()->id,
                'service_id' => $services->where('name', 'Manicure')->first()->id,
                'appointment_date' => Carbon::today()->addDays(2),
                'appointment_time' => '15:00',
                'status' => 'pending',
                'notes' => 'Manicure com esmaltação',
                'total_price' => 20.00,
            ],
            [
                'client_id' => $clients->skip(4)->first()->id,
                'barber_id' => $barbers->first()->id,
                'service_id' => $services->where('name', 'Pacote Completo')->first()->id,
                'appointment_date' => Carbon::today()->addDays(3),
                'appointment_time' => '09:00',
                'status' => 'confirmed',
                'notes' => 'Pacote executivo',
                'total_price' => 60.00,
            ],
        ];

        foreach ($appointments as $appointment) {
            Appointment::create($appointment);
        }
    }
}