<?php

require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/session.php";

function chercher_client_par_email($email)
{
    global $pdo;

    $sql = "SELECT id, prenom, nom, email, telephone, mot_de_passe
            FROM clients
            WHERE email = :email";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ":email" => $email
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function connecter_client($email, $mot_de_passe)
{
    $client = chercher_client_par_email($email);

    if (!$client) {
        return false;
    }

    if ($client["mot_de_passe"] !== $mot_de_passe) {
        return false;
    }

    unset($client["mot_de_passe"]);

    demarrer_session();
    $_SESSION["client"] = $client;

    return true;
}

function creer_client($prenom, $nom, $email, $telephone, $mot_de_passe)
{
    global $pdo;

    if (chercher_client_par_email($email)) {
        return false;
    }

    $sql = "INSERT INTO clients (prenom, nom, email, telephone, mot_de_passe)
            VALUES (:prenom, :nom, :email, :telephone, :mot_de_passe)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ":prenom" => $prenom,
        ":nom" => $nom,
        ":email" => $email,
        ":telephone" => $telephone,
        ":mot_de_passe" => $mot_de_passe
    ]);

    return true;
}

function client_connecte()
{
    demarrer_session();

    return $_SESSION["client"] ?? null;
}
