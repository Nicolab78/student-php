<?php

require_once 'BaseUser.php';

class StudentUser extends BaseUser {
    
    public function getRole() {
        return 'student';
    }
    
    public function getPermissions() {
        return [
            'view_students',
            'view_promotions'
        ];
    }
    
    public function canAccess($resource) {
        $allowedResources = [
            'home',
            'students',
            'student-show',
            'promotions',
            'promotion-show'
        ];
        return in_array($resource, $allowedResources);
    }
    
    public function canEditStudent($studentId) {
        return false;
    }
    
    public function canCreateStudent() {
        return false;
    }
    
    public function canDeleteStudent() {
        return false;
    }
    
    public function canEditPromotion() {
        return false;
    }
    
    public function canCreatePromotion() {
        return false;
    }
    
    public function canViewStudents() {
        return true;
    }
    
    public function canViewPromotions() {
        return true;
    }
}