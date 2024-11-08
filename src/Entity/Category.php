<?php

namespace App\Entity;

class Category extends Entity
{


     public function findAll() 
     {
          $sql = "SELECT * FROM category WHERE id > 0";
          return $this->db->getConn()->query($sql)->fetchAll(\PDO::FETCH_OBJ);
     }

     public function all(int $limit, int $offset, array $data = []) 
     {
          $query = "SELECT * FROM category AS c WHERE c.id > 0";
          if (isset($data['search'])) {
               $search = $this->db->getConn()->quote('%'.$data['search'].'%');
               $query .= " AND (c.valeur LIKE $search)";
          }
          $query .= " LIMIT $limit OFFSET $offset";
          $query = $this->db->getConn()->query($query);
          return $query->fetchAll(\PDO::FETCH_OBJ);
     }

     public function getAll(array $data = [])
     {    
          $query = "SELECT count(*) FROM category AS c WHERE c.id > 0";
          if (isset($data['search'])) {
               $search = $this->db->getConn()->quote('%'.$data['search'].'%');
               $query .= " AND (c.valeur LIKE $search)";
          }
          $query = $this->db->getConn()->query($query);
          return $query->fetchColumn();
     }

     public function store(array $data = [])
     {
          $sql = "INSERT INTO category(valeur) VALUES (:valeur)";
          $query = $this->db->getConn()->prepare($sql);
          $query->bindValue(':valeur', $data['valeur'], \PDO::PARAM_STR);
          $_SESSION['success'] = "Nouvelle catégorie créee";
          return $query->execute();
     }

     public function find(int $id)
     {
          $sql = "SELECT * FROM category WHERE id = :id";
          $query = $this->db->getConn()->prepare($sql);
          $query->bindValue(":id", $id, \PDO::PARAM_INT);
          $query->execute();
          return $query->fetch(\PDO::FETCH_OBJ);
     }

     public function update(int $id, array $data = [])
     {
          $sql = "UPDATE category SET valeur = :valeur WHERE id = :id";
          $query = $this->db->getConn()->prepare($sql);
          $query->bindValue(':valeur', $data['valeur'], \PDO::PARAM_STR);
          $query->bindValue(':id', $id, \PDO::PARAM_INT);
          $_SESSION['success'] = "Catégorie N° $id mise à jour";
          return $query->execute();
     }

     public function delete(int $id)
     {
          $sql = "DELETE FROM category WHERE id = :id";
          $query = $this->db->getConn()->prepare($sql);
          $query->bindValue(':id', $id, \PDO::PARAM_INT);
          $_SESSION['danger'] = "Catégorie N° $id supprimée";
          return $query->execute();
     }

}

?>