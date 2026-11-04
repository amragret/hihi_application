<?php

namespace Pages;

use Auth\Session;
use Throwable;
use Users\User;
use Users\UsersManager;


abstract class Page {
    private ?User $currentUser = null;
    private bool $currentUserLoaded = false;

    public function __construct(
        protected Session $session,
        protected string $title,
    ) {
    }

    abstract protected function renderContent(): string;

    protected function handleRequest(): void {
    }

    protected function renderHeadExtra(): string {
        return '';
    }


    public function render(): void {
        try {
            $this->handleRequest();
            $content = $this->renderContent();
        } catch (Throwable $e) {
            error_log((string) $e);
            $this->showError(500, 'Une erreur est survenue. Réessaie dans quelques instants.');
        }

        echo $this->renderLayout($content);
    }

    private function renderLayout(string $content): string {
        $title = $this->escape($this->title);
        $headExtra = $this->renderHeadExtra();

        $flash = $this->session->getFlash();
        $flashHtml = $flash !== null
            ? '<p class="flash">' . $this->escape($flash) . '</p>'
            : '';

        $nav = $this->session->isLoggedIn()
            ? '<a href="result.php">Ma HiHi</a> <a href="logout.php">Se déconnecter</a>'
            : '<a href="login.php">Se connecter</a> <a href="signup.php">Créer un compte</a>';

        return <<<HTML
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>{$title} · HiHi</title>
            <link rel="stylesheet" href="css/style.css">
            {$headExtra}
        </head>
        <body>
            <header class="site-header">
                <a href="index.php" class="logo">HiHi</a>
                <nav>{$nav}</nav>
            </header>
            <main>
                {$flashHtml}
                {$content}
            </main>
            <footer class="site-footer">
                <p>Projet HiHi · HEIG-VD</p>
            </footer>
        </body>
        </html>
        HTML;
    }

    // --- Outils utilisables par toutes les pages enfants ---

    // Renvoie l'utilisateur connecté, ou null. La base n'est lue qu'une fois.
    protected function getCurrentUser(): ?User {
        if (!$this->currentUserLoaded) {
            $this->currentUserLoaded = true;

            if ($this->session->isLoggedIn()) {
                $this->currentUser = (new UsersManager())->getUserById($this->session->getUserId());

                // Compte supprimé entre-temps : on nettoie la session.
                if ($this->currentUser === null) {
                    $this->session->logout();
                }
            }
        }

        return $this->currentUser;
    }

    // Page réservée aux personnes connectées : sinon, direction la connexion.
    protected function requireLogin(): User {
        $user = $this->getCurrentUser();

        if ($user === null) {
            $this->session->setFlash('Connecte-toi pour accéder à cette page.');
            $this->redirect('login.php');
        }

        return $user;
    }

    protected function isPost(): bool {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    // Champ caché à mettre dans chaque formulaire.
    protected function csrfField(): string {
        $token = $this->session->getCsrfToken();

        return '<input type="hidden" name="csrf_token" value="' . $token . '">';
    }

    // Refuse un formulaire envoyé depuis un autre site.
    protected function checkCsrf(): void {
        if (!$this->session->isValidCsrfToken($_POST['csrf_token'] ?? '')) {
            $this->showError(400, 'Le formulaire a expiré. Recharge la page et réessaie.');
        }
    }

    // Adresse complète du site
    protected function getBaseUrl(): string {
        $https = ($_SERVER['HTTPS'] ?? '') === 'on'
            || ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https';
        $scheme = $https ? 'https' : 'http';
        $folder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        return $scheme . '://' . $_SERVER['HTTP_HOST'] . $folder;
    }

    protected function redirect(string $url): never {
        header("Location: $url");
        exit;
    }

    protected function showError(int $statusCode, string $message): never {
        (new ErrorPage($this->session, $statusCode, $message))->render();
        exit;
    }

    // Protège contre les failles XSS : à utiliser pour TOUT texte affiché.
    protected function escape(?string $text): string {
        return htmlspecialchars($text ?? '', ENT_QUOTES, 'UTF-8');
    }
}
