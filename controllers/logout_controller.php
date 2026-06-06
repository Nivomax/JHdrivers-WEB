<?php

session_start();
session_destroy();

$is_ajax = ($_SERVER["HTTP_X_REQUESTED_WITH"] ?? "") === "XMLHttpRequest";

if ($is_ajax) {
    header("Content-Type: application/json");
    echo json_encode(["success" => true]);
    exit;
}

header("Location: ../index.php?view=login");
exit;
