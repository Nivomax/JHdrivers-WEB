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
    header("Location: ../index.php?view=login");
    exit;
}

$email = $_POST["email"] ?? "";
$mot_de_passe = $_POST["mot_de_passe"] ?? "";

if (connecter_client($email, $mot_de_passe)) {
    if ($is_ajax) {
        json_response(["success" => true]);
    }

    header("Location: ../index.php?view=account");
    exit;
}

if ($is_ajax) {
    json_response([
        "success" => false,
        "message" => "Email ou mot de passe incorrect."
    ]);
}

header("Location: ../index.php?view=login&login=error");
exit;
