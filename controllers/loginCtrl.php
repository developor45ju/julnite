<?php
    require __DIR__ . '/../src/auth.php';
    $auth = new Auth();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        try {
            if ($auth->login($username, $password)) {
                echo json_encode(['success' => true, 'redirect' => '/']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }