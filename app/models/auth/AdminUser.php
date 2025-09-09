<?php

require_once 'BaseUser.php';

class AdminUser extends BaseUser {
    
    public function getRole() {
        return 'admin';
    }
    
    public function getPermissions() {
        return [
            'manage_students',
            'manage_promotions', 
            'manage_users',
            'view_all_data',
            'delete_all',
            'system_settings'
        ];
    }
    
    public function canAccess($resource) {
        return true; 
    }
    
    public function canManageUsers() {
        return true;
    }
    
    public function canDeleteAnything() {
        return true;
    }
}