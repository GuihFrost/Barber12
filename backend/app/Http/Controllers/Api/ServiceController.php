<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Service::query();

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        if ($request->has('active')) {
            $query->where('is_active', $request->boolean('active'));
        }

        $services = $query->orderBy('name')->get();

        return response()->json([
            'success' => true,
            'data' => $services
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'category' => 'required|string|in:Corte,Barba,Sobrancelha,Bigode,Manicure,Pedicure,Combo',
            'image' => 'nullable|string|max:255',
        ]);

        $validated['is_active'] = true;

        $service = Service::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Serviço criado com sucesso',
            'data' => $service
        ], 201);
    }

    public function show(Service $service): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $service
        ]);
    }

    public function update(Request $request, Service $service): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'sometimes|numeric|min:0',
            'duration' => 'sometimes|integer|min:1',
            'category' => 'sometimes|string|in:Corte,Barba,Sobrancelha,Bigode,Manicure,Pedicure,Combo',
            'image' => 'nullable|string|max:255',
            'is_active' => 'sometimes|boolean',
        ]);

        $service->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Serviço atualizado com sucesso',
            'data' => $service
        ]);
    }

    public function destroy(Service $service): JsonResponse
    {
        $service->delete();

        return response()->json([
            'success' => true,
            'message' => 'Serviço excluído com sucesso'
        ]);
    }

    public function getByCategory(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'category' => 'required|string|in:Corte,Barba,Sobrancelha,Bigode,Manicure,Pedicure,Combo'
        ]);

        $services = Service::where('category', $validated['category'])
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $services
        ]);
    }
}