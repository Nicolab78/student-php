<?php

abstract class BaseUser {
    protected $id;
    protected $username;
    protected $email;
    protected $password_hash;
    protected $created_at;
    
    public function __construct($username = '', $email = '', $password_hash = '') {
        $this->username = $username;
        $this->email = $email;
        $this->password_hash = $password_hash;
    }
    
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }
    
    public function getUsername() { return $this->username; }
    public function setUsername($username) { $this->username = $username; }
    
    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; }
    
    public function getPasswordHash() { return $this->password_hash; }
    public function setPasswordHash($hash) { $this->password_hash = $hash; }
    
    abstract public function getRole();
    abstract public function getPermissions();
    abstract public function canAccess($resource);
    
    public function verifyPassword($password) {
        return password_verify($password, $this->password_hash);
    }
    
    public function hashPassword($password) {
        $this->password_hash = password_hash($password, PASSWORD_DEFAULT);
    }
}