<?php

// Charge automatiquement une classe la première fois qu'on l'utilise.
// Exemple : Users\UsersManager -> src/classes/Users/UsersManager.php
spl_autoload_register(function (string $className): void {
    $path = __DIR__ . '/../classes/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($path)) {
        require_once $path;
    }
});
