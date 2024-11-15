<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title><?=$category->valeur?></title>
     <link rel="stylesheet" href="../assets/styles/header.css">
     <?php require_once 'components/head.html'?>
</head>
<body>
     <?php  require_once 'components/admin/header.html.php' ?>
     <div class="containers">
          <div class="container">
               <form method="POST" enctype="multipart/form-data" action="" class="forms d-flex align-items-center justify-content-center flex-column gap-3">
                    <h2>Edition</h2>
                    <div class="container d-flex align-items-center justify-content-center flex-row gap-2">
                         <label for="valeur" class="fw-bolder" style="width:40%">Nom: </label>
                         <input type="text" style="width:60%" class="form-control" value="<?=$category->valeur?>" name="valeur" placeholder="Nom de la catégorie...">
                    </div>
                    <div class="container d-flex align-items-center justify-content-center flex-row gap-2">
                         <label for="image" class="fw-bolder" style="width:40%">Image associée: </label>
                         <input type="file" style="width:60%" class="form-control" name="image" placeholder="Image associée...">
                    </div>
                    <input type="hidden" name="token" value="<?=$_SESSION['token']?>">
                    <input type="submit" class="btn btn-primary" value="Modifier">
               </form>
          </div>
     </div>

</body>
</html>