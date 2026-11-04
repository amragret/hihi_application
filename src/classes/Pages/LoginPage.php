<?php

namespace Pages;

use Auth\Session;
use Users\UsersManager;

class LoginPage extends Page {
    private ?string $error = null;
    private string $email = '';

    public function __construct(Session $session) {
        parent::__construct($session, 'Connexion');
    }

    protected function handleRequest(): void {
        if ($this->getCurrentUser() !== null) {
            $this->redirect('index.php');
        }

        if (!$this->isPost()) {
            return;
        }

        $this->checkCsrf();

        $this->email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = (new UsersManager())->getUserByEmail($this->email);


        if ($user === null || !$user->checkPassword($password)) {
            $this->error = 'E-mail ou mot de passe incorrect.';
            return;
        }

        $this->session->login($user->getId());

        if (($_GET['next'] ?? '') === 'test' || !$user->hasTakenTest()) {
            $this->redirect('test.php');
        }

        $this->redirect('result.php');
    }

    protected function renderContent(): string {
        $errorHtml = $this->error !== null
            ? '<ul class="errors"><li>' . $this->escape($this->error) . '</li></ul>'
            : '';
        $email = $this->escape($this->email);
        $csrf = $this->csrfField();
        $next = ($_GET['next'] ?? '') === 'test' ? '?next=test' : '';

        return <<<HTML
        <section class="panel">
            <h1>Se connecter</h1>
            {$errorHtml}
            <form method="post" action="login.php{$next}" class="form">
                {$csrf}
                <label>E-mail
                    <input type="email" name="email" value="{$email}" required>
                </label>
                <label>Mot de passe
                    <input type="password" name="password" required>
                </label>
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </form>
            <p>Pas encore de compte ? <a href="signup.php{$next}">Créer un compte</a></p>
        </section>
        HTML;
    }
}
