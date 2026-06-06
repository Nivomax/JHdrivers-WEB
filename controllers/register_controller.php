<?php

require_once __DIR__ . "/../models/user.php";

$is_ajax = ($_SERVER["HTTP_X_REQUESTED_WITH"] ?? "") === "XMLHttpRequest";

function json_response($payload)
{
    header("Content-Type: application/json");
    echo json_encode($payload);
    exit;
}

if (client_connecte()) {
    if ($is_ajax) {
        json_response(["success" => true]);
    }

    header("Location: ../index.php?view=account");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../index.php?view=register");
    exit;
}

$prenom = $_POST["prenom"] ?? "";
$nom = $_POST["nom"] ?? "";
$email = $_POST["email"] ?? "";
$telephone = $_POST["telephone"] ?? "";
$mot_de_passe = $_POST["mot_de_passe"] ?? "";

if (creer_client($prenom, $nom, $email, $telephone, $mot_de_passe)) {
    connecter_client($email, $mot_de_passe);

    if ($is_ajax) {
        json_response(["success" => true]);
    }

    header("Location: ../index.php?view=account");
    exit;
}

if ($is_ajax) {
    json_response([
        "success" => false,
        "message" => "Un compte existe déjà avec cet email."
    ]);
}

header("Location: ../index.php?view=register&register=exists");
exit;
