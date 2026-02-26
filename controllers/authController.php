<?php
class AuthController {
    public function login() {
        if (isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=admin');
            exit;
        }

        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            $user = User::authenticate($username, $password);
            
            if ($user) {
                $_SESSION['user_id'] = $user->id;
                $_SESSION['username'] = $user->username;
                $_SESSION['role'] = $user->role;
                
                header('Location: index.php?controller=admin&action=index');
                exit;
            } else {
                $error = 'Neplatné uživatelské jméno nebo heslo.';
            }
        }

        $categories = Category::getAll();
        $viewContent = 'views/login.php';
        require 'views/layout.php';
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit;
    }
}