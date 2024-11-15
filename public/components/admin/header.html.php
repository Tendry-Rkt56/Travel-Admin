<?php

$uri = $_SERVER['REQUEST_URI'];

?>
<header>
     <i class='bx bx-menu' id="menu-icon"></i>
     <h3>Dashboard</h3>
     <div class="profil-details">
          <?php if (isset($_SESSION['user']->image)): ?>
               <img src="<?=$_SESSION['user']->image?>" alt="">
          <?php endif ?>
          <span class="admin-name"><?=$_SESSION['user']->nom?> <?=$_SESSION['user']->prenom?></span>
     </div>
</header>
<div class="sidebar">
     <div class="title">
          <h3><span>A</span>dmin</h3>
     </div>
     <div class="navbars">
          <div class="nav-items">
               <a href="/" style="text-decoration:none;" class="<?=strlen($uri) == 1 ? 'active' : ''?>">
                    <span class="icons"><i class='bx bxs-home'></i></span>
                    <span class="text">Accueil</span>
               </a>
               <a class="<?=str_contains($uri, '/publications') ? 'active' : ''?>" style="text-decoration:none;" href="/publications">
                    <span class="icons"><i class='bx bxs-map'></i></span>
                    <span class="text">Destinations</span>
               </a>
               <a class="<?=str_contains($uri, '/category') ? 'active' : ''?>" style="text-decoration:none" href="/category">
                    <span class="icons"><i class='bx bx-category'></i></span>
                    <span class="text">Catégories</span>
               </a>
               <a style="text-decoration:none;" href="/users" class="<?=str_contains($uri, '/users') ? 'active' : ''?>">
                    <span class="icons"><i class='bx bxs-user'></i></span>
                    <span class="text">Utilisateurs</span>
               </a>
               <a style="text-decoration:none;" href="/gallery" class="<?=str_contains($uri, '/gallery') ? 'active' : ''?>">
                    <span class="icons"><i class='bx bx-images'></i></span>
                    <span class="text">Galerie</span>
               </a>
               <?php if (isset($_SESSION['user'])): ?>
                    <form class="mt-4" action="/logout" method="POST">
                         <input type="hidden" name="token" value="<?=$_SESSION['token']?>">
                         <button type="submit" class="btn btn-danger">Se déconnecter</button>
                    </form>     
               <?php endif ?>
          </div>
     </div>
</div>