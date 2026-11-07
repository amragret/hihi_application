<?php

class Database {

    public function connect(): PDO {

        $config = parse_ini_file(__DIR__ . '/config/database.ini', true);

        if (!$config) {
            throw new Exception("Erreur lors de la lecture du fichier de configuration");
        }

        $host = $config['host'];
        $port = $config['port'];
        $database = $config['database'];
        $username = $config['username'];
        $password = $config['password'];

        $dsn = "mysql:host=$host;port=$port;dbname=$database;charset=utf8mb4";

        return new PDO($dsn, $username, $password);
    }
}
