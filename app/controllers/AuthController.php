<?php

require_once '../app/services/AuthManager.php';

class AuthController {

    public function login() {
        if (AuthManager::isLoggedIn()) {
            header('Location: ?page=home');
            exit;
        }
        
        include '../app/views/auth/login.php';
    }

    public function authenticate() {
        try {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            if (empty($username) || empty($password)) {
                throw new Exception("Nom d'utilisateur et mot de passe requis");
            }
            
            if (AuthManager::login($username, $password)) {

                AuthManager::redirectAfterLogin();
            } else {
                throw new Exception("Nom d'utilisateur ou mot de passe incorrect");
            }
            
        } catch (Exception $e) {
            $error = $e->getMessage();
            include '../app/views/auth/login.php';
        }
    }

    public function register() {
    include '../app/views/auth/register.php';
}

public function handleRegister() {
    try {
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $role = $_POST['role'] ?? '';

        $userData = [
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'role' => $role
        ];

        $errors = UserFactory::validateUserData($userData);

        if (!empty($errors)) {
            throw new Exception(implode('<br>', $errors));
        }

        AuthManager::register($username, $email, $password, $role);

        // Redirection vers login après inscription
        header('Location: ?page=login');
        exit;

    } catch (Exception $e) {
        $error = $e->getMessage();
        include '../app/views/auth/register.php';
    }
}

    public function logout() {
        AuthManager::logout();
    }

    public function unauthorized() {
        include '../app/views/auth/unauthorized.php';
    }
}