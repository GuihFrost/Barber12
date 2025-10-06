<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => 'BarberTime API - Sistema de agendamentos para barbearia',
        'version' => '1.0.0',
        'status' => 'online',
        'endpoints' => [
            'health' => '/api/health',
            'appointments' => '/api/v1/appointments',
            'barbers' => '/api/v1/barbers',
            'services' => '/api/v1/services',
            'clients' => '/api/v1/clients',
            'dashboard' => '/api/dashboard/stats'
        ]
    ]);
});