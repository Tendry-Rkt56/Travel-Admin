<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="assets/styles/publication/create.css">
     <?php require_once 'components/head.html'?>
     <title>Publication ~ Création</title>
</head>
<body>
     <?php require_once 'components/admin/header.html.php' ?>

     <div class="containers">
     <div class="container">
          <form enctype="multipart/form-data" class="gap-2 forms-create container d-flex align-items-center justify-content-center flex-column" action="" method="POST">
               <h3 class="mb-5" ><span>Cré</span>ation</h3>
               <div class="d-flex align-items-center justify-content-center container mb-2">
                    <label style="width:30%" for="" class="fw-bolder">Titre: </label>
                    <input required style="width:70%" type="text" class="form-control" placeholder="Titre..." name="titre">
               </div>
               <div class="d-flex align-items-center justify-content-center container mb-2">
                    <label style="width:30%" for="" class="fw-bolder">Sous-titre: </label>
                    <input style="width:70%" type="text" class="form-control" placeholder="Sous-titre..." name="slug">
               </div>
               <div class="d-flex align-items-center justify-content-center container mb-2">
                    <label style="width:30%" for="" class="fw-bolder">Image associée: </label>
                    <input style="width:70%" type="file" class="form-control" placeholder="Image..." name="image">
               </div>
               <div class="d-flex align-items-center justify-content-center container mb-2">
                    <label style="width:30%" for="" class="fw-bolder">Description: </label>
                    <input style="width:70%" type="text" class="form-control" placeholder="Description..." name="description">
               </div>
               <input type="submit" class="btn btn-primary mt-5" value="Créer">
          </form>
     </div>
     </div>

</body>
</html>