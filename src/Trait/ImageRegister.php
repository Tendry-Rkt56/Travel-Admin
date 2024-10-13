<?php

namespace App\Trait;

trait ImageRegister 
{

     private function check (mixed $publication, array $image = [], string $directory = "images/")
     {
          if ($publication->image == null && empty($image['tmp_name'])) {
               return [
                    'status' => true,
                    'chemin' => null,
               ];
          }
          if ($publication->image !== null && empty($image['tmp_name'])) {
               $chemin = $publication->image;
               return [
                    'status' => true,
                    'chemin' => $chemin,
               ];
          }
          
          $response = $this->checkImages($image, $directory);
          if ($response['status']) {
               $path = substr($publication->image, 1);
               if (file_exists($path)) unlink($path);
               return $response;
          }
          return $response;
     }

     private function checkImage (array $image = [], string $directory = "images/"): ?string
     {
          $imageFile = $directory . uniqid("image-").$image['name'];
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

     private function checkImages (array $image = [], string $directory = "images/"): array
     {
          $response = [];
          $status = false;
          $chemin = "";
          try {
               $imageFile = $directory . uniqid("image-").$image['name'];
               $extensions = ['jpeg', 'jpg', 'png'];
               $extension = pathinfo($image['name'], PATHINFO_EXTENSION); 
               if (isset($image['tmp_name']) && !empty($image['tmp_name'])) {
                    if (in_array($extension, $extensions)) {
                         if (move_uploaded_file($image['tmp_name'], $imageFile)) {
                              $chemin = "/".$imageFile;
                              $status = true;
                         }
                         else {
                              $status = false;
                              throw new \Exception("Erreur lors du téléchargement de l'image");
                         }
                    }
                    else {
                         $status = false;
                         throw new \Exception("<h3>Le format <strong>.$extension </strong> n'est pas prise en compte</h3>");
                    }
               }
               else {
                    $chemin = null;
                    $status = true;
               }
               $response = [
                    'chemin' => $chemin,
                    "status" => $status,
               ];
          }
          catch(\Exception $e) {
               $response = [
                    "message" => $e->getMessage(),
                    "status" => $status,
               ];
               $_SESSION['danger'] = $response['message'];
          }
          return $response;
     }



}