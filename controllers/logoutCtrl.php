<?php
session_start();
require __DIR__ . '/../src/auth.php';

$auth = new Auth();
if ($auth->isLoggedIn()) {
    $auth->logout();
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, "message" => "Vous n'êtes pas connecté"]);
}