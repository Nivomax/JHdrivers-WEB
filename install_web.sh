#!/bin/bash
set -e

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
cd "$SCRIPT_DIR"

DB_NAME="${DB_NAME:-jhdrivers-e6}"
DB_USER="${DB_USER:-jhdrivers}"
DB_PASS="${DB_PASS:-jhdrivers_password}"
DB_HOST="${DB_HOST:-localhost}"
DB_PORT="${DB_PORT:-3306}"
APP_HOST="${APP_HOST:-0.0.0.0}"
APP_PORT="${APP_PORT:-8000}"

echo "Installation des dependances web..."
sudo apt update
sudo apt install -y php php-cli php-mysql mariadb-server

echo "Demarrage de MariaDB..."
sudo systemctl enable mariadb
sudo systemctl start mariadb

echo "Creation de la base et de l'utilisateur..."
sudo mysql <<SQL
CREATE DATABASE IF NOT EXISTS \`$DB_NAME\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS '$DB_USER'@'localhost' IDENTIFIED BY '$DB_PASS';
GRANT ALL PRIVILEGES ON \`$DB_NAME\`.* TO '$DB_USER'@'localhost';
FLUSH PRIVILEGES;
SQL

echo "Import du schema SQL..."
mysql -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" < database/schema.sql

echo "Generation de config/database.php..."
mkdir -p config
cat > config/database.php <<'PHP'
<?php

$host = getenv('DB_HOST') ?: 'localhost';
$port = getenv('DB_PORT') ?: '3306';
$dbname = getenv('DB_NAME') ?: 'jhdrivers-e6';
$username = getenv('DB_USER') ?: 'jhdrivers';
$password = getenv('DB_PASS') ?: 'jhdrivers_password';

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
PHP

echo
echo "Installation web terminee."
echo "Base : $DB_NAME"
echo "Utilisateur : $DB_USER"
echo "Hote BDD : $DB_HOST:$DB_PORT"
echo "Pour lancer le site :"
echo "php -S $APP_HOST:$APP_PORT"
