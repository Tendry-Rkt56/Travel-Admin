<?php

namespace App\Entity;

use App\Trait\ImageRegister;

class User extends Entity
{

     use ImageRegister;

     public function insert (array $data = [])
     {
          $sql = "INSERT INTO users(nom, prenom, email, passwords, codes) VALUES (:nom, :prenom, :email, :passwords, :codes)";
          $result = $this->db->getConn()->prepare($sql);
          $result->bindValue(":nom", $data['nom'], \PDO::PARAM_STR);
          $result->bindValue(":prenom", $data['prenom'], \PDO::PARAM_STR);
          $result->bindValue(":email", $data['email'], \PDO::PARAM_STR);
          $result->bindValue(":passwords", password_hash($data['passwords'], PASSWORD_DEFAULT), \PDO::PARAM_STR);
          $result->bindValue(":codes", random_int(111111, 999999));
          $state = $result->execute();
          $lastUser = $this->db->getConn()->lastInsertId();
          $_SESSION['user'] = $this->get($lastUser);
          $_SESSION['id'] = $lastUser;
          return $state;
     }

     public function get (int $id)
     {
          $sql = "SELECT * FROM users WHERE id = $id";
          return $this->db->getConn()->query($sql)->fetch(\PDO::FETCH_OBJ);
     }

     public function confirmation (array $data = [])
     {
          $id = $data['id'];
          if ($this->get($id)->codes == $data['codes']) {
               $sql = "UPDATE users SET state = :state WHERE id = :id";
               $result = $this->db->getConn()->prepare($sql);
               $result->bindValue(":state", 1);
               $result->bindValue(":id", $id);
               return $result->execute();
          }
          return false;
     }

     public function register (array $data = [], array $files = [])
     {
          $sql = "INSERT INTO users(nom, prenom, email, image, passwords) VALUES (:nom, :prenom, :email, :image, :passwords)";
          $query = $this->db->getConn()->prepare($sql);
          extract($data);
          $query->bindValue(':nom', $nom, \PDO::PARAM_STR);
          $query->bindValue(':prenom', $prenom, \PDO::PARAM_STR);
          $query->bindValue(':email', $email, \PDO::PARAM_STR);
          $query->bindValue(':image', $this->checkImage($files['image'], "images/users/"), \PDO::PARAM_STR);
          $query->bindValue(':passwords', password_hash($passwords, PASSWORD_DEFAULT), \PDO::PARAM_STR);
          return $query->execute();
     }

     public function login (array $data = [])
     {
          $sql = "SELECT * FROM users WHERE email = '$data[email]'";
          $user = $this->db->getConn()->query($sql)->fetch(\PDO::FETCH_OBJ);
          if ($user && password_verify($data['passwords'], $user->passwords)) {
               $_SESSION['user'] = $user;
               return true;
          }
          $_SESSION['email'] = $data['email'];
          $_SESSION['error'] = "Identifiants incorrects";
          return false;
     }

}