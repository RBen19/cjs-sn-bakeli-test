<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMembreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $membreId = $this->route('membre');

        return [
            'nom' => 'sometimes|required|string|max:255',
            'prenom' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:membres,email,' . $membreId,
            'telephone' => 'nullable|string|max:20',
            'ville' => 'nullable|string|max:255',
            'competences' => 'nullable|string',
            'statut' => 'nullable|in:actif,inactif',
            'date_naissance' => 'nullable|date|before:today',
            'adresse' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom est obligatoire.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'L\'adresse email est invalide.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            'statut.in' => 'Le statut doit être actif ou inactif.',
            'date_naissance.date' => 'La date de naissance est invalide.',
            'date_naissance.before' => 'La date de naissance doit être dans le passé.',
        ];
    }
}
