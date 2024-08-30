<?php

namespace App\Controller;

use App\Manager;

class PublicationController extends Controller
{

     public function index (array $data = [])
     {
          $count = Manager::getManager()->getEntity('publication')->getAll($data);
          $page = $data['page'] ?? 1;
          $limit = $data['limit'] ?? 15;
          $maxPages = ceil($count / $limit);
          $offset = ($page - 1) * $limit;          
          $publications = Manager::getManager()->getEntity('publication')->all($limit, $offset, $data);
          $publicationsLength = count($publications);
          return $this->render('publication.index', [
               'page' => $page,
               'count' => $count,
               'limit' => $limit,
               'maxPages' => $maxPages,
               'publications' => $publications,
               'data' => $data,
               'publicationLength' => $publicationsLength,
          ]);
     }

     public function create (array $data = [])
     {
          return $this->render('publication.create', [
               'data' => $data,
          ]);
     }

     public function insert (array $data = [], array $files = [])
     {
          $insert = Manager::getManager()->getEntity('publication')->insert($data, $files);
          return $insert ? $this->redirect('publication.index') : $this->redirect("publication.create");
     }

     public function edit (int $id)
     {
          $publication = Manager::getManager()->getEntity('publication')->find($id);
          return $this->render('publication.edit', ['publication' => $publication]);
     }

     public function update (int $id, array $data = [], array $files = [])
     {
          $update = Manager::getManager()->getEntity('publication')->update($id, $data, $files);
          return $update ? $this->redirect("publication.index") : $this->redirect("publication.edit");
     }

     public function delete (int $id)
     {
          $delete = Manager::getManager()->getEntity('publication')->delete($id);
          return $delete ? $this->redirect("publication.index") : $this->redirect("publication.index");

     }


}