<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../assets/styles/publication/index.css">
     <link rel="stylesheet" href="../assets/styles/header.css">
     <?php require_once 'components/head.html'?>
     <title>Document</title>
</head>
<body>
     <?php require_once 'components/admin/header.html.php' ?>
     <div class="containers">
          <div class="container flex-column d-flex align-items-center justify-content-between gap-4 mb-5">
               <div class="mr-5 container d-flex align-items-center justify-content-between flex-row">
                    <h2 class="align-self-start" style="letter-spacing:2px">Les <span>dest</span>inations</h2>
                    <a class="add-btn" href="/publications/create"><i class="bx bx-plus add-icon"></i>Ajouter</a>
               </div>
               <?php if (isset($_SESSION)): ?>
                    <?php foreach($_SESSION as $key => $value): ?>
                         <?php if ($key !== 'user' && $key !== 'token' && $key !== 'panier'):?>
                              <p class="d-flex align-items-center justify-content-center container-sm alert alert-<?=$key?>"><?=$value?></p>
                              <?php unset($_SESSION[$key])?>
                         <?php endif?>
                    <?php endforeach?>
               <?php endif ?>
               <form action="" class="gap-2 align-self-start d-flex align-items-center justify-content-center flex-row">
                    <input id="limit" type="number" class="form-control" value="<?=$limit?>" name="limit">
                    <input type="text" class="form-control" name="search" placeholder="Rechercher..." value="<?=$data['search'] ?? ''?>">
                    <select name="category" class="form-select" id="">
                         <option <?php if (isset($data['category']) && $data['category'] == 1000): ?> selected <?php endif ?> value="1000">Tous</option>
                         <?php foreach($categories as $category): ?>
                              <option <?php if (isset($data['category']) && $data['category'] == $category->id): ?> selected <?php endif ?> value="<?=$category->id?>"><?=$category->nom?></option>
                         <?php endforeach ?>
                    </select>
                    <input value="Rechercher" type="submit" class="btn btn-sm btn-outline-primary">
               </form>
               <div class="mt-5 container publication-container">
                    <?php foreach ($publications as $publication): ?>
                         <div class="box">
                              <div class="image">
                                   <img src="<?=$publication->image?>" alt="">
                              </div>
                              <div class="publication-title">
                                   <h3><?=$publication->titre?></h3>
                                   <p>
                                        <?=$publication->description?>
                                   </p>
                                   <div class="title-footer">
                                        <h4><?=$publication->slug?></h4>
                                   </div>
                              </div>
                              <div class="publication-action">
                                   <a class="update-btn" href="/publications/<?=$publication->id?>/edit"><i class='bx bx-edit-alt update-icon'></i></a>     
                                   <form action="/publications/<?=$publication->id?>" method="POST" class="delete-form">
                                        <input type="hidden" name="item_id" value="123"> <!-- L'ID de l'élément à supprimer -->
                                        <button type="submit" class="delete-btn">
                                             <i class='bx bx-trash delete-icon'></i>
                                        </button>
                                   </form>

                              </div>
                         </div>
                    <?php endforeach ?>
               </div>
               <div class="container my-3 d-flex justify-content-between flex-row gap-1 align-items-center">
                    <div class="fw-bolder"><?=$publicationLength?> / <?=$count?></div>
                    <div class="d-flex justify-content-center flex-row gap-1 align-items-center">
                         <?php for($i = 1; $i <= $maxPages; $i++): ?>
                              <?php 
                                   $query = isset($data['search']) ? 'search='.$data['search'] : '';
                                   $query .= isset($data['category']) ? '&category='.$data['category'] : '';     
                                   $query .= isset($data['limit']) ? '&limit='.$data['limit'] : '';     
                              ?>
                         <?php $class = $i == $page ? 'btn-primary' : 'btn-outline-primary' ?>
                              <a style="border-radius:50%;border:none" class="btn <?=$class?>" href="/publications?page=<?=$i?><?="&".$query?>"><?=$i?></a>
                         <?php endfor ?>
                    </div>
               </div>
          </div>
     </div>

</body>
</html>