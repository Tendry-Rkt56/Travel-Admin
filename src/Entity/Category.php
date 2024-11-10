<?php

namespace App\Entity;

use App\Trait\ImageRegister;

class Category extends Entity
{

     use ImageRegister;

     public function findAll() 
     {
          $sql = "SELECT * FROM category WHERE id > 0";
          return $this->db->getConn()->query($sql)->fetchAll(\PDO::FETCH_OBJ);
     }

     public function categories(int $id)
     {
          $sql = "SELECT DISTINCT c.id FROM category AS c JOIN publication_category AS pc ON c.id = pc.category_id 
               JOIN publications AS p ON p.id = pc.publication_id WHERE p.id = :id";
          $query = $this->db->getConn()->prepare($sql);
          $query->bindValue(':id', $id, \PDO::PARAM_INT);
          $query->execute();
          return $query->fetchAll(\PDO::FETCH_COLUMN);
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

     public function store(array $data = [], array $files = [])
     {
          $sql = "INSERT INTO category(valeur, slug, image) VALUES (:valeur, :slug, :image)";
          $query = $this->db->getConn()->prepare($sql);
          $query->bindValue(':valeur', htmlspecialchars($data['valeur']), \PDO::PARAM_STR);
          $query->bindValue(':slug', $this->generateSlug(htmlspecialchars($data['valeur'])), \PDO::PARAM_STR);
          $query->bindValue(':image', $this->checkImage($files['image'], 'images/categories/'), \PDO::PARAM_STR);
          $_SESSION['success'] = "Nouvelle catégorie créee";
          return $query->execute();
     }

     private function generateSlug(string $text): string
     {
          $text = strtolower($text);

          $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);

          $text = preg_replace('/[^a-z0-9]+/', '-', $text);

          $text = trim($text, '-');

          return $text;
     }


     public function find(int $id)
     {
          $sql = "SELECT * FROM category WHERE id = :id";
          $query = $this->db->getConn()->prepare($sql);
          $query->bindValue(":id", $id, \PDO::PARAM_INT);
          $query->execute();
          return $query->fetch(\PDO::FETCH_OBJ);
     }

     public function update(int $id, array $data = [], array $files = [])
     {
          if (isset($files['image'])) {
               $category = $this->find($id);
               $path = substr($category->image, 1);
               if (file_exists($path)) unlink($path);
          }
          $sql = "UPDATE category SET valeur = :valeur, slug = :slug, image = :image WHERE id = :id";
          $query = $this->db->getConn()->prepare($sql);
          $query->bindValue(':valeur', htmlspecialchars($data['valeur']), \PDO::PARAM_STR);
          $query->bindValue(':slug', $this->generateSlug(htmlspecialchars($data['valeur'])), \PDO::PARAM_STR);
          $query->bindValue(':image', $this->checkImage($files['image'], 'images/categories/'), \PDO::PARAM_STR);
          $query->bindValue(':id', $id, \PDO::PARAM_INT);
          $_SESSION['success'] = "Catégorie N° $id mise à jour";
          return $query->execute();
     }

     public function delete(int $id)
     {
          $category = $this->find($id);
          $path = substr($category->image, 1);
          if (file_exists($path)) unlink($path);
          $sql = "DELETE FROM category WHERE id = :id";
          $query = $this->db->getConn()->prepare($sql);
          $query->bindValue(':id', $id, \PDO::PARAM_INT);
          $_SESSION['danger'] = "Catégorie N° $id supprimée";
          return $query->execute();
     }

}

?>