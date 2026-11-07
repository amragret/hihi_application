<?php
require_once '../src/UserManager.php';

$manager = new UserManager();

// 1. Ajouter un utilisateur
$user = new User('testeur', 'test@mail.ch', password_hash('1234', PASSWORD_DEFAULT));
$newId = $manager->add($user);
echo "Utilisateur créé avec l'id $newId<br>";

// 2. Le retrouver par son e-mail
$found = $manager->findByEmail('test@mail.ch');
echo 'Trouvé : ' . $found->getPseudo() . '<br>';
echo 'Test fait ? ' . ($found->hasTakenTest() ? 'oui' : 'non');
