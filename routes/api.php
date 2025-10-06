<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\BarberController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ClientController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Health check
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now(),
        'service' => 'BarberTime API',
        'version' => '1.0.0'
    ]);
});

// Public API routes
Route::prefix('v1')->group(function () {
    // Appointments
    Route::apiResource('appointments', AppointmentController::class);
    Route::get('appointments/barber/{barber}', [AppointmentController::class, 'getByBarber']);
    Route::get('appointments/client/{client}', [AppointmentController::class, 'getByClient']);
    Route::get('appointments/date/{date}', [AppointmentController::class, 'getByDate']);
    Route::post('appointments/{appointment}/confirm', [AppointmentController::class, 'confirm']);
    Route::post('appointments/{appointment}/cancel', [AppointmentController::class, 'cancel']);
    
    // Barbers
    Route::apiResource('barbers', BarberController::class);
    Route::get('barbers/{barber}/appointments', [BarberController::class, 'getAppointments']);
    Route::get('barbers/{barber}/schedule', [BarberController::class, 'getSchedule']);
    
    // Services
    Route::apiResource('services', ServiceController::class);
    Route::get('services/category/{category}', [ServiceController::class, 'getByCategory']);
    
    // Clients
    Route::apiResource('clients', ClientController::class);
    Route::get('clients/{client}/appointments', [ClientController::class, 'getAppointments']);
    Route::get('clients/{client}/history', [ClientController::class, 'getHistory']);
});

// Dashboard data
Route::get('/dashboard/stats', function () {
    return response()->json([
        'total_appointments' => \App\Models\Appointment::count(),
        'total_barbers' => \App\Models\Barber::count(),
        'total_clients' => \App\Models\Client::count(),
        'total_services' => \App\Models\Service::count(),
        'today_appointments' => \App\Models\Appointment::whereDate('appointment_date', today())->count(),
        'pending_appointments' => \App\Models\Appointment::where('status', 'pending')->count(),
        'confirmed_appointments' => \App\Models\Appointment::where('status', 'confirmed')->count(),
    ]);
});