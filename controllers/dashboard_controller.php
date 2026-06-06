<?php

require_once __DIR__ . "/../models/user.php";
require_once __DIR__ . "/../models/reservation.php";

$client = client_connecte();
$courses = $client ? lister_courses_client($client["email"]) : [];

function h($valeur)
{
    return htmlspecialchars((string) $valeur, ENT_QUOTES, "UTF-8");
}

function status_class($statut)
{
    $normalized = strtolower(trim((string) $statut));
    $normalized = str_replace(
        ["é", "è", "ê", "ë", "à", "â", "î", "ï", "ô", "ù", "û", "ç"],
        ["e", "e", "e", "e", "a", "a", "i", "i", "o", "u", "u", "c"],
        $normalized
    );

    if ($normalized === "en attente") {
        return "status-pending";
    }

    if (str_starts_with($normalized, "annul")) {
        return "status-cancelled";
    }

    if (str_starts_with($normalized, "confirm")) {
        return "status-confirmed";
    }

    if (str_starts_with($normalized, "termin")) {
        return "status-completed";
    }

    return "";
}
