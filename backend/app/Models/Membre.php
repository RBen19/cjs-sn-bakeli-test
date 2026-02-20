<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Membre extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'ville',
        'competences',
        'statut',
        'date_naissance',
        'adresse',
        'created_by',
    ];

    protected $casts = [
        'date_naissance' => 'date',
    ];

    protected $appends = ['age', 'nom_complet'];

    public function createur()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getAgeAttribute(): ?int
    {
        if ($this->date_naissance) {
            return Carbon::parse($this->date_naissance)->age;
        }
        return null;
    }

    public function getNomCompletAttribute(): string
    {
        return trim($this->prenom . ' ' . $this->nom);
    }

    public function scopeActif($query)
    {
        return $query->where('statut', 'actif');
    }

    public function scopeInactif($query)
    {
        return $query->where('statut', 'inactif');
    }
}
