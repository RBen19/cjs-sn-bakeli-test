<?php

namespace App\Services;

use App\Models\Membre;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class MembreService
{
    /**
     * Return a paginated list of membres with optional search and status filter.
     */
    public function list(array $filters): LengthAwarePaginator
    {
        $query = Membre::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('ville', 'like', "%{$search}%")
                  ->orWhere('competences', 'like', "%{$search}%");
            });
        }

        if (!empty($filters['statut']) && in_array($filters['statut'], ['actif', 'inactif'])) {
            $query->where('statut', $filters['statut']);
        }

        return $query->orderBy('created_at', 'desc')->paginate(10);
    }

    /**
     * Create a new membre.
     */
    public function create(array $data, int $createdBy): Membre
    {
        $data['created_by'] = $createdBy;
        $data['statut']     = $data['statut'] ?? 'actif';

        $membre = Membre::create($data);

        Log::info("[MembreService] Membre créé : {$membre->nom_complet} (ID: {$membre->id})");

        return $membre;
    }

    /**
     * Find a membre by id or throw 404.
     */
    public function find(int $id): Membre
    {
        return Membre::findOrFail($id);
    }

    /**
     * Update a membre and return the fresh model.
     */
    public function update(int $id, array $data): Membre
    {
        $membre = Membre::findOrFail($id);
        $membre->update($data);

        Log::info("[MembreService] Membre mis à jour : {$membre->nom_complet} (ID: {$membre->id})");

        return $membre->fresh();
    }

    /**
     * Delete a membre by id.
     */
    public function delete(int $id): void
    {
        $membre = Membre::findOrFail($id);
        $name   = $membre->nom_complet;

        $membre->delete();

        Log::info("[MembreService] Membre supprimé : {$name} (ID: {$id})");
    }

    /**
     * Return aggregate stats.
     */
    public function stats(): array
    {
        return [
            'total'        => Membre::count(),
            'actifs'       => Membre::where('statut', 'actif')->count(),
            'inactifs'     => Membre::where('statut', 'inactif')->count(),
            'villes_count' => Membre::whereNotNull('ville')->distinct('ville')->count('ville'),
        ];
    }
}
