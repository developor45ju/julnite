<?php
session_start();
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Julnite</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <header>
        <h1>Julnite</h1>
        <nav>
            <?php
                require __DIR__ . '/../../../src/auth.php';
                $auth = new Auth();
                if (!$auth->isLoggedIn()) : ?>
                <a href="/register">Inscription</a>
                <a href="/login">Connexion</a>
            <?php else : ?>
                <a href="/dashboard"><?= $_SESSION['username']; ?></a>
                <a href="/logout">Déconnexion</a>
                <script>
                    const logout = document.querySelector('a[href="/logout"]');
                    console.log(logout);
                    logout.addEventListener('click', (e) => {
                        e.preventDefault();
                        fetch('/controllers/logoutCtrl.php')
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    window.location.href = '/login'; // Rediriger vers la page de connexion
                                } else {
                                    alert("Erreur lors de la déconnexion"); // Gérer les erreurs de déconnexion
                                }
                            })
                            .catch(error => {
                                console.error('Erreur de requête fetch:', error);
                                alert("Une erreur est survenue. Veuillez réessayer."); // Gérer les erreurs de requête fetch
                            });
                    })
                </script>
            <?php endif; ?>
        </nav>
    </header>