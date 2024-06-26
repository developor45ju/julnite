<?php
    require_once __DIR__ . "/../config.php";

    class Auth {
        private $pdo;

        public function __construct() {
            global $pdo;
            $this->pdo = $pdo;
        }

        public function register($username, $email, $password, $password_confirmation) : bool
        {
            // Validation des données
            if ($password !== $password_confirmation) {
                throw new Exception("Les mots de passe ne correspondent pas.");
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("L'adresse e-mail n'est pas valide.");
            }

            // Vérification de l'unicité du nom d'utilisateur et de l'email
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username OR email = :email");
            $stmt->execute(['username' => $username, 'email' => $email]);
            if ($stmt->fetchColumn() > 0) {
                throw new Exception("Le nom d'utilisateur ou l'adresse e-mail est déjà utilisé.");
            }

            // Hachage du mot de passe
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insertion de l'utilisateur dans la base de données (requête préparée)
            $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
            $success = $stmt->execute(['username' => $username, 'email' => $email, 'password' => $hashedPassword]);

            return $success; // Retourne true si l'inscription a réussi, false sinon
        }


        public function login($username, $password) : bool
        {
            // Récupération de l'utilisateur par son nom d'utilisateur
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch();

            // Vérification si l'utilisateur existe et si le mot de passe est correct
            if (!$user || !password_verify($password, $user['password'])) {
                throw new Exception("Le nom d'utilisateur ou le mot de passe est incorrect.");
            }

            // Démarrage de la session et enregistrement de l'ID utilisateur
            session_start();
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];
            return true; // Connexion réussie
        }

        public function isLoggedIn(): bool
        {
            return isset($_SESSION['user_id']);
        }

        public function logout() {
            session_destroy();
        }
    }