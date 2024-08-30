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
          	     <a style="text-decoration: none;" href="/users/medicaments" class="card blue">
          	         <h3>Médicaments</h3>
          	         <span>Voir les médicaments</span>
          	     </a>
          	     <a style="text-decoration: none;" href="/users/categories" class="card light-blue">
          	         <h3>Catégories</h3>
          	         <span>Voir les catégories</span>
          	     </a>
          	     <a style="text-decoration: none;" href="/users/listes" class="card purple">
          	         <h3>Utilisateurs</h3>
          	         <span>Voir les utilisateurs</span>
          	     </a>
          	     <a style="text-decoration: none;" href="/users/vente" class="card green">
          	         <h3>Ventes</h3>
	     		    <i style="color:white">Les 5 dérnières ventes: </i>
          	         <span>Gérer les ventes</span>
          	     </a>
          	</div>
	     </div>
     </div>
</body>
</html>