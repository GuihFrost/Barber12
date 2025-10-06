<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ClientController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Client::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->has('active')) {
            $query->where('is_active', $request->boolean('active'));
        }

        $clients = $query->orderBy('name')->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $clients
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'required|string|max:20',
            'birth_date' => 'nullable|date|before:today',
            'address' => 'nullable|string|max:500',
            'notes' => 'nullable|string|max:1000',
        ]);

        $validated['is_active'] = true;

        $client = Client::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Cliente criado com sucesso',
            'data' => $client
        ], 201);
    }

    public function show(Client $client): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $client
        ]);
    }

    public function update(Request $request, Client $client): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:clients,email,' . $client->id,
            'phone' => 'sometimes|string|max:20',
            'birth_date' => 'nullable|date|before:today',
            'address' => 'nullable|string|max:500',
            'notes' => 'nullable|string|max:1000',
            'is_active' => 'sometimes|boolean',
        ]);

        $client->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Cliente atualizado com sucesso',
            'data' => $client
        ]);
    }

    public function destroy(Client $client): JsonResponse
    {
        $client->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cliente excluído com sucesso'
        ]);
    }

    public function getAppointments(Client $client): JsonResponse
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

    public function getHistory(Client $client): JsonResponse
    {
        $history = $client->appointments()
            ->with(['barber', 'service'])
            ->orderBy('appointment_date', 'desc')
            ->get()
            ->groupBy(function($appointment) {
                return $appointment->appointment_date->format('Y-m');
            });

        return response()->json([
            'success' => true,
            'data' => $history
        ]);
    }
}