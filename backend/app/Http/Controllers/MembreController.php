<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMembreRequest;
use App\Http\Requests\UpdateMembreRequest;
use App\Models\Membre;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MembreController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Membre::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('ville', 'like', "%{$search}%")
                  ->orWhere('competences', 'like', "%{$search}%");
            });
        }

        if ($request->filled('statut') && in_array($request->statut, ['actif', 'inactif'])) {
            $query->where('statut', $request->statut);
        }

        $membres = $query->orderBy('created_at', 'desc')->paginate(10);

        return response()->json($membres);
    }

    public function store(StoreMembreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['statut'] = $data['statut'] ?? 'actif';

        $membre = Membre::create($data);

        return response()->json([
            'message' => 'Membre ajouté avec succès.',
            'membre' => $membre,
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $membre = Membre::findOrFail($id);

        return response()->json($membre);
    }

    public function update(UpdateMembreRequest $request, int $id): JsonResponse
    {
        $membre = Membre::findOrFail($id);
        $membre->update($request->validated());

        return response()->json([
            'message' => 'Membre mis à jour avec succès.',
            'membre' => $membre->fresh(),
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $membre = Membre::findOrFail($id);
        $membre->delete();

        return response()->json([
            'message' => 'Membre supprimé avec succès.',
        ]);
    }

    public function stats(): JsonResponse
    {
        $total = Membre::count();
        $actifs = Membre::where('statut', 'actif')->count();
        $inactifs = Membre::where('statut', 'inactif')->count();
        $villes_count = Membre::whereNotNull('ville')
            ->distinct('ville')
            ->count('ville');

        return response()->json([
            'total' => $total,
            'actifs' => $actifs,
            'inactifs' => $inactifs,
            'villes_count' => $villes_count,
        ]);
    }
}
