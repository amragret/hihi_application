<?php
session_start();
require_once '../src/UserManager.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];


    if (empty($email) || empty($password)) {
        $errors[] = "Merci de remplir tous les champs.";
    }

    if (empty($errors)) {
        $manager = new UserManager();
        $user = $manager->findByEmail($email);

        if ($user !== null && password_verify($password, $user->getPassword())) {
            $_SESSION['user_id'] = $user->getId();

            if ($user->hasTakenTest()) {
                header("Location: result.php");
            } else {
                header("Location: test.php");
            }
            exit();
        } else {
            $errors[] = "E-mail ou mot de passe incorrect.";
        }
    }
}

$title = 'Se connecter';
require 'includes/header.php';
?>

<h1>Se connecter</h1>

<?php if (!empty($errors)) { ?>
    <ul class="errors">
        <?php foreach ($errors as $error) { ?>
            <li><?= htmlspecialchars($error) ?></li>
        <?php } ?>
    </ul>
<?php } ?>

<form action="login.php" method="POST">
    <label for="email">E-mail</label>
    <input type="email" id="email" name="email"
        value="<?= htmlspecialchars($email ?? '') ?>" required>

    <label for="password">Mot de passe</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Se connecter</button>
</form>

<p>Pas encore de compte ? <a href="signup.php">Créer un compte</a></p>

<?php require 'includes/footer.php'; ?>
