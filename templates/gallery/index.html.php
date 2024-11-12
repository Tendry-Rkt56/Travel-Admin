<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <?php require_once 'components/head.html' ?>
     <link rel="stylesheet" href="/assets/styles/gallery/index.css">
     <link rel="stylesheet" href="/assets/styles/publication/index.css">
     <title>Galerie</title>
</head>
<body>
     
     <?php require_once 'components/admin/header.html.php' ?>

     <div class="d-flex gap-4 align-items-center justify-content-center flex-column containers"> 
          <div class="mr-5 container-sm d-flex align-items-center justify-content-evenly flex-row">
               <h2 class="align-self-start justify-self-baseline" style="letter-spacing:2px"><span>Gal</span>erie</h2>
               <a class="mr-5 justify-self-center btn btn-primary d-flex align-items-center justify-content-center" href="/gallery/add"><i class="bx bx-plus add-icon"></i>Ajouter</a>
          </div>
          <?php if (isset($_SESSION)): ?>
               <?php foreach($_SESSION as $key => $value): ?>
                    <?php if ($key !== 'user' && $key !== 'token' && $key !== 'panier'):?>
                         <p class="d-flex align-items-center justify-content-center container-sm alert alert-<?=$key?>"><?=$value?></p>
                         <?php unset($_SESSION[$key])?>
                    <?php endif?>
               <?php endforeach?>
          <?php endif ?>
          <div></div>
          <form action="" class="gap-2 align-self-start d-flex align-items-center justify-content-center flex-row">
               <select name="destination" class="form-select" id="destination">
                    <option <?php if (isset($data['category']) && $data['category'] == 1000): ?> selected <?php endif ?> value="1000">Tous</option>
                    <?php foreach($destinations as $destination): ?>
                         <option <?php if (isset($data['destination']) && $data['destination'] == $destination->id): ?> selected <?php endif ?> value="<?=$destination->id?>"><?=$destination->titre?></option>
                    <?php endforeach ?>
               </select>
               <input value="Rechercher" type="submit" class="btn btn-sm btn-outline-primary">
          </form>
          <div class="gallery" id="container">
               <?php foreach($galeries as $galerie): ?>
                    <div class="gallery-item">
                         <img src="<?=$galerie->chemin?>" class="image" alt="Image 1">
                         <div class="menu">
                              <i class='bx bx-dots-vertical-rounded'></i>
                         </div>
                         <div class="options">
                              <form action="/gallery/<?=$galerie->id?>" method="POST">
                                   <input type="hidden" name="token" value="<?=$_SESSION['token']?>">
                                   <button type="submit">Supprimer</button>
                              </form>
                              <button onclick="replaceImage('Image 1')">Remplacer</button>
                         </div>
                    </div>
               <?php endforeach ?>
          </div>
          <div class="spinner-border loader my-5" role="status">
               <span class="visually-hidden">Loading...</span>
          </div>
     </div>

     <script src="/assets/script/gallery/index.js"></script> 
</body>
</html>