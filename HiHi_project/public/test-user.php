<?php
require_once '../src/UserManager.php';

$manager = new UserManager();


$user = new User('testeur', 'test@mail.ch', password_hash('1234', PASSWORD_DEFAULT));
$newId = $manager->add($user);
echo "Utilisateur créé avec l'id $newId<br>";


$found = $manager->findByEmail('test@mail.ch');
echo 'Trouvé : ' . $found->getPseudo() . '<br>';
echo 'Test fait ? ' . ($found->hasTakenTest() ? 'oui' : 'non');
