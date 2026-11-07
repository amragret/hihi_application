<?php
session_start();
require_once '../src/UserManager.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $pseudo = $_POST["pseudo"];
    $email = $_POST["email"];
    $password = $_POST["password"];


    if (empty($pseudo) || strlen($pseudo) < 2 || strlen($pseudo) > 50) {
        $errors[] = "Le pseudo doit contenir entre 2 et 50 caractères.";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Un e-mail valide est requis.";
    }

    if (empty($password) || strlen($password) < 8) {
        $errors[] = "Le mot de passe doit contenir au moins 8 caractères.";
    }


    if (empty($errors)) {
        try {
            $user = new User($pseudo, $email, password_hash($password, PASSWORD_DEFAULT));

            $manager = new UserManager();
            $newId = $manager->add($user);


            $_SESSION['user_id'] = $newId;
            header("Location: test.php");
            exit();
        } catch (PDOException $e) {
            if ($e->getCode() === "23000") {
                $errors[] = "Ce pseudo ou cet e-mail est déjà utilisé.";
            } else {
                $errors[] = "Erreur lors de l'interaction avec la base de données : " . $e->getMessage();
            }
        }
    }
}

$title = 'Créer un compte';
require 'includes/header.php';
?>

<h1>Créer un compte</h1>

<?php if (!empty($errors)) { ?>
    <ul class="errors">
        <?php foreach ($errors as $error) { ?>
            <li><?= $error ?></li>
        <?php } ?>
    </ul>
<?php } ?>

<form action="signup.php" method="POST">
    <label for="pseudo">Pseudo</label>
    <input type="text" id="pseudo" name="pseudo"
        value="<?= htmlspecialchars($pseudo ?? '') ?>" required minlength="2" maxlength="50">

    <label for="email">E-mail</label>
    <input type="email" id="email" name="email"
        value="<?= htmlspecialchars($email ?? '') ?>" required>

    <label for="password">Mot de passe</label>
    <input type="password" id="password" name="password" required minlength="8">

    <button type="submit">Créer mon compte</button>
</form>

<p>Déjà un compte ? <a href="login.php">Se connecter</a></p>

<?php require 'includes/footer.php'; ?>
