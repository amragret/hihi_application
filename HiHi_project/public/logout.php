<?php
session_start();

// Vide les données de la session
$_SESSION = [];

// Supprime la session sur le serveur
session_destroy();

// Retour à l'accueil
header("Location: index.php");
exit();
