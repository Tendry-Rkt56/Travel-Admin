<?php

namespace App\Trait;

trait Slugger
{

     public function generateSlug(string $text): string
     {
          $text = strtolower($text);

          $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);

          $text = preg_replace('/[^a-z0-9]+/', '-', $text);

          $text = trim($text, '-');

          return $text;
     }

}