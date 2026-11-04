<?php

namespace Auth;

class Session {
    private const USER_KEY = 'user_id';
    private const FLASH_KEY = 'flash';
    private const CSRF_KEY = 'csrf_token';

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // --- Utilisateur connecté ---

    public function isLoggedIn(): bool {
        return isset($_SESSION[self::USER_KEY]);
    }

    public function getUserId(): ?int {
        return $_SESSION[self::USER_KEY] ?? null;
    }

    public function login(int $userId): void {
        session_regenerate_id(true); // nouvel identifiant de session : évite le vol de session
        $_SESSION[self::USER_KEY] = $userId;
    }

    public function logout(): void {
        $_SESSION = [];
        session_destroy();
    }

    // --- Messages flash (affichés une seule fois, après une redirection) ---

    public function setFlash(string $message): void {
        $_SESSION[self::FLASH_KEY] = $message;
    }

    public function getFlash(): ?string {
        $message = $_SESSION[self::FLASH_KEY] ?? null;
        unset($_SESSION[self::FLASH_KEY]);

        return $message;
    }

    // --- Protection CSRF des formulaires ---

    public function getCsrfToken(): string {
        if (!isset($_SESSION[self::CSRF_KEY])) {
            $_SESSION[self::CSRF_KEY] = bin2hex(random_bytes(32));
        }

        return $_SESSION[self::CSRF_KEY];
    }

    public function isValidCsrfToken(string $token): bool {
        return hash_equals($this->getCsrfToken(), $token);
    }
}
