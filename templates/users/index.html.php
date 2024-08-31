<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <?php require_once "components/head.html" ?>
     <link rel="stylesheet" href="/assets/styles/publication/index.css">
     <title>Utilisateurs</title>
</head>
<body>
     <?php require_once 'components/admin/header.html.php' ?>
     <div class="containers">
          <div class="container publications-container flex-column d-flex align-items-center justify-content-between gap-4 mb-5">
               <div class="mr-5 container d-flex align-items-center justify-content-between flex-row">
                    <h2 class="align-self-start" style="letter-spacing:2px">Les <span>uti</span>lisateurs</h2>
                    <a class="btn btn-primary d-flex align-items-center justify-content-center" href="/users/registration"><i class="bx bx-plus add-icon"></i>Ajouter</a>
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
                    <input value="Rechercher" type="submit" class="btn btn-sm btn-outline-primary">
               </form>
               <table class="my-5 table table-striped">
                    <thead>
                         <tr>
                              <th></th>
                              <th>Nom</th>
                              <th>Prénom</th>
                              <th>Email</th>
                              <th></th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php foreach($users as $user): ?>
                              <tr>
                                   <td><?php if (isset($user->image)): ?><img style="width:40px;height:40px;border-radius:50%" src="<?=$user->image?>" alt=""><?php endif ?></td>
                                   <td><?=$user->nom?></td>
                                   <td><?=$user->prenom?></td>
                                   <td><?=$user->email?></td>
                                   <td>
                                        <div class="gap-1 d-flex">
                                             <a href="/users/<?=$user->id?>" class="btn btn-sm btn-primary">Profil</a>
                                             <form action="/users/<?=$user->id?>" method="POST">
                                                  <input type="submit" class="btn btn-sm btn-danger" value="Supprimer">
                                             </form>
                                        </div>
                                   </td>
                              </tr>
                         <?php endforeach ?>
                    </tbody>
               </table>
               <div style="width:60%" class="my-5 d-flex justify-content-between flex-row gap-1 align-items-center">
                    <div class="justify-self-baseline fw-bolder"><?=$userLength?> / <?=$count?></div>
                    <div class="d-flex justify-content-center flex-row gap-1 align-items-center">
                         <?php for($i = 1; $i <= $maxPages; $i++): ?>
                              <?php 
                                   $query = isset($data['search']) ? 'search='.$data['search'] : '';
                                   $query .= isset($data['category']) ? '&category='.$data['category'] : '';     
                                   $query .= isset($data['limit']) ? '&limit='.$data['limit'] : '';     
                              ?>
                         <?php $class = $i == $page ? 'btn-primary' : 'btn-outline-primary' ?>
                              <a style="border-radius:50%;border:none" class="btn <?=$class?>" href="/users?page=<?=$i?><?="&".$query?>"><?=$i?></a>
                         <?php endfor ?>
                    </div>
               </div>
          </div>
     </div>
</body>
</html>