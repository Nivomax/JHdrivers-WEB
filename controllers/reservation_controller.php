<?php

require_once __DIR__ . "/../models/reservation.php";

$is_ajax = ($_SERVER["HTTP_X_REQUESTED_WITH"] ?? "") === "XMLHttpRequest";

function json_response($payload)
{
    header("Content-Type: application/json");
    echo json_encode($payload);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../index.php?view=reservation");
    exit;
}

$nom = $_POST["nom_client"];
$email = $_POST["email_client"];
$telephone = $_POST["telephone"];
$depart = $_POST["adresse_depart"];
$arrivee = $_POST["adresse_arrivee"];
$date = $_POST["date_course"];
$heure = $_POST["heure_course"];

$success = creer_reservation($nom, $email, $telephone, $depart, $arrivee, $date, $heure);

if ($is_ajax) {
    json_response(["success" => $success]);
}

header("Location: ../index.php?view=reservation&reservation=success");
exit;
