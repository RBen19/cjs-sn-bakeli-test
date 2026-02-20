# CSJ-SN — Plateforme de Gestion des Membres

Application web fullstack pour le **Consortium Jeunesse Sénégal** permettant de gérer ses membres.

---

## Stack technique

| Couche    | Technologie                     |
|-----------|----------------------------------|
| Frontend  | Vue.js 3 + Vite + Tailwind CSS v4 |
| Backend   | Laravel 11 + Sanctum             |
| Base de données | MySQL                      |
| Auth      | Token-based (Sanctum)            |

---

## Structure du projet

```
csj-sn/
├── frontend/   # Vue.js 3 + Vite + Tailwind CSS
└── backend/    # Laravel 11 + Sanctum
```

---

## Prérequis

- PHP >= 8.2
- Composer
- Node.js >= 18
- MySQL
- Extension PHP `pdo_mysql` activée

---

## Installation — Backend

```bash
cd backend

# 1. Installer les dépendances
composer install

# 2. Copier le fichier d'environnement
cp .env.example .env

# 3. Configurer la base de données dans .env
# DB_CONNECTION=mysql
# DB_DATABASE=csj_sn
# DB_USERNAME=root
# DB_PASSWORD=

# 4. Générer la clé d'application
php artisan key:generate

# 5. Créer la base de données MySQL
mysql -u root -e "CREATE DATABASE IF NOT EXISTS csj_sn CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# 6. Lancer les migrations et seeders
php artisan migrate --seed

# 7. Démarrer le serveur
php artisan serve
```

Le backend sera disponible sur **http://localhost:8000**

---

## Installation — Frontend

```bash
cd frontend

# 1. Installer les dépendances
npm install

# 2. Démarrer le serveur de développement
npm run dev
```

Le frontend sera disponible sur **http://localhost:5173**

---

## Identifiants de démo

| Champ    | Valeur               |
|----------|----------------------|
| Email    | admin@csj-sn.org     |
| Mot de passe | password         |

---

## Fonctionnalités

### Authentification
- Inscription avec nom, prénom, email, mot de passe
- Connexion avec token Sanctum
- Déconnexion
- Garde de navigation (routes protégées)

### Gestion des membres
- Lister tous les membres (paginés, 10 par page)
- Recherche par nom, email, ville, compétences
- Filtrage par statut (actif/inactif)
- Ajouter un membre (modal)
- Voir les détails d'un membre (modal)
- Modifier un membre (modal)
- Supprimer avec confirmation
- Statistiques : total, actifs, inactifs, villes couvertes

### Interface
- Landing page avec NavBar, Hero, Fonctionnalités, À propos, CTA, Footer
- Pages de connexion et inscription
- Dashboard avec sidebar, stat cards, tableau responsive
- Design responsive (mobile burger menu)
- Badges de statut colorés
- Avatars avec initiales

---

## API Endpoints

```
POST   /api/auth/register
POST   /api/auth/login
POST   /api/auth/logout       (auth:sanctum)
GET    /api/auth/me           (auth:sanctum)
GET    /api/membres           (auth:sanctum) ?search=&statut=&page=
POST   /api/membres           (auth:sanctum)
GET    /api/membres/stats     (auth:sanctum)
GET    /api/membres/{id}      (auth:sanctum)
PUT    /api/membres/{id}      (auth:sanctum)
DELETE /api/membres/{id}      (auth:sanctum)
```

---

## Données de test

8 membres pré-chargés avec :
- Noms sénégalais authentiques
- Villes variées (Dakar, Thiès, Saint-Louis, Ziguinchor, Kaolack, Touba)
- Compétences diverses
- Statuts mixtes (actif/inactif)
