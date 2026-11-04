<?php

namespace Pages;

use Auth\Session;
use Users\User;
use Users\UsersManager;


class RegisterPage extends Page {
    private array $errors = [];
    private string $pseudo = '';
    private string $email = '';

    public function __construct(Session $session) {
        parent::__construct($session, 'Créer un compte');
    }

    protected function handleRequest(): void {
        if ($this->getCurrentUser() !== null) {
            $this->redirect('index.php');
        }

        if (!$this->isPost()) {
            return;
        }

        $this->checkCsrf();

        $this->pseudo = trim($_POST['pseudo'] ?? '');
        $this->email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $passwordConfirm = $_POST['password_confirm'] ?? '';

        $usersManager = new UsersManager();
        $this->validate($usersManager, $password, $passwordConfirm);

        if ($this->errors !== []) {
            return;
        }

        $user = new User(null, $this->pseudo, $this->email, password_hash($password, PASSWORD_DEFAULT));
        $userId = $usersManager->createUser($user);

        $this->session->login($userId);
        $this->session->setFlash('Bienvenue ' . $this->pseudo . ' !');

        $this->redirect($this->wantsTest() ? 'test.php' : 'index.php');
    }

    private function validate(UsersManager $usersManager, string $password, string $passwordConfirm): void {
        $length = mb_strlen($this->pseudo);

        if ($length < 3 || $length > 50) {
            $this->errors[] = 'Le pseudo doit contenir entre 3 et 50 caractères.';
        } elseif ($usersManager->pseudoExists($this->pseudo)) {
            $this->errors[] = 'Ce pseudo est déjà pris.';
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "L'adresse e-mail n'est pas valide.";
        } elseif ($usersManager->emailExists($this->email)) {
            $this->errors[] = 'Un compte existe déjà avec cette adresse e-mail.';
        }

        if (strlen($password) < 8) {
            $this->errors[] = 'Le mot de passe doit contenir au moins 8 caractères.';
        } elseif ($password !== $passwordConfirm) {
            $this->errors[] = 'Les deux mots de passe ne sont pas identiques.';
        }
    }


    private function wantsTest(): bool {
        return ($_GET['next'] ?? '') === 'test';
    }

    protected function renderContent(): string {
        $errors = '';
        foreach ($this->errors as $error) {
            $errors .= '<li>' . $this->escape($error) . '</li>';
        }
        $errorsHtml = $errors !== '' ? "<ul class=\"errors\">$errors</ul>" : '';

        $pseudo = $this->escape($this->pseudo);
        $email = $this->escape($this->email);
        $csrf = $this->csrfField();
        $next = $this->wantsTest() ? '?next=test' : '';

        return <<<HTML
        <section class="panel">
            <h1>Créer un compte</h1>
            <p>Ton compte garde ta HiHi en mémoire.</p>
            {$errorsHtml}
            <form method="post" action="signup.php{$next}" class="form">
                {$csrf}
                <label>Pseudo
                    <input type="text" name="pseudo" value="{$pseudo}" required minlength="3" maxlength="50">
                </label>
                <label>E-mail
                    <input type="email" name="email" value="{$email}" required>
                </label>
                <label>Mot de passe (8 caractères minimum)
                    <input type="password" name="password" required minlength="8">
                </label>
                <label>Confirme le mot de passe
                    <input type="password" name="password_confirm" required minlength="8">
                </label>
                <button type="submit" class="btn btn-primary">Créer mon compte</button>
            </form>
            <p>Déjà un compte ? <a href="login.php{$next}">Se connecter</a></p>
        </section>
        HTML;
    }
}
