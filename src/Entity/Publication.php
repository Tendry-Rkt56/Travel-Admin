<?php

namespace App\Entity;

class Publication extends Entity
{

     /**
     * Retourne le nombre de publications en fonction des recherchers des utilisateurs
     * @param array $data
     * @return int 
     */
     public function getAll (array $data = [])
     {
          $query = "SELECT count(*) FROM publications p WHERE p.id > 0";
          if (isset($data['category']) && $data['category'] != 1000) {
               $query .= " AND medicament.category_id = '$data[category]'";
          }
          if (isset($data['search'])) {
               $search = $this->db->getConn()->quote('%'.$data['search'].'%');
               $query .= " AND p.titre LIKE $search";
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
          $query = "SELECT * FROM publications AS p WHERE p.id > 0";
          if (isset($data['category']) && $data['category'] != 1000) {
               $query .= " AND p.category_id = '$data[category]'";
          }
          if (isset($data['search'])) {
               $search = $this->db->getConn()->quote('%'.$data['search'].'%');
               $query .= " AND p.titre LIKE $search";
          }
          $query .= " LIMIT $limit OFFSET $offset";
          $query = $this->db->getConn()->query($query);
          return $query->fetchAll(\PDO::FETCH_OBJ);
     }

     /**
      * Permet de séléctionner une publication en fonction de son id
      * @param int $id
      * @return mixed
      */
     public function find (int $id)
     {
          $query = "SELECT * FROM publications WHERE id = :id";
          $result = $this->db->getConn()->prepare($query);
          $result->bindValue(':id', $id, \PDO::PARAM_STR);
          $result->execute();
          return $result->fetch(\PDO::FETCH_OBJ);
     }

     /**
      * Insère une nouvelle ligne dans la base de donnée
      * @param array $data
      * @param array $files
      * @return bool
      */
     public function insert (array $data = [], array $files = [])
     {
          $sql = "INSERT INTO publications(titre, slug, image, description) VALUES (:titre, :slug, :image, :description)";
          $query = $this->db->getConn()->prepare($sql);
          extract($data);
          $query->bindValue(':titre', htmlspecialchars($titre), \PDO::PARAM_STR);
          $query->bindValue(':slug', htmlspecialchars($slug), \PDO::PARAM_STR);
          $query->bindValue(':image', $this->checkImage($files['image']), \PDO::PARAM_STR);
          $query->bindValue(':description', htmlspecialchars($description), \PDO::PARAM_STR);
          $result = $query->execute();
          $flash = $result ? "Nouvelle publication créée" : "Erreur dans la création de la publication";
          $_SESSION[$result ? "success" : "danger"] = $flash;
          return $result;
     }

     private function checkImage (array $image = []): ?string
     {
          $repertoire = 'images/publications/';
          $imageFile = $repertoire . uniqid("image-").$image['name'];
          $extensions = ['jpeg', 'jpg', 'png'];
          $extension = pathinfo($image['name'], PATHINFO_EXTENSION); 
          if (!isset($image['tmp_name']) && empty($image['tmp_name'])) return null;
          if (in_array($extension, $extensions)) {
               if (move_uploaded_file($image['tmp_name'], $imageFile)) {
                    return "/".$imageFile;
               }
          }
          return null;
     }

     public function update (int $id, array $data = [], array $files = [])
     {
          $publications = $this->find($id);
          $sql = "UPDATE publications SET titre = :titre, slug = :slug, image = :image, description = :description WHERE id = :id";
          $query = $this->db->getConn()->prepare($sql);
          $query->bindValue(':titre', htmlspecialchars($data['titre']), \PDO::PARAM_STR);
          $query->bindValue(':slug', htmlspecialchars($data['slug']), \PDO::PARAM_STR);
          $query->bindValue(':image', htmlspecialchars($this->check($publications, $files['image'])));
          $query->bindValue(':description', htmlspecialchars($data['description']), \PDO::PARAM_STR);
          $query->bindValue(':id', $id, \PDO::PARAM_INT);
          $result = $query->execute();
          $flash = $result ? "Publication N° $id mise à jour" : "Erreur dans la mise à jour";
          $_SESSION[$result ? "success" : "danger"] = $flash;
          return $result;
     }

     private function check ($publication, array $image = [])
     {
          if ($publication->image == null && empty($image['tmp_name'])) return null;
          if ($publication->image !== null && empty($image['tmp_name'])) return $publication->image;
          $path = substr($publication->image, 1);
          if (file_exists($path)) unlink($path);
          return $this->checkImage($image);
     }

     public function delete (int $id)
     {
          $publication = $this->find($id);
          $path = substr($publication->image, 1);
          if (file_exists($path)) unlink($path);
          $sql = "DELETE FROM publications WHERE id = :id";
          $query = $this->db->getConn()->prepare($sql);
          $query->bindValue(":id", $id, \PDO::PARAM_INT);
          $_SESSION['danger'] = "Destination N° $id supprimée";
          return $query->execute();
     }

}