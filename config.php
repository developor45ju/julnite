<?php
    $pdo = new PDO('mysql:host=localhost;dbname=julnite', 'julien', 'root', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
