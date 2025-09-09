<?php

require_once '../app/dao/UserDAO.php';
require_once '../app/models/auth/UserFactory.php';

class AuthManager {
    
    private static $currentUser = null;

    public static function login($username, $password) {
        $userDAO = new UserDAO();
        
        $userData = $userDAO->findByUsername($username);
        if (!$userData) {
            return false;
        }
        
        $user = UserFactory::createUser($userData);
        
        if ($user->verifyPassword($password)) {
            $_SESSION['user_id'] = $user->getId();
            $_SESSION['user_role'] = $user->getRole();
            $_SESSION['username'] = $user->getUsername();
            self::$currentUser = $user;
            return true;
        }
        
        return false;
    }


    public static function register($username, $email, $password, $role) {
    $userDAO = new UserDAO();

    if ($userDAO->usernameExists($username)) {
        throw new Exception("Nom d'utilisateur déjà utilisé");
    }

    if ($userDAO->emailExists($email)) {
        throw new Exception("Email déjà utilisé");
    }

    $user = UserFactory::createNewUser($role, $username, $email, $password);

    $userData = [
        'username' => $user->getUsername(),
        'email' => $user->getEmail(),
        'password_hash' => $user->getPasswordHash(),
        'role' => $user->getRole(),
        'assigned_promotion_id' => null
    ];

    return $userDAO->create($userData);
}



    public static function logout() {
        session_destroy();
        self::$currentUser = null;
        
        header('Location: ?page=login');
        exit;
    }

    public static function getCurrentUser() {
        if (self::$currentUser === null && isset($_SESSION['user_id'])) {
            $userDAO = new UserDAO();
            $userData = $userDAO->findById($_SESSION['user_id']);
            
            if ($userData) {
                self::$currentUser = UserFactory::createUser($userData);
            }
        }
        
        return self::$currentUser;
    }

    public static function isLoggedIn() {
        return isset($_SESSION['user_id']) && self::getCurrentUser() !== null;
    }

    public static function requireAuth() {
        if (!self::isLoggedIn()) {
            $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
            header('Location: ?page=login');
            exit;
        }
    }

    public static function requireRole($role) {
        self::requireAuth();
        
        $user = self::getCurrentUser();
        if (!$user || $user->getRole() !== $role) {
            header('Location: ?page=unauthorized');
            exit;
        }
    }

    public static function requireRoles($roles) {
        self::requireAuth();
        
        $user = self::getCurrentUser();
        if (!$user || !in_array($user->getRole(), $roles)) {
            header('Location: ?page=unauthorized');
            exit;
        }
    }

    public static function canAccess($resource) {
        $user = self::getCurrentUser();
        return $user ? $user->canAccess($resource) : false;
    }

    public static function hasRole($role) {
        $user = self::getCurrentUser();
        return $user ? $user->getRole() === $role : false;
    }

    public static function isAdmin() {
        return self::hasRole('admin');
    }

    public static function isTeacher() {
        return self::hasRole('teacher');
    }

    public static function isStudent() {
        return self::hasRole('student');
    }

    public static function redirectAfterLogin() {
        // Si il y avait une redirection prévue
        if (isset($_SESSION['redirect_after_login'])) {
            $redirect = $_SESSION['redirect_after_login'];
            unset($_SESSION['redirect_after_login']);
            header('Location: ' . $redirect);
            exit;
        }
        
        header('Location: ?page=home');
        exit;
    }
}