<?php

namespace Database\Seeders;

use App\Models\Membre;
use Illuminate\Database\Seeder;

class MembreSeeder extends Seeder
{
    public function run(): void
    {
        $membres = [
            [
                'nom' => 'Diallo',
                'prenom' => 'Aminata',
                'email' => 'aminata.diallo@email.com',
                'telephone' => '+221 77 123 45 67',
                'ville' => 'Dakar',
                'competences' => 'Leadership, Gestion de projet, Communication',
                'statut' => 'actif',
                'date_naissance' => '1998-03-15',
                'adresse' => 'Plateau, Dakar',
                'created_by' => 1,
            ],
            [
                'nom' => 'Ndiaye',
                'prenom' => 'Moussa',
                'email' => 'moussa.ndiaye@email.com',
                'telephone' => '+221 78 234 56 78',
                'ville' => 'Thiès',
                'competences' => 'Informatique, Développement web, JavaScript',
                'statut' => 'actif',
                'date_naissance' => '1999-07-22',
                'adresse' => 'Thiès Nord',
                'created_by' => 1,
            ],
            [
                'nom' => 'Sarr',
                'prenom' => 'Fatou',
                'email' => 'fatou.sarr@email.com',
                'telephone' => '+221 76 345 67 89',
                'ville' => 'Saint-Louis',
                'competences' => 'Marketing digital, Réseaux sociaux, Design',
                'statut' => 'actif',
                'date_naissance' => '2000-11-08',
                'adresse' => 'Saint-Louis Centre',
                'created_by' => 1,
            ],
            [
                'nom' => 'Faye',
                'prenom' => 'Ibrahima',
                'email' => 'ibrahima.faye@email.com',
                'telephone' => '+221 70 456 78 90',
                'ville' => 'Ziguinchor',
                'competences' => 'Agriculture, Environnement, Développement durable',
                'statut' => 'inactif',
                'date_naissance' => '1997-05-30',
                'adresse' => 'Ziguinchor',
                'created_by' => 1,
            ],
            [
                'nom' => 'Mbaye',
                'prenom' => 'Rokhaya',
                'email' => 'rokhaya.mbaye@email.com',
                'telephone' => '+221 77 567 89 01',
                'ville' => 'Dakar',
                'competences' => 'Droit, Médiation, Droits humains',
                'statut' => 'actif',
                'date_naissance' => '2001-01-14',
                'adresse' => 'Almadies, Dakar',
                'created_by' => 1,
            ],
            [
                'nom' => 'Fall',
                'prenom' => 'Cheikh',
                'email' => 'cheikh.fall@email.com',
                'telephone' => '+221 78 678 90 12',
                'ville' => 'Kaolack',
                'competences' => 'Entrepreneuriat, Finance, Comptabilité',
                'statut' => 'actif',
                'date_naissance' => '1996-09-25',
                'adresse' => 'Kaolack',
                'created_by' => 1,
            ],
            [
                'nom' => 'Gueye',
                'prenom' => 'Aissatou',
                'email' => 'aissatou.gueye@email.com',
                'telephone' => '+221 76 789 01 23',
                'ville' => 'Touba',
                'competences' => 'Santé communautaire, Sensibilisation, Travail social',
                'statut' => 'inactif',
                'date_naissance' => '2002-04-18',
                'adresse' => 'Touba',
                'created_by' => 1,
            ],
            [
                'nom' => 'Diop',
                'prenom' => 'Oumar',
                'email' => 'oumar.diop@email.com',
                'telephone' => '+221 70 890 12 34',
                'ville' => 'Dakar',
                'competences' => 'Arts, Culture, Musique, Animation',
                'statut' => 'actif',
                'date_naissance' => '2000-12-03',
                'adresse' => 'Medina, Dakar',
                'created_by' => 1,
            ],
        ];

        foreach ($membres as $membre) {
            Membre::create($membre);
        }
    }
}
