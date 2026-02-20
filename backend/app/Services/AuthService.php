<?php

namespace App\Services;

use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AuthService
{
    /**
     * Register a new user and send a welcome email.
     */
    public function register(array $data): array
    {
        $user = User::create([
            'nom'      => $data['nom'],
            'prenom'   => $data['prenom'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        Log::info("[AuthService] Nouveau compte créé : {$user->email} (ID: {$user->id})");

        $this->sendWelcomeMail($user);

        return ['user' => $user, 'token' => $token];
    }

    /**
     * Authenticate a user and return token.
     */
    public function login(string $email, string $password): ?array
    {
        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            Log::warning("[AuthService] Échec connexion pour : {$email}");
            return null;
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        Log::info("[AuthService] Connexion réussie : {$email}");

        return ['user' => $user, 'token' => $token];
    }

    /**
     * Revoke the current access token.
     */
    public function logout($user): void
    {
        Log::info("[AuthService] Déconnexion : {$user->email}");
        $user->currentAccessToken()->delete();
    }

    /**
     * Send welcome email, log on success or failure.
     */
    private function sendWelcomeMail(User $user): void
    {
        try {
            Mail::to($user->email)->send(new WelcomeMail($user));
            Log::info("[AuthService] Email de bienvenue envoyé à : {$user->email}");
        } catch (\Throwable $e) {
            Log::error("[AuthService] Échec envoi email à {$user->email} : {$e->getMessage()}");
        }
    }
}
