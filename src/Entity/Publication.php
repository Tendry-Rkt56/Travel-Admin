<?php

namespace App\Entity;

use App\Manager;
use App\Trait\ImageRegister;

class Publication extends Entity
{

     use ImageRegister;

     public function findAll ()
     {
          $query = "SELECT * FROM publications AS p WHERE p.id > 0";
          $query = $this->db->getConn()->query($query);
          return $query->fetchAll(\PDO::FETCH_OBJ);
     }

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
          $query->bindValue(':image', $this->checkImage($files['image'], 'images/publications/'), \PDO::PARAM_STR);
          $query->bindValue(':description', htmlspecialchars($description), \PDO::PARAM_STR);
          $result = $query->execute();
          $flash = $result ? "Nouvelle publication créée" : "Erreur dans la création de la publication";
          $_SESSION[$result ? "success" : "danger"] = $flash;
          return $result;
     }

     public function inserts (array $data = [], array $files = [])
     {
          $response = [];
          try {
               $this->db->getConn()->beginTransaction();
               $sql = "INSERT INTO publications(titre, slug, image, description) VALUES (:titre, :slug, :image, :description)";
               $query = $this->db->getConn()->prepare($sql);
               extract($data);
               $query->bindValue(':titre', htmlspecialchars($titre), \PDO::PARAM_STR);
               $query->bindValue(':slug', htmlspecialchars($slug), \PDO::PARAM_STR);
               $query->bindValue(':image', $this->checkImage($files['image'], 'images/publications/'), \PDO::PARAM_STR);
               $query->bindValue(':description', htmlspecialchars($description), \PDO::PARAM_STR);
               $result = $query->execute();  
               $lastId = $this->db->getConn()->lastInsertId();
               $sql = "INSERT INTO gallery (chemin, publication_id) VALUES (:chemin, :id)";
               $query = $this->db->getConn()->prepare($sql);
               $data = $this->arrangeImage($files['images']);
               $status = false;
               $message = null;
               foreach($data as $image) {
                    $reponse = $this->checkImages($image, "images/gallery/");
                    if (!$reponse['status']) {
                         $status = $reponse['status'];
                              $message = $reponse['message'];
                              throw new \Exception($message);
                              break;
                         }
                         $query->bindValue(":chemin", $reponse['chemin']);
                         $query->bindValue(":id", $lastId);
                         $status = $query->execute();
               }
               $response = [
                    'status' => $result && $status,
               ];
               $this->db->getConn()->commit();
          }
          catch(\Exception $e) {
               $this->db->getConn()->rollBack();
               $response = [
                    'status' => false, 
                    'message' => $e->getMessage(),
               ];
               $_SESSION['danger'] = $e->getMessage();
          }
          return $response;
     }

     private function arrangeImage (array $files = [])
     {
          $images = [];
          foreach($files['name'] as $key => $imageName) {
               $image = [];
               $imageTmpName = $files['tmp_name'][$key];
               $imageType = $files['type'][$key];
               $imageError = $files['error'][$key];
               $imageSize = $files['size'][$key];
               $image = [
                    'name' => $imageName,
                    'tmp_name' => $imageTmpName,
                    'type' => $imageType,
                    'error' => $imageError,
                    'size' => $imageSize
               ];
               $images[] = $image;
          }
          return $images;
     }

     private function addImages (array $files = []): array
     {
          $result = Manager::getManager()->getEntity('gallery')->add($files);
          return $result;
     }

     

     public function update (int $id, array $data = [], array $files = [])
     {
          $publications = $this->find($id);
          $sql = "UPDATE publications SET titre = :titre, slug = :slug, image = :image, description = :description WHERE id = :id";
          $query = $this->db->getConn()->prepare($sql);
          $query->bindValue(':titre', htmlspecialchars($data['titre']), \PDO::PARAM_STR);
          $query->bindValue(':slug', htmlspecialchars($data['slug']), \PDO::PARAM_STR);
          $query->bindValue(':image', htmlspecialchars($this->check($publications, $files['image'], "images/publications/")['chemin']));
          $query->bindValue(':description', htmlspecialchars($data['description']), \PDO::PARAM_STR);
          $query->bindValue(':id', $id, \PDO::PARAM_INT);
          $result = $query->execute();
          $flash = $result ? "Publication N° $id mise à jour" : "Erreur dans la mise à jour";
          $_SESSION[$result ? "success" : "danger"] = $flash;
          return $result;
     }

     private function getImageAssociateInDestination (int $id)
     {
          $sql = "SELECT gallery.* FROM gallery JOIN publications ON gallery.publication_id = publications.id WHERE publications.id = $id";
          return $this->db->getConn()->query($sql)->fetchAll(\PDO::FETCH_OBJ);
     }


     public function delete (int $id)
     {
          $publication = $this->find($id);
          $path = substr($publication->image, 1);
          if (file_exists($path)) unlink($path);
          $length = $this->getImageAssociateInDestination($id);
          if ($length > 0) {
               foreach($length as $image) {
                    $imagePath = substr($image->chemin, 1);
                    if (file_exists($imagePath)) unlink($imagePath);
                    else continue;
               }
          }
          $sql = "DELETE FROM publications WHERE id = :id";
          $query = $this->db->getConn()->prepare($sql);
          $query->bindValue(":id", $id, \PDO::PARAM_INT);
          $_SESSION['danger'] = "Destination N° $id supprimée";
          return $query->execute();
     }
     

}