<?php

require_once __DIR__ . "/../config/database.php";

function creer_reservation($nom, $email, $telephone, $depart, $arrivee, $date, $heure)
{
    global $pdo;

    $sql = "INSERT INTO reservations
            (nom_client, email_client, telephone, adresse_depart, adresse_arrivee, date_course, heure_course)
            VALUES
            (:nom, :email, :telephone, :depart, :arrivee, :date_course, :heure_course)";

    $stmt = $pdo->prepare($sql);

    return $stmt->execute([
        ":nom" => $nom,
        ":email" => $email,
        ":telephone" => $telephone,
        ":depart" => $depart,
        ":arrivee" => $arrivee,
        ":date_course" => $date,
        ":heure_course" => $heure
    ]);
}

function lister_courses_client($email)
{
    global $pdo;

    $sql = "SELECT
                r.id,
                r.nom_client,
                r.email_client,
                r.telephone,
                r.adresse_depart,
                r.adresse_arrivee,
                r.date_course,
                r.heure_course,
                r.statut,
                c.nom AS chauffeur_nom
            FROM reservations r
            LEFT JOIN affectations a ON a.reservation_id = r.id
            LEFT JOIN chauffeurs c ON c.id = a.chauffeur_id
            WHERE r.email_client = :email
            ORDER BY r.date_course DESC, r.heure_course DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ":email" => $email
    ]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
