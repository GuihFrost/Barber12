<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\Barber;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class AppointmentController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Appointment::with(['client', 'barber', 'service']);

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('date')) {
            $query->whereDate('appointment_date', $request->date);
        }

        if ($request->has('barber_id')) {
            $query->where('barber_id', $request->barber_id);
        }

        $appointments = $query->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $appointments
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'barber_id' => 'required|exists:barbers,id',
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i',
            'notes' => 'nullable|string|max:500',
        ]);

        // Verificar se o barbeiro está disponível no horário
        $existingAppointment = Appointment::where('barber_id', $validated['barber_id'])
            ->whereDate('appointment_date', $validated['appointment_date'])
            ->whereTime('appointment_time', $validated['appointment_time'])
            ->first();

        if ($existingAppointment) {
            return response()->json([
                'success' => false,
                'message' => 'Barbeiro já possui agendamento neste horário'
            ], 422);
        }

        // Calcular preço total
        $service = Service::find($validated['service_id']);
        $validated['total_price'] = $service->price;
        $validated['status'] = 'pending';

        $appointment = Appointment::create($validated);
        $appointment->load(['client', 'barber', 'service']);

        return response()->json([
            'success' => true,
            'message' => 'Agendamento criado com sucesso',
            'data' => $appointment
        ], 201);
    }

    public function show(Appointment $appointment): JsonResponse
    {
        $appointment->load(['client', 'barber', 'service']);

        return response()->json([
            'success' => true,
            'data' => $appointment
        ]);
    }

    public function update(Request $request, Appointment $appointment): JsonResponse
    {
        $validated = $request->validate([
            'client_id' => 'sometimes|exists:clients,id',
            'barber_id' => 'sometimes|exists:barbers,id',
            'service_id' => 'sometimes|exists:services,id',
            'appointment_date' => 'sometimes|date|after_or_equal:today',
            'appointment_time' => 'sometimes|date_format:H:i',
            'status' => ['sometimes', Rule::in(['pending', 'confirmed', 'cancelled', 'completed'])],
            'notes' => 'nullable|string|max:500',
        ]);

        $appointment->update($validated);
        $appointment->load(['client', 'barber', 'service']);

        return response()->json([
            'success' => true,
            'message' => 'Agendamento atualizado com sucesso',
            'data' => $appointment
        ]);
    }

    public function destroy(Appointment $appointment): JsonResponse
    {
        $appointment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Agendamento excluído com sucesso'
        ]);
    }

    public function getByBarber(Barber $barber): JsonResponse
    {
        $appointments = $barber->appointments()
            ->with(['client', 'service'])
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $appointments
        ]);
    }

    public function getByClient(Client $client): JsonResponse
    {
        $appointments = $client->appointments()
            ->with(['barber', 'service'])
            ->orderBy('appointment_date', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $appointments
        ]);
    }

    public function getByDate(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'date' => 'required|date'
        ]);

        $appointments = Appointment::with(['client', 'barber', 'service'])
            ->whereDate('appointment_date', $validated['date'])
            ->orderBy('appointment_time')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $appointments
        ]);
    }

    public function confirm(Appointment $appointment): JsonResponse
    {
        $appointment->update(['status' => 'confirmed']);

        return response()->json([
            'success' => true,
            'message' => 'Agendamento confirmado com sucesso',
            'data' => $appointment->load(['client', 'barber', 'service'])
        ]);
    }

    public function cancel(Appointment $appointment): JsonResponse
    {
        $appointment->update(['status' => 'cancelled']);

        return response()->json([
            'success' => true,
            'message' => 'Agendamento cancelado com sucesso',
            'data' => $appointment->load(['client', 'barber', 'service'])
        ]);
    }
}