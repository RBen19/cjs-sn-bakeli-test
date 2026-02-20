<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMembreRequest;
use App\Http\Requests\UpdateMembreRequest;
use App\Services\MembreService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MembreController extends Controller
{
    public function __construct(private readonly MembreService $membreService) {}

    public function index(Request $request): JsonResponse
    {
        $membres = $this->membreService->list($request->only(['search', 'statut']));

        return response()->json($membres);
    }

    public function store(StoreMembreRequest $request): JsonResponse
    {
        $membre = $this->membreService->create($request->validated(), $request->user()->id);

        return response()->json([
            'message' => 'Membre ajouté avec succès.',
            'membre'  => $membre,
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->membreService->find($id));
    }

    public function update(UpdateMembreRequest $request, int $id): JsonResponse
    {
        $membre = $this->membreService->update($id, $request->validated());

        return response()->json([
            'message' => 'Membre mis à jour avec succès.',
            'membre'  => $membre,
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->membreService->delete($id);

        return response()->json(['message' => 'Membre supprimé avec succès.']);
    }

    public function stats(): JsonResponse
    {
        return response()->json($this->membreService->stats());
    }
}
