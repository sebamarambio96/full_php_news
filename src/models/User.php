<?php
require_once './src/models/Model.php';

class User extends Model
{
    public function getUserById($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE id = :id LIMIT 1");
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByUsername($username)
    {
        $query = "SELECT * FROM usuarios WHERE username = :username LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($username, $allName, $email, $password, $fechaNacimiento)
    {
        $stmt = $this->db->prepare("INSERT INTO usuarios (username, nombre_completo, email, password, fecha_nacimiento) 
        VALUES (:username, :all_name, :email, :password, :fecha_nacimiento)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':all_name', $allName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':fecha_nacimiento', $fechaNacimiento);
        return $stmt->execute();
    }
}
