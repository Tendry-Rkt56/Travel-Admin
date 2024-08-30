<?php

$uri = $_SERVER['REQUEST_URI'];

?>
<header>
     <h3>Dashboard</h3>
     <input style="width:40%" type="text" class="form-control" placeholder="Rechercher...">
     <div class="profil-details">
          <img src="/images/fond/Masoala.jpg" alt="">
          <span class="admin-name">Tendry Rkt</span>
     </div>
</header>
<div class="sidebar">
     <div class="title">
          <h3><span>A</span>dmin</h3>
     </div>
     <div class="navbars">
          <div class="nav-items">
               <a>
                    <span class="icons"><i class='bx bxs-home'></i></span>
                    <span class="text">Accueil</span>
               </a>
               <a class="<?=str_contains("/publications", $uri) ? 'active' : ''?>" style="text-decoration:none;" href="/publications">
                    <span class="icons"><i class='bx bxs-map'></i></span>
                    <span class="text">Destinations</span>
               </a>
               <a>
                    <span class="icons"><i class='bx bxs-info-circle'></i></span>
                    <span class="text">Agence</span>
               </a>
               <a>
                    <span class="icons"><i class='bx bxs-user'></i></span>
                    <span class="text">Utilisateurs</span>
               </a>
          </div>
     </div>
</div>