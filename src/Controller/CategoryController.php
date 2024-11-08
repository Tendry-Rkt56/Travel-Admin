<?php

namespace App\Controller;

class CategoryController extends Controller
{

     public function index(array $data = [])
     {
          $count = $this->manager->getEntity('category')->getAll($data);
          $page = $data['page'] ?? 1;
          $limit = $data['limit'] ?? 10;
          $maxPages = ceil($count / $limit);
          $offset = ($page - 1) * $limit;          
          $categories = $this->manager->getEntity('category')->all($limit, $offset, $data);
          $categoriesLength = count($categories);
          return $this->render('category.index', [
               'page' => $page,
               'count' => $count,
               'limit' => $limit,
               'maxPages' => $maxPages,
               'categories' => $categories,
               'data' => $data,
               'categoriesLength' => $categoriesLength,
          ]);
     }

     public function create()
     {
          return $this->render('category.create');
     }

     public function store(array $data = []) 
     {
          $store = $this->manager->getEntity('category')->store($data);
          return $store ? $this->redirect('category.index') : $this->redirect('category.create');
     }

     public function edit(int $id)
     {
          $category = $this->manager->getEntity('category')->find($id);
          return $this->render('category.edit', [
               'category' => $category,
          ]);
     }

     public function update(int $id, array $data = [])
     {
          $category = $this->manager->getEntity('category')->update($id, $data);
          return $this->redirect('category.index');
     }

     public function delete($id) 
     {
          $delete = $this->manager->getEntity('category')->delete($id);
          return $this->redirect('category.index');
     }

}