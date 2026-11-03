<?php

// Gère la connexion à la base de données.
// Une seule connexion PDO est créée, puis partagée par toute l'application.
class Database {
    private const CONFIG_FILE = __DIR__ . '/../config/database.ini';

    private static ?PDO $pdo = null;

    public static function getPdo(): PDO {
        if (self::$pdo === null) {
            $config = parse_ini_file(self::CONFIG_FILE);

            if ($config === false) {
                throw new RuntimeException('Fichier de configuration introuvable : ' . self::CONFIG_FILE);
            }

            $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['database']};charset=utf8mb4";

            self::$pdo = new PDO($dsn, $config['username'], $config['password'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        }

        return self::$pdo;
    }
}
