<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../assets/styles/admin/index.css">
     <?php require_once 'components/head.html' ?>
     <title>Administration</title>
</head>
<body>
     <?php require_once 'components/admin/header.html.php' ?>
     <div class="containers">
          <div class="dashboards">
	     	<div class="cards">
          	     <a style="text-decoration: none;" href="/publications" class="card blue">
          	         <h3>Destinations</h3>
          	         <span>Voir les destinations</span>
          	     </a>
          	     <a style="text-decoration: none;" href="/category" class="card light-blue">
          	         <h3>Catégories</h3>
          	         <span>Voir les catégories</span>
          	     </a>
          	     <a style="text-decoration: none;" href="/users" class="card purple">
          	         <h3>Utilisateurs</h3>
          	         <span>Voir les utilisateurs</span>
          	     </a>
          	     <a style="text-decoration: none;" href="/users/<?=$_SESSION['user']->id?>" class="card green">
          	         <h3>Profil</h3>
          	         <span>Voir votre profil</span>
          	     </a>
          	</div>
	     </div>
     </div>
</body>
</html>