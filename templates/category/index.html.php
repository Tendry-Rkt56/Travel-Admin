<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Les catégories</title>
     <link rel="stylesheet" href="../assets/styles/category/index.css">
     <link rel="stylesheet" href="../assets/styles/header.css">
     <?php require_once 'components/head.html'?>
</head>
<body>
     <?php require_once 'components/admin/header.html.php' ?>
     <div class="containers">
          <div class="container publications-container flex-column d-flex align-items-center justify-content-between gap-4 mb-5">
               <div class="mr-5 container d-flex align-items-center justify-content-between flex-row">
                    <h2 class="align-self-start" style="letter-spacing:2px">Les <span>cat</span>égories</h2>
                    <a class="btn btn-primary d-flex align-items-center justify-content-center" href="/category/new"><i class="bx bx-plus add-icon"></i>Ajouter</a>
               </div>
               <?php if (isset($_SESSION)): ?>
                    <?php foreach($_SESSION as $key => $value): ?>
                         <?php if ($key == 'danger' || $key == 'success'):?>
                              <p class="d-flex align-items-center justify-content-center container-sm alert alert-<?=$key?>"><?=$value?></p>
                              <?php unset($_SESSION[$key])?>
                         <?php endif?>
                    <?php endforeach?>
               <?php endif ?>
               <form action="" class="gap-2 align-self-start d-flex align-items-center justify-content-center flex-row">
                    <input id="limit" type="number" class="form-control" value="<?=$limit?>" name="limit">
                    <input type="text" class="form-control" name="search" placeholder="Rechercher..." value="<?=$data['search'] ?? ''?>">
                    <input value="Rechercher" type="submit" class="btn btn-sm btn-outline-primary">
               </form>

               <table class="table table-striped mt-5">
                    <thead>
                         <tr>
                              <th></th>
                              <th>#</th>
                              <th>Valeur</th>
                              <th></th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php foreach($categories as $category): ?>
                              <tr>
                                   <td>
                                        <?php if (isset($category->images)): ?>
                                             <img src="<?=$category->images?>" style="width:40px; height:40px;border-radius:50%" alt="">
                                        <?php endif ?>
                                   </td>
                                   <td><?=$category->id?></td>
                                   <td><?=$category->valeur?></td>
                                   <td>
                                        <div class="d-flex gap-1">
                                             <a href="/category/edit-<?=$category->id?>" class="btn btn-sm btn-primary">Editer</a>
                                             <form action="/category/delete-<?=$category->id?>" method="POST">
                                                  <input type="submit" value="Supprimer" class="btn btn-sm btn-danger">
                                             </form>
                                        </div>
                                   </td>
                              </tr>
                         <?php endforeach ?>
                    </tbody>
               </table>
               <div style="width:60%" class="my-5 d-flex justify-content-between flex-row gap-1 align-items-center">
                    <div class="justify-self-baseline fw-bolder"><?=$categoriesLength?> / <?=$count?></div>
                    <div class="d-flex justify-content-center flex-row gap-1 align-items-center">
                         <?php for($i = 1; $i <= $maxPages; $i++): ?>
                              <?php 
                                   $query = isset($data['search']) ? 'search='.$data['search'] : '';
                                   $query .= isset($data['category']) ? '&category='.$data['category'] : '';     
                                   $query .= isset($data['limit']) ? '&limit='.$data['limit'] : '';     
                              ?>
                         <?php $class = $i == $page ? 'btn-primary' : 'btn-outline-primary' ?>
                              <a style="border-radius:50%;border:none" class="btn <?=$class?>" href="/category?page=<?=$i?><?="&".$query?>"><?=$i?></a>
                         <?php endfor ?>
                    </div>
               </div>

          </div>
     </div>
</body>
</html>