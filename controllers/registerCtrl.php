<?php
  require __DIR__ . '/../src/auth.php';

    $auth = new Auth();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordRepeat = $_POST['confirm_password'];

        try {
            if ($auth->register($username, $email, $password, $passwordRepeat)) {
                echo json_encode(['success' => true, 'redirect' => '/login']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }