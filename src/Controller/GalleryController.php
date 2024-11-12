<?php

namespace App\Controller;

use App\Manager;

class GalleryController extends Controller
{

     public function index (array $data = [])
     {
          $galeries = $this->manager->getEntity('gallery')->all($data);
          return $this->render('gallery.index', [
               'galeries' => $galeries,
               'destinations' => $this->manager->getEntity('publication')->findAll(),
               'data' => $data,
          ]);
     }

     public function fetchApi (int $id)
     {
          $galeries = $this->manager->getEntity('gallery')->filter($id);
          return $this->json($galeries);
     }

     public function create ()
     {
          $destinations = $this->manager->getEntity('publication')->findAll();
          return $this->render('gallery.create', [
               'destinations' => $destinations,
          ]);
     }

     public function add (array $data = [], array $files = [])
     {
          $this->checkToken($data);
          $store = $this->manager->getEntity('gallery')->add($_POST, $files);
          if ($store['status']) return $this->redirect("gallery.index");
          else return $this->redirect("gallery.add");
     }

     public function delete (int $id, array $data = []) 
     {
          $this->checkToken($data);
          $delete = $this->manager->getEntity('gallery')->delete($id);
          if ($delete) return $this->redirect("gallery.index");
     }

}