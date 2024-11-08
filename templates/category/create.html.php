<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="../assets/styles/header.css">
     <?php require_once 'components/head.html'?>
</head>
<body>
     <?php  require_once 'components/admin/header.html.php' ?>
     <form method="POST" action="" class="forms d-flex align-items-center justify-content-center flex-column gap-3">
          <h2>Création</h2>
          <div class="d-flex align-items-center justify-content-center flex-row gap-2">
               <label for="valeur" class="fw-bolder" style="width:20%">Nom: </label>
               <input type="text" class="form-control" name="valeur" placeholder="Nom de la catégorie...">
          </div>
          <input type="submit" class="btn btn-primary" value="Créer">
     </form>

</body>
</html>