<?php

namespace App\Entity;

use App\Trait\ImageRegister;

class Gallery extends Entity
{

     use ImageRegister;

     public function all (array $data = [])
     {
          $sql = "SELECT * FROM gallery WHERE id > 0";
          if (isset($data['destination']) && !empty($data['destination']) && $data['destination'] != 1000) {
               $sql .= " AND publication_id = '$data[destination]'";
          }
          return $this->db->getConn()->query($sql)->fetchAll(\PDO::FETCH_OBJ);
     }

     public function add (array $donnees = [], array $files = [])
     {
          $sql = "INSERT INTO gallery (chemin, publication_id) VALUES (:chemin, :id)";
          $query = $this->db->getConn()->prepare($sql);
          $data = $this->arrangeData($files);
          $status = false;
          $message = null;
          foreach($data as $image) {
               $response = $this->checkImages($image, "images/gallery/");
               if (!$response['status']) {
                    $status = $response['status'];
                    $message = $response['message'];
                    break;
               };
               $query->bindValue(":chemin", $response['chemin']);
               $query->bindValue(":id", $donnees['destination']);
               $status = $query->execute();
          }
          return [
               'status' => $status,
               'message' => $message,
          ];
     }

     private function arrangeData (array $data = []) 
     {
          $images = [];
          foreach($data['image']['name'] as $key => $imageName) {
               $image = [];
               $imageTmpName = $_FILES['image']['tmp_name'][$key];
               $imageType = $_FILES['image']['type'][$key];
               $imageError = $_FILES['image']['error'][$key];
               $imageSize = $_FILES['image']['size'][$key];
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

     public function find (int $id)
     {
          $query = "SELECT * FROM gallery WHERE id = :id";
          $result = $this->db->getConn()->prepare($query);
          $result->bindValue(':id', $id, \PDO::PARAM_STR);
          $result->execute();
          return $result->fetch(\PDO::FETCH_OBJ);
     }

     public function filter(int $id) 
     {
          $sql = "SELECT * FROM gallery WHERE id > 0";
          if ($id != 1000) {
               $sql .= " AND publication_id = '$id'";
          }
          return $this->db->getConn()->query($sql)->fetchAll(\PDO::FETCH_OBJ);
     }

     public function delete (int $id)
     {
          $image = $this->find($id);
          $path = substr($image->image, 1);
          if (file_exists($path)) unlink($path);
          $sql = "DELETE FROM gallery WHERE id = :id";
          $query = $this->db->getConn()->prepare($sql);
          $query->bindValue(":id", $id, \PDO::PARAM_INT);
          $_SESSION['danger'] = "Image N° $id supprimée";
          return $query->execute();
     }

}