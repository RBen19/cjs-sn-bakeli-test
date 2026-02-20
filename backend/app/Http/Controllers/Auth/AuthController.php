<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private readonly AuthService $authService) {}

    public function register(RegisterRequest $request): JsonResponse
    {
        $result = $this->authService->register($request->validated());

        return response()->json([
            'message' => 'Inscription réussie. Un email de bienvenue vous a été envoyé.',
            'user'    => $result['user'],
            'token'   => $result['token'],
        ], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $result = $this->authService->login($request->email, $request->password);

        if (!$result) {
            return response()->json(['message' => 'Email ou mot de passe incorrect.'], 401);
        }

        return response()->json([
            'message' => 'Connexion réussie.',
            'user'    => $result['user'],
            'token'   => $result['token'],
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $this->authService->logout($request->user());

        return response()->json(['message' => 'Déconnexion réussie.']);
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }
}
