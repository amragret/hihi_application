<?php

namespace Pages;

use Auth\Session;

class HomePage extends Page {
    public function __construct(Session $session) {
        parent::__construct($session, 'Accueil');
    }

    protected function handleRequest(): void {

        $user = $this->getCurrentUser();

        if ($user !== null && $user->hasTakenTest()) {
            $this->redirect('result.php');
        }
    }

    protected function renderContent(): string {

        $testUrl = $this->getCurrentUser() !== null ? 'test.php' : 'signup.php?next=test';

        return <<<HTML
        <section class="hero">
            <h1>Quelle HiHi someille en toi ?</h1>
            <p>Née de MOTHER et de la Lune, chaque HiHi porte une part de nous :
               la sagesse, l'altruisme, l'espièglerie ou la passion.
               Réponds à 9 questions pour découvrir la tienne.</p>
            <a href="{$testUrl}" class="btn btn-primary">Faire le test</a>
        </section>
        HTML;
    }
}
