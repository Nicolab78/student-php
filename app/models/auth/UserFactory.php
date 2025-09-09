<?php

require_once __DIR__ . '/BaseUser.php';
require_once __DIR__ . '/AdminUser.php';
require_once __DIR__ . '/TeacherUser.php';
require_once __DIR__ . '/StudentUser.php';


class UserFactory {
    
    public static function createUser($userData) {
        switch ($userData['role']) {
            case 'admin':
                $user = new AdminUser($userData['username'], $userData['email'], $userData['password_hash']);
                break;
                
            case 'teacher':
                $user = new TeacherUser($userData['username'], $userData['email'], $userData['password_hash']);
                
                if (isset($userData['assigned_promotion_id']) && $userData['assigned_promotion_id']) {
                    $user->setAssignedPromotion($userData['assigned_promotion_id']);
                }
                break;
                
            case 'student':
                $user = new StudentUser($userData['username'], $userData['email'], $userData['password_hash']);
                break;
                
            default:
                throw new Exception("Type d'utilisateur inconnu : " . $userData['role']);
        }
        
        $user->setId($userData['id']);
        return $user;
    }

    public static function createNewUser($role, $username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        switch ($role) {
            case 'admin':
                return new AdminUser($username, $email, $hashedPassword);
                
            case 'teacher':
                return new TeacherUser($username, $email, $hashedPassword);
                
            case 'student':
                return new StudentUser($username, $email, $hashedPassword);
                
            default:
                throw new Exception("Rôle invalide : " . $role);
        }
    }
    
    public static function validateUserData($userData) {
        $errors = [];
        
        if (empty($userData['username'])) {
            $errors[] = "Le nom d'utilisateur est requis";
        }
        
        if (empty($userData['email']) || !filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Un email valide est requis";
        }
        
        if (empty($userData['password']) || strlen($userData['password']) < 6) {
            $errors[] = "Le mot de passe doit faire au moins 6 caractères";
        }
        
        if (!in_array($userData['role'], ['admin', 'teacher', 'student'])) {
            $errors[] = "Rôle invalide";
        }
        
        return $errors;
    }
}