<?php

namespace App\Trait;

trait ImageRegister 
{

     private function check ($publication, array $image = [])
     {
          if ($publication->image == null && empty($image['tmp_name'])) return null;
          if ($publication->image !== null && empty($image['tmp_name'])) return $publication->image;
          $path = substr($publication->image, 1);
          if (file_exists($path)) unlink($path);
          return $this->checkImage($image);
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

}