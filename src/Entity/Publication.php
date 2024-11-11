<?php

namespace App\Entity;

use App\Manager;
use App\Trait\ImageRegister;
use App\Trait\Slugger;

class Publication extends Entity
{

     use ImageRegister, Slugger;

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
          $query = "SELECT count(DISTINCT p.id) FROM publications AS p LEFT JOIN publication_category AS pc ON pc.publication_id = p.id 
               JOIN category AS c ON c.id = pc.category_id WHERE 1 = 1";
          if (isset($data['category']) && $data['category'] != 1000) {
               $query .= " AND c.id = '$data[category]'";
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
          $query = "SELECT DISTINCT p.* FROM publications AS p LEFT JOIN publication_category AS pc ON pc.publication_id = p.id 
                    JOIN category AS c ON c.id = pc.category_id WHERE 1 = 1";
          if (isset($data['category']) && $data['category'] != 1000) {
               $query .= " AND c.id = '$data[category]'";
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
          $query->bindValue(':slug', $this->generateSlug($titre), \PDO::PARAM_STR);
          $query->bindValue(':image', $this->checkImage($files['image'], 'images/publications/'), \PDO::PARAM_STR);
          $query->bindValue(':description', htmlspecialchars($description), \PDO::PARAM_STR);
          $result = $query->execute();
          $lastId = $this->db->getConn()->lastInsertId();
          $pivot = $this->pivot($lastId, $data['category']);
          $flash = $result && $pivot ? "Nouvelle publication créée" : "Erreur dans la création de la publication";
          $_SESSION[$result && $pivot ? "success" : "danger"] = $flash;
          return $result;
     }

     private function pivot(int $id, array $data = [])
     {
          $data = isset($data) ? $data : [];
          $sqlInsert = "INSERT INTO publication_category (publication_id, category_id) VALUES (:publication_id, :category_id)";
          $stmtInsert = $this->db->getConn()->prepare($sqlInsert);
          $execute = false;

          foreach ($data as $categoryId) {
               $stmtInsert->bindValue(':publication_id', $id, \PDO::PARAM_INT);
               $stmtInsert->bindValue(':category_id', $categoryId, \PDO::PARAM_INT);
               $execute = $stmtInsert->execute();
          }
          return $execute;
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
               $query->bindValue(':slug', $this->generateSlug($titre), \PDO::PARAM_STR);
               $query->bindValue(':image', $this->checkImage($files['image'], 'images/publications/'), \PDO::PARAM_STR);
               $query->bindValue(':description', htmlspecialchars($description), \PDO::PARAM_STR);
               $result = $query->execute();  
               $lastId = $this->db->getConn()->lastInsertId();
               $this->pivot($lastId, $data['category']);
               if (isset($files['images']) && !empty($files['images']['name'][0])) {
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
               else {
                    $response = [
                         'status' => $result,
                    ];
                    $this->db->getConn()->commit();
               }
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

     private function deleteCategories(int $id)
     {
          $sql = "DELETE FROM publication_category WHERE publication_category.publication_id = :id";
          $query = $this->db->getConn()->prepare($sql);
          $query->bindValue(':id', $id, \PDO::PARAM_INT);
          return $query->execute();
     }

     public function update (int $id, array $data = [], array $files = [])
     {
          $publications = $this->find($id);
          $this->deleteCategories($id);
          $sql = "UPDATE publications SET titre = :titre, slug = :slug, image = :image, description = :description WHERE id = :id";
          $query = $this->db->getConn()->prepare($sql);
          $query->bindValue(':titre', htmlspecialchars($data['titre']), \PDO::PARAM_STR);
          $query->bindValue(':slug', $this->generateSlug($data['titre']), \PDO::PARAM_STR);
          $query->bindValue(':image', htmlspecialchars($this->check($publications, $files['image'], "images/publications/")['chemin']));
          $query->bindValue(':description', htmlspecialchars($data['description']), \PDO::PARAM_STR);
          $query->bindValue(':id', $id, \PDO::PARAM_INT);
          $result = $query->execute();
          $this->pivot($id, $data['category']);
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