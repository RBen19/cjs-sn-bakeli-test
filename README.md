# CSJ-SN — Plateforme de Gestion des Membres

Application web fullstack pour le **Consortium Jeunesse Sénégal** permettant de gérer ses membres.

---

## Stack technique

| Couche          | Technologie                        |
|-----------------|------------------------------------|
| Frontend        | Vue.js 3 + Vite + Tailwind CSS v3  |
| Backend         | Laravel 11 + Sanctum               |
| Base de données | MySQL                              |
| Auth            | Token-based (Sanctum)              |
| Email           | Gmail SMTP (App Password)          |

---

## Structure du projet

```
csj-sn/
├── frontend/   # Vue.js 3 + Vite + Tailwind CSS
└── backend/    # Laravel 11 + Sanctum + Service Layer
    └── app/
        ├── Http/Controllers/   # Controllers légers (délèguent aux services)
        ├── Services/           # AuthService, MembreService (logique métier + logs)
        ├── Mail/               # WelcomeMail (email de bienvenue)
        └── Models/             # User, Membre
```

---

## Prérequis

- PHP >= 8.2
- Composer
- Node.js >= 18
- MySQL
- Extension PHP `pdo_mysql` activée

---

## Installation rapide — Backend (script automatisé)

Un script d'installation est fourni. Il installe les dépendances, copie le `.env`, génère la clé, lance les migrations et démarre le serveur.

> **Avant de lancer le script**, créez la base de données MySQL :
> ```bash
> mysql -u root -e "CREATE DATABASE IF NOT EXISTS csj_sn CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
> ```

```bash
cd backend
bash install.sh
```

---

## Installation manuelle — Backend

```bash
cd backend

# 1. Installer les dépendances
composer install

# 2. Copier le fichier d'environnement
cp .env.example .env

# 3. Configurer la base de données dans .env
#    DB_CONNECTION=mysql
#    DB_DATABASE=csj_sn
#    DB_USERNAME=root
#    DB_PASSWORD=

# 4. Configurer l'email dans .env (Gmail App Password)
#    MAIL_USERNAME=votre-email@gmail.com
#    MAIL_PASSWORD=votre-app-password-16-caracteres

# 5. Générer la clé d'application
php artisan key:generate

# 6. Créer la base de données MySQL
mysql -u root -e "CREATE DATABASE IF NOT EXISTS csj_sn CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# 7. Lancer les migrations et seeders
php artisan migrate --seed

# 8. Démarrer le serveur
php artisan serve
```

Le backend sera disponible sur **http://localhost:8000**

---

## Installation — Frontend

```bash
cd frontend

# 1. Copier le fichier d'environnement
cp .env.example .env

# 2. (Optionnel) Modifier l'URL de l'API dans .env
#    VITE_API_URL=http://localhost:8000/api

# 3. Installer les dépendances
npm install

# 4. Démarrer le serveur de développement
npm run dev
```

Le frontend sera disponible sur **http://localhost:5173**

---

## Configuration email (Gmail)

L'application envoie un email de bienvenue lors de chaque inscription.

Dans `backend/.env` :

```dotenv
MAIL_MAILER=smtp
MAIL_SCHEME=tls
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=votre-email@gmail.com
MAIL_PASSWORD=votre-app-password      # 16 caractères sans espaces
MAIL_FROM_ADDRESS=votre-email@gmail.com
MAIL_FROM_NAME="CSJ-SN | Ne pas répondre"
```

> **Générer un App Password Gmail :** Compte Google → Sécurité → Validation en 2 étapes → Mots de passe des applications.

---

## Identifiants de démo

| Champ        | Valeur               |
|--------------|----------------------|
| Email        | admin@csj-sn.org     |
| Mot de passe | password             |

---

## Architecture backend — Service Layer

Les controllers sont volontairement légers : ils valident les données via les Form Requests puis délèguent toute la logique métier aux services.

```
Request
  └─► FormRequest (validation)
        └─► Controller (HTTP layer)
              └─► Service (logique métier + logs)
                    └─► Model / Eloquent (accès données)
```

| Service         | Responsabilité                                  |
|-----------------|-------------------------------------------------|
| `AuthService`   | Inscription, connexion, déconnexion, email      |
| `MembreService` | CRUD membres, recherche, filtrage, statistiques |

Les services écrivent dans les logs Laravel (`storage/logs/laravel.log`) pour chaque action importante.

---

## API Endpoints

```
POST   /api/auth/register          Inscription + email de bienvenue
POST   /api/auth/login             Connexion
POST   /api/auth/logout            Déconnexion     (auth:sanctum)
GET    /api/auth/me                Profil courant  (auth:sanctum)

GET    /api/membres                Liste paginée   (auth:sanctum) ?search=&statut=&page=
POST   /api/membres                Créer           (auth:sanctum)
GET    /api/membres/stats          Statistiques    (auth:sanctum)
GET    /api/membres/{id}           Détail          (auth:sanctum)
PUT    /api/membres/{id}           Modifier        (auth:sanctum)
DELETE /api/membres/{id}           Supprimer       (auth:sanctum)
```

---

## Fonctionnalités

### Authentification
- Inscription avec nom, prénom, email, mot de passe
- **Email de bienvenue** envoyé automatiquement après inscription
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

## Données de test

8 membres pré-chargés avec :
- Noms sénégalais authentiques
- Villes variées (Dakar, Thiès, Saint-Louis, Ziguinchor, Kaolack, Touba)
- Compétences diverses
- Statuts mixtes (actif/inactif)
