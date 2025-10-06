<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barber;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BarberController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Barber::query();

        if ($request->has('specialty')) {
            $query->whereJsonContains('specialties', $request->specialty);
        }

        if ($request->has('active')) {
            $query->where('is_active', $request->boolean('active'));
        }

        $barbers = $query->orderBy('name')->get();

        return response()->json([
            'success' => true,
            'data' => $barbers
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:barbers,email',
            'phone' => 'required|string|max:20',
            'specialties' => 'required|array|min:1',
            'specialties.*' => 'string|in:Corte,Barba,Sobrancelha,Bigode,Manicure,Pedicure',
            'bio' => 'nullable|string|max:1000',
            'avatar' => 'nullable|string|max:255',
            'experience_years' => 'nullable|integer|min:0|max:50',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        $validated['is_active'] = true;

        $barber = Barber::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Barbeiro criado com sucesso',
            'data' => $barber
        ], 201);
    }

    public function show(Barber $barber): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $barber
        ]);
    }

    public function update(Request $request, Barber $barber): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:barbers,email,' . $barber->id,
            'phone' => 'sometimes|string|max:20',
            'specialties' => 'sometimes|array|min:1',
            'specialties.*' => 'string|in:Corte,Barba,Sobrancelha,Bigode,Manicure,Pedicure',
            'bio' => 'nullable|string|max:1000',
            'avatar' => 'nullable|string|max:255',
            'is_active' => 'sometimes|boolean',
            'experience_years' => 'nullable|integer|min:0|max:50',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        $barber->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Barbeiro atualizado com sucesso',
            'data' => $barber
        ]);
    }

    public function destroy(Barber $barber): JsonResponse
    {
        $barber->delete();

        return response()->json([
            'success' => true,
            'message' => 'Barbeiro excluído com sucesso'
        ]);
    }

    public function getAppointments(Barber $barber): JsonResponse
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

    public function getSchedule(Barber $barber, Request $request): JsonResponse
    {
        $validated = $request->validate([
            'date' => 'required|date'
        ]);

        $availableSlots = $barber->getAvailableTimeSlots($validated['date']);

        return response()->json([
            'success' => true,
            'data' => [
                'barber' => $barber,
                'date' => $validated['date'],
                'available_slots' => $availableSlots
            ]
        ]);
    }
}