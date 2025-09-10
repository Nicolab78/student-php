<?php

require_once 'BaseUser.php';

class TeacherUser extends BaseUser {
    
    private $assigned_promotion_id;
    
    public function getRole() {
        return 'teacher';
    }
    
    public function getPermissions() {
        return [
            'manage_students',
            'manage_assigned_promotion',
            'view_all_data'
        ];
    }
    
    public function canAccess($resource) {
        $allowedResources = [
            'home',
            'students', 
            'student-create', 
            'student-edit', 
            'student-show',
            'student-store',
            'student-update',
            'student-delete',
            'promotions', 
            'promotion-show',
            'promotion-edit'
        ];
        return in_array($resource, $allowedResources);
    }
    
    public function canEditStudent($studentId) {
        return true;
    }
    
    public function canEditPromotion($promotionId) {
        return $this->assigned_promotion_id == $promotionId;
    }
    
    public function canCreatePromotion() {
        return false;
    }
    
    public function canDeletePromotion($promotionId) {
        return false;
    }
    
    public function setAssignedPromotion($promotionId) {
        $this->assigned_promotion_id = $promotionId;
    }
    
    public function getAssignedPromotion() {
        return $this->assigned_promotion_id;
    }
    
    public function isAssignedToPromotion($promotionId) {
        return $this->assigned_promotion_id == $promotionId;
    }
}