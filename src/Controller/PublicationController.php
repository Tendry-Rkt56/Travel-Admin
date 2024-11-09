<?php

namespace App\Controller;


class PublicationController extends Controller
{

     public function index (array $data = [])
     {
          $count = $this->manager->getEntity('publication')->getAll($data);
          $page = $data['page'] ?? 1;
          $limit = $data['limit'] ?? 10;
          $maxPages = ceil($count / $limit);
          $offset = ($page - 1) * $limit;          
          $publications = $this->manager->getEntity('publication')->all($limit, $offset, $data);
          $publicationsLength = count($publications);
          $categories = $this->manager->getEntity('category')->findAll();
          return $this->render('publication.index', [
               'page' => $page,
               'count' => $count,
               'limit' => $limit,
               'maxPages' => $maxPages,
               'publications' => $publications,
               'data' => $data,
               'categories' => $categories,
               'publicationLength' => $publicationsLength,
          ]);
     }

     public function create (array $data = [])
     {
          $categories = $this->manager->getEntity('category')->findAll();
          return $this->render('publication.create', [
               'data' => $data,
               'categories' => $categories,
          ]);
     }

     public function insert (array $data = [], array $files = [])
     {
          $insert = $this->manager->getEntity('publication')->inserts($data, $files);
          return $insert['status'] ? $this->redirect('publication.index') : $this->redirect("publication.create");
     }

     public function edit (int $id)
     {
          $publication = $this->manager->getEntity('publication')->find($id);
          $categories = $this->manager->getEntity('category')->findAll();
          $selected = $this->manager->getEntity('category')->categories($id);
          return $this->render('publication.edit', [
               'publication' => $publication,
               'categories' => $categories,
               'selected' => $selected,
          ]);
     }

     public function update (int $id, array $data = [], array $files = [])
     {
          $update = $this->manager->getEntity('publication')->update($id, $data, $files);
          return $update ? $this->redirect("publication.index") : $this->redirect("publication.edit");
     }

     public function delete (int $id)
     {
          $delete = $this->manager->getEntity('publication')->delete($id);
          return $delete ? $this->redirect("publication.index") : $this->redirect("publication.index");

     }


}