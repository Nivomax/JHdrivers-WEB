<?php

$host = getenv('DB_HOST') ?: 'mysql-jhdrivers.alwaysdata.net';
$port = getenv('DB_PORT') ?: '3306';
$dbname = getenv('DB_NAME') ?: 'jhdrivers_e6';
$username = getenv('DB_USER') ?: 'jhdrivers_max';
$password = getenv('DB_PASS') ?: 'Maxime94400';

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}