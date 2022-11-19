<?php

class User {

    public $id;
    public $name;
    public $lastname;
    public $email;
    public $password;
    public $cadastro_cpf;
    public $token;

    public function generateToken(){
        return bin2hex(random_bytes(50));
    }
}

interface UserDAOInterface {

    public function bildUser($data);
    public function create(User $user, $authUser = false);
    public function update(User $user);
    public function verifyToken($protected = false);
    public function setTokenToSession($token, $redirect = true);
    public function authenticateUser($email, $password);
    public function findByToken($token);
    public function findByEmail($email);
    public function findById($id);
    public function changePassword(User $user);
    public function getUsers();
    public function getUserById($id);
}