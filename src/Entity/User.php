<?php

namespace App\Entity;

use App\Trait\ImageRegister;

class User extends Entity
{

     use ImageRegister;

     public function getAll (array $data = [])
     {
          $query = "SELECT count(*) FROM users u WHERE u.id > 0";
          if (isset($data['search'])) {
               $search = $this->db->getConn()->quote('%'.$data['search'].'%');
               $query .= " AND (u.nom LIKE $search OR u.prenom LIKE $search OR u.email LIKE $search)";
          }
          $result = $this->db->getConn()->query($query);
          return $result->fetchColumn();
     }

     /**
      * Retourne toutes les lignes de publications en fonction des recherches
      * @param int $limit
      * @param int $offset
      * @param array $data
      * @return array
     */
     public function all (int $limit, int $offset, array $data = []): mixed
     {
          $query = "SELECT * FROM users AS u WHERE u.id > 0";
          if (isset($data['search'])) {
               $search = $this->db->getConn()->quote('%'.$data['search'].'%');
               $query .= " AND (u.nom LIKE $search OR u.email LIKE $search OR u.prenom LIKE $search)";
          }
          $query .= " LIMIT $limit OFFSET $offset";
          $query = $this->db->getConn()->query($query);
          return $query->fetchAll(\PDO::FETCH_OBJ);
     }

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
          $_SESSION['success'] = "Nouvel utilisateur crée";
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

     public function find (int $id = null) 
     {
          $query = "SELECT * FROM users WHERE id = :id";
          $result = $this->db->getConn()->prepare($query);
          $result->bindValue(':id', $id, \PDO::PARAM_STR);
          $result->execute();
          return $result->fetch(\PDO::FETCH_OBJ);
     }

     public function delete (int $id)
     {
          $user = $this->find($id);
          if (file_exists($user->image)) {
               unlink($user->image);
          }
          $stmt = $this->db->getConn()->prepare("DELETE FROM users WHERE id = :id");
          $stmt->bindValue(":id", $id);
          $_SESSION['danger'] = "Utilisateur N°$id supprimé";
          return $stmt->execute();
     }

     public function update (int $id, array $data = [], array $files = [])
     {
          $user = $this->find($id);
          $stmt = $this->db->getConn()->prepare("UPDATE users SET nom = :nom, prenom = :prenom, email = :email, passwords = :passwords, image = :image WHERE id = :id");
          $passwords = password_hash($data['password'], PASSWORD_DEFAULT);
          $stmt->bindValue(':nom', $data['nom'], \PDO::PARAM_STR);
          $stmt->bindValue(':prenom', $data['prenom'], \PDO::PARAM_STR);
          $stmt->bindValue(':email', $data['email'], \PDO::PARAM_STR);
          $stmt->bindValue(':passwords', $passwords, \PDO::PARAM_STR);
          $stmt->bindValue(':image', $this->check($user, $files['image'], "images/users/"), \PDO::PARAM_STR);
          $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
          $_SESSION['success'] = "Votre profil a été mise à jour";
          $user =  $_SESSION['user'];
          if ($user->id == $id) {
               $_SESSION['user'] = $this->find($id);
          }
          return $stmt->execute();
     }

}