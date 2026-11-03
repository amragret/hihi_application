<?php

namespace Pages;

use Auth\Session;

// Page d'erreur (404, 500...). Elle n'utilise pas la base de données,
// pour pouvoir s'afficher même quand la base est en panne.
class ErrorPage extends Page {
    public function __construct(
        Session $session,
        private int $statusCode,
        private string $message,
    ) {
        parent::__construct($session, 'Erreur');
    }

    protected function handleRequest(): void {
        http_response_code($this->statusCode);
    }

    protected function renderContent(): string {
        $message = $this->escape($this->message);

        return <<<HTML
        <section class="panel">
            <h1>Oups…</h1>
            <p>{$message}</p>
            <a href="index.php" class="btn btn-primary">Retour à l'accueil</a>
        </section>
        HTML;
    }
}
